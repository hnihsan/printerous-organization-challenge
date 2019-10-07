<?php

namespace App\Http\Controllers\Persons;

use App\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class All extends Controller
{
    public function __invoke($id)
    {
        $persons = Person::where('organization_id','=',$id)->get();
        return json_encode([
            'meta' => [
                'code' => 200,
                'message' => 'success'
            ],
            'data' => $persons
        ]);
    }
}
