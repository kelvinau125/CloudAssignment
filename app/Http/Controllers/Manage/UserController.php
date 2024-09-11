<?php

namespace App\Http\Controllers\Manage;

use Illuminate\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request): View
    {
        return view('manage.user.list');
    }
}
