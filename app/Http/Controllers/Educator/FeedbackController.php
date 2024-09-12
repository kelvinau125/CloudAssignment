<?php

namespace App\Http\Controllers\Educator;

use App\Models\Question;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FeedbackController extends Controller
{

    // Handle feedback submission
    public function submit(Request $request, $id)
    {
        $submission = Submission::findOrFail($id);

        // Validate and save feedback
        $request->validate(['feedback' => 'required|string']);
        $submission->feedback = $request->feedback;
        $submission->save();

        return redirect()->back()->with('success', 'Feedback submitted successfully!');
    }

    /**
     * Display a listing of the resource.
     */
    public function index($submissionId)
    {
        //
        // Fetch the submission and related module questions
        $submission = Submission::with('module')->findOrFail($submissionId);
        $answers = json_decode($submission->answer, true); // Decode the JSON answers

        // Get the list of questions from the module
        $questions = Question::where('moduleID', $submission->moduleID)->get();

        return view('educator.feedback', compact('submission', 'answers', 'questions'));
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
        //
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
        $submission = Submission::findOrFail($id);

        // Validate and update feedback
        $request->validate(['feedback' => 'required|string']);
        $submission->feedback = $request->feedback;
        $submission->save();

        return redirect()->back()->with('success', 'Feedback updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete($id)
    {
        $submission = Submission::findOrFail($id);

        // Delete feedback
        $submission->feedback = null;
        $submission->save();

        return redirect()->back()->with('success', 'Feedback deleted successfully!');
    }
}
