<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LoginController extends Controller
{
    //
    public function login(Request $request): View
    {
        return view('parent.login');
    }
}
