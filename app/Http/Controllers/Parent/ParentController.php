<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        return view("parent.register");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => 'parent', // Set the user role to 'parent'
            'password' => Hash::make($request->password), // Hash the password
            'remember_token' => Str::random(length: 60),

        ]);
        event(new Registered($user));
        Auth::login($user);


        // You can redirect or return a success message
        return redirect()->route('parent.login')->with('success', 'Account created successfully. Please log in.');

    }

    public function studentView(): View
    {
        //
        return view("parent.registerStudent");
    }

    public function registerStudent(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],

        ]);

        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'user_role' => 'student', // Set the user role to 'parent'
            'password' => Hash::make($request->password), // Hash the password
            'remember_token' => Str::random(length: 60),
            'parent_user'=> Auth::id(),

        ]);

        event(new Registered($student));

        return redirect(to: route('dashboard', absolute: false));


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
