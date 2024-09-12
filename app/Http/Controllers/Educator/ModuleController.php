<?php

namespace App\Http\Controllers\Educator;

use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all modules with their associated questions
        $modules = Module::withCount('questions')->get(); // Assuming you have a relationship for questions count
        $disabledModuleIds = DB::table('redis')->pluck('moduleID')->toArray();
    
        return view('educator.module', [
            'modules' => $modules,
            'disabledModuleIds' => $disabledModuleIds,
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
        // Find the module by its ID
        $module = Module::find($id);

        if (!$module) {
            // If the module is not found, return a 404 response
            return response()->json(['message' => 'Module not found'], 404);
        }

        try {
            // Soft delete the module
            $module->delete();

            // Return a success response
            return response()->json(['message' => 'Module deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle any errors during the deletion process
            return response()->json(['message' => 'Error deleting module'], 500);
        }
    }
}
