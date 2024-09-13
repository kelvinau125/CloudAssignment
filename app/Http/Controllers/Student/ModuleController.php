<?php

namespace App\Http\Controllers\Student;
use App\Models\Module;
use App\Models\Redis;
use App\Models\Question;
use App\Models\Submission;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $studentId = auth()->user()->id; // Get the logged-in student's ID
    
        // Get all modules that do not have a submission by the current student
        $modules = Module::leftJoin('submission', function($join) use ($studentId) {
                $join->on('module.id', '=', 'submission.moduleID')
                     ->where('submission.studentID', '=', $studentId);
            })
            ->whereNull('submission.moduleID') // Filter modules with no submission
            ->select('module.*') // Select all fields from the modules table
            ->get();
        foreach ($modules as $module) {
            $redisData = Redis::where('studentID', $studentId)->where('moduleID', $module->id)->first();
            $module->hasPartialAnswers = !is_null($redisData);
        }
        return view('student.module.index', compact('modules'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    

    // public function join(Request $request, $moduleId)
    // {
    //     $module = Module::find($moduleId);
    //     if ($module) {
            
    //         $questions = Question::where('moduleID', $moduleId)->get();
    //         foreach ($questions as $question) {
    //             // Create an array of answers
    //             $answers = [
    //                 ['id' => 1, 'text' => $question->ans1],
    //                 ['id' => 2, 'text' => $question->ans2],
    //                 ['id' => 3, 'text' => $question->cors_ans]
    //             ];
    
    //             // Shuffle the answers
    //             shuffle($answers);
    
    //             // Add the shuffled answers to the question object
    //             $question->shuffledAnswers = $answers;
    //         }

    //         // Pass the questions and module to the 
    //         return view('student.module.joinQuiz', compact('module', 'questions'));
    //     } else {
    //         // Handle module not found
    //         return redirect()->route('module.index')->with('error', 'Module not found.');
    //     }
    // }
    public function join(Request $request, $moduleId)
    {
        $studentId = auth()->user()->id; // Get the logged-in student's ID
        $module = Module::find($moduleId);
    
        if ($module) {
            $questions = Question::where('moduleID', $moduleId)->get();
            $preSelectedAnswers = [];
    
            // Check if there are stored answers in Redis
            $redisData = Redis::where('studentID', $studentId)->where('moduleID', $moduleId)->first();
            if ($redisData) {
                $storedAnswers = json_decode($redisData->data, true);
                foreach ($storedAnswers as $answer) {
                    $preSelectedAnswers[$answer['questionId']] = $answer['answerId'];
                }
            }
    
            foreach ($questions as $question) {
                // Create an array of answers
                $answers = [
                    ['id' => 1, 'text' => $question->ans1],
                    ['id' => 2, 'text' => $question->ans2],
                    ['id' => 3, 'text' => $question->cors_ans]
                ];
    
                // Shuffle the answers
                shuffle($answers);
    
                // Add the shuffled answers to the question object
                $question->shuffledAnswers = $answers;
                // Add the pre-selected answer
                $question->preSelectedAnswer = $preSelectedAnswers[$question->id] ?? null;
            }
    
            // Pass the questions and module to the view
            return view('student.module.joinQuiz', compact('module', 'questions'));
        } else {
            // Handle module not found
            return redirect()->route('module.index')->with('error', 'Module not found.');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      
        $moduleId = $request->input('module_id');
        $studentId = $request->input('student_id');
        $answers = $request->input('question');
      
         
        $output = [];

        // Convert answers array to desired JSON format
        foreach ($answers as $questionId => $answerId) {
            // Append the formatted array to the output
            $output[] = [
                "answerId" => (int) $answerId,
                "questionId" => (int) $questionId
            ];
        }
        $jsonOutput = json_encode($output);
        // Get the total number of questions for the module
        $totalQuestions = Question::where('moduleID', $moduleId)->count();
        $answeredQuestions = count($answers);
        if ($answeredQuestions < $totalQuestions) {
            // Save partial answers to Redis if not all questions are answered
            Redis::updateOrCreate(
                ['studentID' => $studentId, 'moduleID' => $moduleId],
                ['data' => $jsonOutput]
            );
            return redirect()->route('module.index')
            ->with('message', 'Quiz saved successfully!');
           
        } else {
            // Calculate the score (assuming you have logic to calculate the score)
                $score = $this->calculateScore($answers, $moduleId); // You need to implement this function based on your scoring logic
                $maxScore = $totalQuestions; // Assume max score is the total number of questions

                // Save the complete submission data
                Submission::updateOrCreate(
                    ['studentID' => $studentId, 'moduleID' => $moduleId],
                    [
                        'answer' => $jsonOutput,  // Save the JSON output in the 'answer' column
                        'score' => $score,
                        'maxscore' => $maxScore,
                        'review' => 'pending',  // Default review status
                        'feedback' => null,     // Feedback can be added later
                        'status' => 'submitted', // Status indicates quiz completion
                        'sub_date' => now()      // Set submission date
                    ]
                );

                // Optionally, you might want to delete the partial data from Redis
                Redis::where('studentID', $studentId)->where('moduleID', $moduleId)->delete();

                // Return success response
                return redirect()->route('module.index')
                ->with('message', 'Quiz submitted successfully, You can Review the Module!');
            
        }
    }
    private function calculateScore($answers, $moduleId)
        {
            $score = 0;

            // Loop through the submitted answers
            foreach ($answers as $questionId => $answerId) {
                // Get the question and its correct answer from the Question table
                $question = Question::where('moduleID', $moduleId)->where('id', $questionId)->first();

                // Check if the submitted answer matches the correct answer ('cors_ans')
                if ($question && $question->cors_ans == $answerId) {
                    $score++;
                }
            }

            return $score;
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
