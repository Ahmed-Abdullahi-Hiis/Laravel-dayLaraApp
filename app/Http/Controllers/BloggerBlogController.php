<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BloggerBlogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'blogger']);
    }

    /**
     * List all blogs of the logged-in blogger with search, filter, and pagination
     */
    public function index(Request $request)
    {
        $query = Blog::where('user_id', Auth::id());

        // Search by title or description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Paginate results
        $blogs = $query->latest()->paginate(10);

        return view('blogger.blogs.index', compact('blogs'))
               ->with('search', $request->search)
               ->with('status', $request->status);
    }

    /**
     * Show form to create a blog
     */
    public function create()
    {
        return view('blogger.blogs.create');
    }

    /**
     * Store a new blog
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'date'        => 'required|date',
            'status'      => 'required|in:draft,published',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['user_id'] = Auth::id();

        // Handle image upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/blogs', $filename);
            $validated['image'] = 'uploads/blogs/' . $filename;
        }

        Blog::create($validated);

        return redirect()->route('blogger.blogs.index')
                         ->with('success', 'Blog created successfully!');
    }

    /**
     * Show form to edit a blog
     */
    public function edit(Blog $blog)
    {
        $this->authorizeBlog($blog);
        return view('blogger.blogs.edit', compact('blog'));
    }

    /**
     * Update a blog
     */
    public function update(Request $request, Blog $blog)
    {
        $this->authorizeBlog($blog);

        $validated = $request->validate([
            'title'        => 'required|string|max:255',
            'description'  => 'required|string',
            'date'         => 'required|date',
            'status'       => 'required|in:draft,published',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'remove_image' => 'nullable|boolean',
        ]);

        // Remove current image if requested
        if ($request->has('remove_image') && $request->remove_image && $blog->image) {
            if (file_exists(storage_path('app/public/' . $blog->image))) {
                unlink(storage_path('app/public/' . $blog->image));
            }
            $validated['image'] = null;
        }

        // Upload new image if provided
        if ($request->hasFile('image')) {
            if ($blog->image && file_exists(storage_path('app/public/' . $blog->image))) {
                unlink(storage_path('app/public/' . $blog->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads/blogs', $filename);
            $validated['image'] = 'uploads/blogs/' . $filename;
        } elseif (!isset($validated['image'])) {
            $validated['image'] = $blog->image;
        }

        $blog->update($validated);

        return redirect()->route('blogger.blogs.index')
                         ->with('success', 'Blog updated successfully!');
    }

    /**
     * Delete a blog
     */
    public function destroy(Blog $blog)
    {
        $this->authorizeBlog($blog);

        if ($blog->image && file_exists(storage_path('app/public/' . $blog->image))) {
            unlink(storage_path('app/public/' . $blog->image));
        }

        $blog->delete();

        return redirect()->route('blogger.blogs.index')
                         ->with('success', 'Blog deleted successfully!');
    }

    /**
     * Ensure the blog belongs to the logged-in blogger
     */
    private function authorizeBlog(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }
    }
}
