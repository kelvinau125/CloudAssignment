<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Models\Content; // Make sure to import the Content model
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function list(Request $request): View
    {
        // Paginate the content, showing 10 entries per page
        $contents = Content::paginate(10);

        // Pass the paginated content data to the view
        return view('manage.content.list', ['contents' => $contents]);
    }
}
