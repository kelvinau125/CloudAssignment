<?php

namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request): View
    {
        return view('manage.login');
    }
}
