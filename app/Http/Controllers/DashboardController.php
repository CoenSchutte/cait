<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ad = Ad::inRandomOrder()->first();
        if($ad) $ad->image_url = $ad->getMainbarAttribute();


        $posts = Post::where('is_featured', true)->where('is_published', true)->take(3  )->get();

        $posts->map(function ($post) {
            $post->image_url = $post->get16by9Attribute();
            $post->preview_url = $post->preview();
        });

        return view('welcome', [
            'posts' => $posts,
            'ad' => $ad,
        ]);
    }
}
