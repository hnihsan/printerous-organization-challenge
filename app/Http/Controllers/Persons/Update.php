<?php

namespace App\Http\Controllers\Persons;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Update extends Controller
{
    public function __invoke($org_id, Request $request)
    {
        $org = Organization::find($org_id);
        if(Session::get('id') != $org->user_id){
            return redirect('organizations/detail/'.$org_id)->with('informasi', 'You\'re not authorized.');
        }

        $check = Validator::make($request->input(), [
            'email'         => [ 'required', 'email' ],
            'name'          => [ 'required' ],
            'phone_number'  => [ 'required', 'max:20' ],
            'id'            => [ 'required' ]
        ]);

        if ( $check->fails() ) {
            $messages = $check->messages();
            $error_msg = '';
            foreach ($messages->all() as $message)
            {
                $error_msg.="$message,";
            }
            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Form input not properly filled. '.$error_msg); //
        }

        $person = Person::find($request->input('id'));
        if(empty($person)){
            return redirect('organizations/detail/'.$org_id)->with('informasi','Person not found');
        }

        if ( $request->hasFile('person_avatar') ) {
            $storage = Storage::disk('public');
            if($person->avatar != null){
                $storage->delete($person->avatar);
            }
            $avatar_path = $storage->put('person', $request->file('person_avatar'));
        }else{
            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Form input not properly filled. '); //
        }

        DB::beginTransaction();
        $person->email    = $request->input('email');
        $person->name     = $request->input('name');
        $person->phone    = $request->input('phone_number');
        $person->avatar   = $avatar_path;

        if ( !$person->save() ) {
            DB::rollBack();

            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Failed to save organization.'); //
        }

        DB::commit();

        return redirect('organizations/detail/'.$org_id)
            ->with('success','Succesfully edit person.');
    }
}
