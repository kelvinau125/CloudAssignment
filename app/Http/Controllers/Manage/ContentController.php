<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function list(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');

        // Query the Content model with optional search filter
        $contents = Content::when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%")
                             ->orWhere('content_type', 'like', "%{$search}%");
            })
            ->paginate(10); // Paginate results with 10 per page

        // Pass contents and search term back to the view
        return view('manage.content.list', [
            'contents' => $contents,
            'search' => $search,
        ]);
    }

    public function create()
    {
        return view('manage.content.create');  // Return the content creation form view
    }

    /**
     * Store a newly created content in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content_type' => 'required',
            'content_path' => 'nullable',
        ]);

        // Create the content and save it to the database
        Content::create($validated);

        // Redirect back to the content list with a success message
        return redirect()->route('content.list')->with('success', 'Content created successfully!');
    }

    /**
     * Show the form for editing the specified content.
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);

        return view('manage.content.edit', compact('content'));
    }

    /**
     * Update the specified content in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'content_type' => 'required',
            'content_path' => 'nullable',
        ]);

        $content = Content::findOrFail($id);
        $content->update($validated);

        return redirect()->route('content.list')->with('success', 'Content updated successfully!');
    }

    /**
     * Remove the specified content from storage.
     */
    public function destroy($id)
    {
        $content = Content::findOrFail($id);
        $content->delete();

        return redirect()->route('content.list')->with('success', 'Content deleted successfully!');
    }
}
