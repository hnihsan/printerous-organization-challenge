<?php

namespace App\Http\Controllers\Organizations;

use App\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Find extends Controller
{
    public function __invoke(Request $request)
    {
        $constraint = $request->input('query');
        $constraint = strtolower($constraint);
        $organizations = Organization::where('name','like','%'.$constraint.'%')
                                    ->orWhereHas('persons', function($q) use ($constraint){
                                        $q->where('name', 'like', '%'.$constraint.'%');
                                    })->get();

        return json_encode([
            'meta' => [
                'code' => 200,
                'message' => 'success'
            ],
            'data' => $organizations
        ]);
    }
}
