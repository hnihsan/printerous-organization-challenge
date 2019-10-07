<?php

namespace App\Http\Controllers\Organizations;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class Add extends Controller
{
    public function __invoke(Request $request)
    {
        $check = Validator::make($request->input(), [
            'email'         => [ 'required', 'email' ],
            'name'          => [ 'required' ],
            'phone_number'  => [ 'required', 'max:20' ],
            'website'       => [ 'required' ],
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

        if ( $request->hasFile('organization_logo') ) {
            $storage = Storage::disk('public');
            $logo_path = $storage->put('organization', $request->file('organization_logo'));
//            $uploadedFile = $request->file('organization_logo');
//
//            $logo_path = $uploadedFile->store('public/organization');
        }else{
            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Form input not properly filled. '); //
        }

        DB::beginTransaction();
        $organization = new Organization();
        $organization->email    = $request->input('email');
        $organization->name     = $request->input('name');
        $organization->phone    = $request->input('phone_number');
        $organization->website  = $request->input('website');
        $organization->logo     = $logo_path;
        $organization->user_id  = Session::get('id');

        if ( !$organization->save() ) {
            DB::rollBack();

            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Failed to save organization.'); //
        }

        DB::commit();

        $org = Organization::where('email','=',$request->input('email'))->first();
        return redirect('organizations/detail/'.$org->id)
            ->with('success','Succesfully add new organization.');
    }
}
