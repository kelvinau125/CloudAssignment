<?php

namespace App\Http\Controllers\Manage;

use Illuminate\Support\Facades\Hash;
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
            ->paginate(10);  // Use paginate instead of get or all

        // Pass users and search term back to the view
        return view('manage.user.list', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('manage.user.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'user_role' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'user_role' => $validated['user_role'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('user.list')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('manage.user.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'user_role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('user.list')->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user.list')->with('success', 'User deleted successfully!');
    }
}
