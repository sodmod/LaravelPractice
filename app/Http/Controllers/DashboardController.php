<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index(): string
    {
        $posts = Auth::user()->posts()->latest()->paginate(6);
        return view("users.dashboard", ['posts' => $posts]);
    }

    public function usersPost(User $user): string
    {
        $userPosts = $user->posts()->latest()->paginate(6);

        return view("users.posts",
            [
                'posts' => $userPosts,
                'user' => $user
        ]);
    }
}
