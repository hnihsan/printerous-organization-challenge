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

class Add extends Controller
{

    public function __invoke($id)
    {
        $org = Organization::find($id);
        if(Session::get('id') != $org->user_id){
            return redirect('organizations/detail/'.$id)->with('informasi', 'You\'re not authorized.');
        }
        return view('pages.persons.add')->with('org_id', $id);
    }

    public function execute($id, Request $request){
        $org = Organization::find($id);
        if(Session::get('id') != $org->user_id){
            return redirect('organizations/detail/'.$id)->with('informasi', 'You\'re not authorized.');
        }
        $check = Validator::make($request->input(), [
            'email'         => [ 'required', 'email' ],
            'name'          => [ 'required' ],
            'phone_number'  => [ 'required', 'max:20' ],
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

        if ( $request->hasFile('person_avatar') ) {
            $storage = Storage::disk('public');
            $avatar_path = $storage->put('person', $request->file('person_avatar'));
        }else{
            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Form input not properly filled. '); //
        }

        DB::beginTransaction();
        $person = new Person();
        $person->email    = $request->input('email');
        $person->name     = $request->input('name');
        $person->phone    = $request->input('phone_number');
        $person->avatar   = $avatar_path;
        $person->organization_id  = $id;

        if ( !$person->save() ) {
            DB::rollBack();

            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Failed to save organization.'); //
        }

        DB::commit();

        return redirect('organizations/detail/'.$id)
            ->with('success','Succesfully add new person.');
    }
}
