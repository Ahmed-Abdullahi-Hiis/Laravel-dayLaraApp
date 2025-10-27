<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // Make sure to import the User model


class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Or paginate if needed
        return view('admin.users', compact('users'));
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.edit', compact('user'));
}
}


