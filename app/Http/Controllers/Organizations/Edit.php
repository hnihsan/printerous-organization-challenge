<?php

namespace App\Http\Controllers\Organizations;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Edit extends Controller
{
    public function __invoke($id)
    {
        $organization = Organization::find($id);

        if(empty($organization)){
            return redirect('/organizations')->with('informasi','Organization not found');
        }

        if($organization->user_id != Session::get('id')){
            return redirect('/organizations')->with('informasi','You\'re not authorized.');
        }

        return view('pages.organizations.edit',[
            'data' => $organization
        ]);
    }
}
