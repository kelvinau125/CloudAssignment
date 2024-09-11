<?php

namespace App\Http\Controllers\Educator;

use App\Models\Module;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'questions.*.question' => 'required|string',
            'questions.*.option1' => 'required|string',
            'questions.*.option2' => 'required|string',
            'questions.*.answer' => 'required|string',
        ]);
        

        // Create the Module
        $module = Module::create([
            'educatorID' => $request->user()->id,  // Assuming the logged-in user is the student
            'title' => $request->input('title'),  
        ]);

        // Store each question
        foreach ($request->questions as $questionData) {
            Question::create([
                'ans1' => $questionData['option1'],
                'ans2' => $questionData['option2'],
                'cors_ans' => $questionData['answer'],
                'moduleID' => $module->id,
            ]);
        }

        return redirect()->back()->with('success', 'Module uploaded successfully');
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
