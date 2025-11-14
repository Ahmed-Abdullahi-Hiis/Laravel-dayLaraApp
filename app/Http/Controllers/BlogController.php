<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // =========================
    // FRONTEND METHODS
    // =========================

    // Show all published blogs for the frontend
    public function showBlogsPage()
    {
        $blogs = Blog::where('status', 'published')
                     ->latest()
                     ->paginate(6);
        return view('blog', compact('blogs')); // resources/views/blog.blade.php
    }

    // Show single blog on frontend (only if published)
    public function showSingleBlog(Blog $blog)
    {
        if ($blog->status !== 'published') {
            abort(404); // Don't show drafts
        }

        return view('blog-single', compact('blog')); // resources/views/blog-single.blade.php
    }

    // =========================
    // ADMIN METHODS
    // =========================

    public function index()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs.index', compact('blogs')); 
    }

    public function create()
    {
        return view('admin.blogs.create'); 
    }

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

    public function edit(Blog $blog)
    {
        return view('admin.edit', compact('blog')); 
    }

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

    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully!');
    }

    public function reports()
    {
        return view('blogger.reports');
    }

    public function settings()
    {
        return view('blogger.settings');
    }
}
