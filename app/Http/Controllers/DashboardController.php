<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_featured', true)->where('is_published', true)->get();

        return view('welcome', compact('posts'));
    }
}
