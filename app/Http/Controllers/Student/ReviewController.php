<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Module;
use App\Models\Submission;

class ReviewController extends Controller
{
    

    public function index()
    {
        // Get the ID of the currently authenticated student
        $studentId = Auth::id();
    
        $submissions = Submission::where('studentID', $studentId)
            ->leftJoin('module', 'submission.moduleID', '=', 'module.id')
            ->select('submission.*', 'module.title as module_title', 'module.id as module_id')
            ->get();
    
        // Pass the data to the view
        return view('student.review.index', compact('submissions'));
    }
    
    public function create(Submission $submission)
    {
        return view('student.review.addReview', compact('submission'));
    }
    
    public function edit(Submission $submission)
    {
        // Logic for displaying the form to edit a review
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $submissionId = $request->input('submission_id');
        $reviewContent = $request->input('review');

        // Find the submission by ID
        $submission = Submission::find($submissionId);

        if ($submission) {
            // Update the existing review or add a new one
            $submission->review = $reviewContent;
            $submission->save();
        }

        // Redirect or return response
        return redirect()->route('review.index')->with('success', 'Review has been processed successfully.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Submission $submission)
    { 
        if($submission==null || empty($submission)){
            return redirect()->route('review.index')->with('error', 'Check went wrong please check again later.');
        }
        $submission->review = null;
        $submission->save();

        // // Find the submission by ID
        // $submission = Submission::find($submissionId);

        // if ($submission) {
        //     // Set the review to null
        //     $submission->review = null;
        //     $submission->save();
        // }

        // Redirect or return response
        return redirect()->route('review.index')->with('success', 'Review has been deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
