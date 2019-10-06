<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Session::flush();
        return redirect('/auth/login');
    }
}
