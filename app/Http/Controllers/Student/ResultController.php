<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Models\Module;
use App\Models\Question;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Get submission ID from request
        $submission_id = $request->query('submission');
       
        // Find the submission by ID
        $submission = Submission::where('id', $submission_id)->first();
        //decode the answer 
        $decode_answer = json_decode($submission->answer);

        // Retrieve the module ID from the submission
        $module_id = $submission->moduleID;
        
        // dd($decode_answer);
        // Fetch the module and its questions
        $questions = Question::where('moduleID', $module_id)
                          ->leftJoin('module', 'module.id', '=', 'question.moduleID') // Optional: Join with module table if needed
                          ->select('question.*', 'module.title as module_title')
                          ->get();
        // dd($questions);
        $answerList =[];

        foreach($decode_answer as $decodeAnswer){
            foreach($questions as $qus){
                if($decodeAnswer->questionId == $qus->id){
                    $answerList[$qus->id]["title"] =  $qus->question;
                    $answerList[$qus->id]["answer"] =  $decodeAnswer->answerId;
                    $answerList[$qus->id]["correct_answer"] = $qus->cors_ans;
                }
            }
        }
        // Pass the submission and module data to the view
        return view('student.review.result', [
            'answer' => $answerList,
        ]);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
