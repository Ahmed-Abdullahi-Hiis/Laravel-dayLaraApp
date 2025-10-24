<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
   public function index()
{
    $blogs = \App\Models\Blog::latest()->paginate(6); // 6 per page
    return view('blog', compact('blogs'));
}
    public function create()
    {
         return view('create');
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'date' => 'required|date',
    ]);

    Blog::create($validated);

    return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
}
}
