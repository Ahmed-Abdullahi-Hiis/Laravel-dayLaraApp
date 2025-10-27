<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    // Display all blogs with pagination
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('blog', compact('blogs'));
    }

    // Show the form to create a new blog
    public function create()
    {
        return view('create');
    }

    // Store a newly created blog
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
        ]);

        Blog::create($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    // Show the form to edit an existing blog
    public function edit(Blog $blog)
    {
        return view('admin.edit', compact('blog'));
    }

    // Update an existing blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
        ]);

        $blog->update($validated);

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
