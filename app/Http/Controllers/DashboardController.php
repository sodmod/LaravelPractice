<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index():string
    {
        $posts = Auth::user()->posts()->latest()->paginate(6);
        return view("users.dashboard",['posts'=>$posts]);
    }
}
