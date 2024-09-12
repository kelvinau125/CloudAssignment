<?php

namespace App\Http\Controllers\Student;
use App\Models\Module;
use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modules = Module::all(); // Get all modules
        return view('student.module.index', compact('modules')); 
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function join(Request $request, $moduleId)
    {
        $module = Module::find($moduleId);
        if ($module) {
            
            $questions = Question::where('moduleID', $moduleId)->get();
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
            }

            // Pass the questions and module to the 
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
