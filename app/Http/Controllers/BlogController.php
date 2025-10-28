<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // =========================
    // FRONTEND METHODS
    // =========================

    // Show all blogs for the frontend
    public function showBlogsPage()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('blog', compact('blogs')); // resources/views/blog.blade.php
    }

    // Show single blog on frontend
    public function showSingleBlog(Blog $blog)
    {
        return view('blog-single', compact('blog')); // resources/views/blog-single.blade.php
    }

    // =========================
    // ADMIN METHODS
    // =========================

    // List all blogs in admin dashboard
    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs')); // resources/views/admin/blog/index.blade.php
    }

    // Show form to create new blog
    public function create()
    {
        return view('admin.blogs.create'); // resources/views/admin/blog/create.blade.php
    }

    // Store new blog in database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        Blog::create($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
    }

    // Show form to edit an existing blog
    public function edit(Blog $blog)
    {
        return view('admin.edit', compact('blog')); // resources/views/admin/blog/edit.blade.php
    }

    // Update an existing blog
    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);

        $blog->update($validated);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
    }

    // Delete a blog
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }
}
