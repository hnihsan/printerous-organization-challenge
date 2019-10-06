<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct () {
        $this->middleware('guest')->except('logout');
    }

    public function __invoke(Request $request)
    {
        $check = Validator::make($request->input(), [
            'email'    => [ 'required', 'email' ],
            'password' => [ 'required' ]
        ]);

        // if validation fail
        if ( $check->fails() )
            return back()
                ->withInput(Input::except('password'))
                ->withErrors($check)
                ->with('informasi','Form not propperly filled.');

        $user = User
            ::where([
                'email' => $request->input('email')
            ])
            ->first();
        if ( empty($user) )
            return back()
                ->withInput(Input::except('password'))
                ->withErrors($check)
                ->with('informasi','User not found');

        $password = base64_decode($user->password);
        // compare password from database with user input
        if ( !Hash::check($request->input('password'), $password) )
            return back()
                ->withInput(Input::except('password'))
                ->withErrors($check)
                ->with('informasi','Email or Password incorrect.');

        $request->session()->regenerate();
        $request->session()->put([
            'id'    => $user->id,
            'email' => $user->email,
            'name'  => $user->name
        ]);

        return redirect('/dashboard');
    }
}
