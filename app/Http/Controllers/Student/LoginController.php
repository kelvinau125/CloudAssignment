<?php
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
class LoginController extends Controller
{
    public function login(Request $request): View
    {
        return view('student.login');
    }
}
