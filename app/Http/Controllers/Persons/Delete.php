<?php

namespace App\Http\Controllers\Persons;

use App\Organization;
use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Delete extends Controller
{
    public function __invoke($id)
    {
        $person = Person::with('organization')->where('id','=',$id)->first();
        if(empty($person)){
            return back()->with('informasi','Person not found');
        }

        $org = $person->organization;
        if(Session::get('id') != $org->user_id){
            return redirect('organizations/detail/'.$org->id)->with('informasi', 'You\'re not authorized.');
        }

        DB::beginTransaction();
        if ( !$person->delete() ) {
            DB::rollBack();

            return redirect('organizations/detail/'.$org->id)->with('informasi', 'Failed to delete person.');
        }
        DB::commit();
        return redirect('organizations/detail/'.$org->id)->with('success', 'Successfully delete person.');
    }
}
