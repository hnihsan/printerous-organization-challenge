<?php

namespace App\Http\Controllers\Organizations;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class Update extends Controller
{
    public function __invoke(Request $request)
    {
        $check = Validator::make($request->input(), [
            'email'         => [ 'required', 'email' ],
            'id'            => [ 'required' ],
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

        $organization = Organization::find($request->input('id'));
        if(empty($organization)){
            return redirect('/organizations/edit/'.$request->input('id'))->with('informasi','Organization not found');
        }

        if($organization->user_id != Session::get('id')){
            return redirect('/organizations')->with('informasi','You\'re not authorized.');
        }

        if ( $request->hasFile('organization_logo') ) {
            $storage = Storage::disk('public');
            if($organization->logo != null){
                $storage->delete($organization->logo);
            }
            $logo_path = $storage->put('organization', $request->file('organization_logo'));
        }

        DB::beginTransaction();
        $organization->email    = $request->input('email');
        $organization->name     = $request->input('name');
        $organization->phone    = $request->input('phone_number');
        $organization->website  = $request->input('website');
        $organization->logo     = $logo_path;

        if ( !$organization->save() ) {
            $storage->delete($logo_path);
            DB::rollBack();

            return back()
                ->withInput(Input::all())
                ->withErrors($check)
                ->with('informasi', 'Failed to save organization.'); //
        }

        DB::commit();

        return redirect('organizations/edit/'.$organization->id)
            ->with('success','Succesfully update organization detail.');
    }
}
