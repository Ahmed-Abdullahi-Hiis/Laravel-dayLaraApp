<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
   public function index()
{
    $blogs = Blog::latest()->paginate(6);

    return response()->json([
        'success' => true,
        'message' => 'Blogs retrieved successfully',
        'data'    => $blogs->items(),
        'pagination' => [
            'current_page' => $blogs->currentPage(),
            'last_page'    => $blogs->lastPage(),
            'per_page'     => $blogs->perPage(),
            'total'        => $blogs->total(),
            'next_page_url'=> $blogs->nextPageUrl(),
            'prev_page_url'=> $blogs->previousPageUrl(),
        ]
    ]);
}


    public function show(Blog $blog)
    {
        return response()->json([
            'success' => true,
            'message' => 'Blog retrieved successfully',
            'data'    => $blog
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
        ]);

        $blog = Blog::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Blog created successfully',
            'data'    => $blog
        ], 201);
    }

    public function update(Request $request, Blog $blog)
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'description' => 'required|string',
        'date'        => 'required|date',
    ]);

    $blog->update($validated);

    return redirect()
        ->route('blogs.index')
        ->with('success', 'Blog updated successfully!');
}


    public function destroy(Blog $blog)
{
    $blog->delete();

    return redirect()
        ->route('blogs.index')
        ->with('success', 'Blog deleted successfully!');
}


    public function showBlogsPage()
{
    $blogs = \App\Models\Blog::latest()->paginate(6);
    return view('blog', compact('blogs'));
}

public function edit($id)
{
    $blog = Blog::findOrFail($id);
    return view('admin.edit', compact('blog'));
}


}
