<?php

namespace App\Http\Controllers\Organizations;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Detail extends Controller
{
    public function __invoke($id)
    {
        $organization = Organization::find($id);
        if(empty($organization)){
            return redirect('/organizations')->with('informasi','Organization not found');
        }

        return view('pages.organizations.detail',[
            'data' => $organization
        ]);
    }
}
