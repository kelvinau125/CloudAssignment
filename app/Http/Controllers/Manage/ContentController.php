<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    // public function store(Request $request)
    // {
    //     // Validate the incoming request
    //     $validated = $request->validate([
    //         'title' => 'required|max:255',
    //         'description' => 'required',
    //         'content_type' => 'required',
    //         'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
    //     ]);

    //     // Handle the file upload if an image is uploaded
    //     if ($request->hasFile('content_image')) {
    //         // Get the uploaded file
    //         $file = $request->file('content_image');

    //         // Generate a unique filename to avoid collisions
    //         $fileName = time() . '_' . $file->getClientOriginalName();

    //         // Store the image in S3 under the 'images' folder
    //         $path = Storage::disk('s3')->put('images', $file, $fileName);

    //         // Save the S3 file path in the database
    //         $validated['content_path'] = $path;
    //     }

    //     // Create the content and save it to the database
    //     Content::create($validated);

    //     // Redirect back to the content list with a success message
    //     return redirect()->route('content.list')->with('success', 'Content created successfully!');
    // }

    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'content_type' => 'required',
        'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
    ]);

    if ($request->hasFile('content_image')) {
        $file = $request->file('content_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('images', $fileName, 'public');
        $validated['content_path'] = $path;
    }
    Content::create($validated);

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
    // Find the content by its ID
    $content = Content::findOrFail($id);

    // Validate the incoming request
    $validated = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'content_type' => 'required',
        'content_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
    ]);

    if ($request->hasFile('content_image')) {
        $file = $request->file('content_image');
        
        $fileName = time() . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('images', $fileName, 'public');

        if ($content->content_path) {
            Storage::disk('public')->delete($content->content_path);
        }

        $validated['content_path'] = $path;
    }

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
