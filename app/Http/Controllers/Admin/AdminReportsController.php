<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class AdminReportsController extends Controller
{
    /**
     * Display the admin reports dashboard.
     */
    public function index()
    {
        // Summary cards
        $cards = [
            [
                'title' => 'Total Users',
                'value' => number_format(User::count()),
                'color' => 'indigo',
            ],
            [
                'title' => 'Active Bloggers',
                'value' => number_format(User::where('role', 'blogger')->count()),
                'color' => 'emerald',
            ],
            [
                'title' => 'Total Posts',
                'value' => number_format(Blog::count()),
                'color' => 'blue',
            ],
            [
                'title' => 'Pending Approvals',
                'value' => number_format(Blog::where('status', 'pending')->count()),
                'color' => 'rose',
            ],
        ];

        // Recent activities
        $recentActivities = [];

        // Latest user registrations
        $users = User::latest()->take(3)->get();
        foreach ($users as $user) {
            $recentActivities[] = [
                'type' => 'User Registration',
                'details' => "New user <strong>{$user->name}</strong> registered",
                'status' => 'Verified',
                'date' => $user->created_at->format('M d, Y'),
            ];
        }

        // Latest blog posts awaiting approval
        $blogs = Blog::where('status', 'pending')->latest()->take(3)->get();
        foreach ($blogs as $blog) {
            $recentActivities[] = [
                'type' => 'Post Approval',
                'details' => "Post <strong>{$blog->title}</strong> awaiting review",
                'status' => 'Pending',
                'date' => $blog->created_at->format('M d, Y'),
            ];
        }

        // Latest flagged comments
        $comments = Comment::where('status', 'flagged')->latest()->take(3)->get();
        foreach ($comments as $comment) {
            $recentActivities[] = [
                'type' => 'Comment Moderation',
                'details' => "Flagged comment on <strong>{$comment->blog->title}</strong>",
                'status' => 'Action Needed',
                'date' => $comment->created_at->format('M d, Y'),
            ];
        }

        // Latest test reports
        $reports = Report::latest()->take(5)->get();
        foreach ($reports as $report) {
            $recentActivities[] = [
                'type' => $report->type,
                'details' => $report->details,
                'status' => $report->status,
                'date' => $report->created_at->format('M d, Y'),
            ];
        }

        // Sort activities by date descending (latest first)
        usort($recentActivities, function ($a, $b) {
            return strtotime($b['date']) <=> strtotime($a['date']);
        });

        return view('admin.reports', compact('cards', 'recentActivities'));
    }
}
