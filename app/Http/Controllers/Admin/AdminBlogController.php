<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display all blogs with optional search and pagination.
     */
    public function index(Request $request)
    {
        $query = Blog::query();

        // Search by title, category, or status
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%");
        }

        $blogs = $query->latest()->paginate(10)->withQueryString();

        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show form to create a new blog.
     */
    public function create()
    {
        return view('admin.blogs.create');
    }

    /**
     * Store a newly created blog.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'status'      => 'required|in:draft,published',
            'category'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $blog = new Blog();
        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->date        = $request->date;
        $blog->status      = $request->status;
        $blog->category    = $request->category;
        $blog->user_id     = auth()->id();

        if ($request->hasFile('image')) {
            $blog->image = $this->uploadImage($request->file('image'));
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog created successfully!');
    }

    /**
     * Show form to edit a blog.
     */
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    /**
     * Update an existing blog.
     */
    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'status'      => 'required|in:draft,published',
            'category'    => 'required|string|max:255',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $blog->title       = $request->title;
        $blog->description = $request->description;
        $blog->date        = $request->date;
        $blog->status      = $request->status;
        $blog->category    = $request->category;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
                unlink(public_path('storage/' . $blog->image));
            }
            $blog->image = $this->uploadImage($request->file('image'));
        }

        $blog->save();

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete a blog.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
            unlink(public_path('storage/' . $blog->image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
                         ->with('success', 'Blog deleted successfully!');
    }

    /**
     * Handle image upload.
     */
    private function uploadImage($file)
    {
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('storage/uploads/blogs'), $filename);
        return 'uploads/blogs/' . $filename;
    }
}
