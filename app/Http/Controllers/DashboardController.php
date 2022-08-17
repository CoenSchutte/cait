<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $posts = Post::where('is_featured', true)->where('is_published', true)->get();

        $posts->map(function ($post) {
            $post->image_url = $post->fileUrl();
            $post->preview_url = $post->preview();
        });

        return view('welcome', compact('posts'));
    }
}
