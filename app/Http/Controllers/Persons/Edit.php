<?php

namespace App\Http\Controllers\Persons;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class Edit extends Controller
{
    public function __invoke($org_id, $id)
    {
        $org = Organization::find($org_id);
        if(empty($org)){
            return redirect('organizations')->with('informasi','Organization not found');
        }

        if(Session::get('id') != $org->user_id){
            return redirect('organizations/detail/'.$org_id)->with('informasi', 'You\'re not authorized.');
        }

        $person = Person::find($id);
        if(empty($person)){
            return redirect('organizations/detail/'.$org_id)->with('informasi','Person not found');
        }

        return view('pages.persons.edit')->with([
            'data'=> $person,
            'org_id' => $org_id
        ]);
    }
}
