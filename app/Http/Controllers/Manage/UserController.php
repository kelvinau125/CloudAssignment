<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the User model with optional search filter
        $users = User::when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('user_role', 'like', "%{$search}%");
            })
            ->paginate(10); // Paginate results with 10 per page

        // Pass users and search term back to the view
        return view('manage.user.list', [
            'users' => $users,
            'search' => $search,
        ]);
    }
}
