<?php

namespace App\Http\Controllers\Manage;

use Illuminate\View\View;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\User;



class UserController extends Controller
{
    public function list(Request $request): View
    {
        $users = User::paginate(10);
        
        return view('manage.user.list', ['users' => $users]);
    }
}
