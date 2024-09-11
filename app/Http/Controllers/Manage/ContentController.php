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
}
