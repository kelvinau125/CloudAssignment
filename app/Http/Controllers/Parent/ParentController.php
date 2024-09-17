<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use App\Models\User;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Auth\Events\Registered;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    public function list(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the User model with optional search filter
        $users = User::where('user_role', 'student') // Filter by role
            ->where('parent_user', Auth::id()) // Additional filter based on authenticated user's ID
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('user_role', 'like', "%{$search}%");
                });
            })
            ->paginate(10);  // Use paginate instead of get or all

        // Pass users and search term back to the view
        return view('parent.list', [
            'users' => $users,
            'search' => $search,
        ]);
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

    //View Contents 
    public function viewContents()
    {

        $results = Content::all();

        return view('parent.view-contents', compact('results'));
    }

    //View Result Function

    public function viewStudentResults()
    {
        // Get the logged-in parent's ID
        $parentId = Auth::id();

        // Get all students registered by this parent
        $students = User::where('parent_user', $parentId)->pluck('id');

        // Fetch all submissions by the parent's students
        $results = Submission::whereIn('studentID', $students)
            ->join('users', 'submission.studentID', '=', 'users.id')
            ->select('submission.*', 'users.name as student_name')
            ->get();

        // Return the view with the filtered results
        return view('parent.student-results', compact('results'));


    }
    // View All Modules
    public function viewModules()
    {
        $modules = Module::all();

        return view('parent.student-modules', compact('modules'));
    }
    public function viewModuleResults($module_id)
    {
        // Get the logged-in parent's ID
        $parent = Auth::user();

        // Get all students registered by this parent
        $students = $parent->students->pluck('id');

        // Fetch all submissions by the parent's students for the given module
        $results = Submission::where('moduleID', $module_id)
            ->whereIn('studentID', $students)
            ->join('users','submission.studentID','=','users.id')
            ->select('submission.*','users.name as student_name')
            ->get();
        // $results = Submission::whereIn('studentID', $students)
        //     ->join('users', 'submission.studentID', '=', 'users.id')
        //     ->select('submission.*', 'users.name as student_name')
        //     ->get();
        // Pass the results to the view
        return view('parent.module-results', compact('results'));
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
            'parent_user' => Auth::id(),

        ]);

        event(new Registered($student));

        // Initialize the API response message
        $apiMessage = '';

        // Trigger the external API after successful registration
        try {
            // Make the GET request to the API
            $apiUrl = 'https://6jb13vn1y6.execute-api.us-east-1.amazonaws.com/DevelopStage/TestAPI';
            $response = Http::get($apiUrl);

            // Log or check the API response
            if ($response->successful()) {
                // Optionally handle the success response
                $apiMessage = $response->json()['body'] ?? 'API triggered successfully!';
                \Log::info('API triggered successfully.', ['response' => $response->json()]);
            } else {
                $apiMessage = 'Failed to trigger API.';
                // Optionally handle the error
                \Log::error('Failed to trigger API.', ['status' => $response->status()]);
            }
        } catch (\Exception $e) {
            $apiMessage = 'Exception occurred while triggering the API: ' . $e->getMessage();
            // Handle any exceptions during the API request
            \Log::error('Exception occurred while triggering the API.', ['error' => $e->getMessage()]);
        }

        // return redirect(to: route('dashboard', absolute: false));

        // Redirect to the dashboard and pass the API message to the view
        return redirect()->route('dashboard')->with('apiMessage', $apiMessage);



    }

    //Report
    public function generateReport()
    {
        // Get the logged-in parent's ID
        $parent = Auth::user();

        // Get all students registered by this parent
        $students = $parent->students->pluck('id');

        // Fetch all submissions by the parent's students
        $submissions = Submission::whereIn('studentID', $students)->get();

        // Report metrics
        $totalSubmissions = $submissions->count();
        $averageScoresPerModule = $submissions->groupBy('moduleID')->map(function ($moduleSubmissions) {
            return $moduleSubmissions->avg('score');
        });
        $completionRatePerModule = $submissions->groupBy('moduleID')->map(function ($moduleSubmissions) {
            $totalAttempts = $moduleSubmissions->count();
            $totalMaxScores = $moduleSubmissions->sum('maxscore');
            return ($totalAttempts / $totalMaxScores) * 100; // Calculate the completion rate
        });

        // You can add other calculations as needed, such as effectiveness of interventions.

        // Return the report view with the calculated data
        return view('parent.report', compact('totalSubmissions', 'averageScoresPerModule', 'completionRatePerModule'));
    }

    //Triger Noti API
    public function triggerApi()
    {
        // API URL
        $url = 'https://6jb13vn1y6.execute-api.us-east-1.amazonaws.com/DevelopStage/TestAPI';

        // Make the GET request to the API
        $response = Http::get($url);

        // Check for success response
        if ($response->successful()) {
            $data = $response->json();
            return response()->json([
                'status' => 'Success',
                'message' => $data['body'] ?? 'API triggered successfully!',
            ]);
        } else {
            // Handle the error
            return response()->json([
                'status' => 'Error',
                'message' => 'Failed to trigger API',
            ], $response->status());
        }
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
        $user = User::findOrFail($id);

        return view('parent.edit', compact(var_name: 'user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'user_role' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->update($validated);

        return redirect()->route('student.list')->with('success', 'User updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('student.list')->with('success', 'User deleted successfully!');

    }
}
