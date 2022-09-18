<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Highlight;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $ad = Ad::inRandomOrder()->first();
        if($ad) $ad->image_url = $ad->getMainbarAttribute();


        $posts = Post::where('is_featured', true)->where('is_published', true)->take(4)->get();

        $posts->map(function ($post) {
            $post->image_url = $post->get16by9Attribute();
            $post->preview_url = $post->preview();
        });

        $highlights = Highlight::where('is_published', true)->take(10)->orderBy('event_date', 'desc')->get();

        $highlights->map(function ($highlight) {
            $highlight->image_url = $highlight->get4by3Attribute();
            $highlight->preview_url = $highlight->preview();
        });

        $recentPosts = Post::where('is_published', true)->where('is_featured', false)->take(4)->orderBy('created_at', 'desc')->get();

        $recentPosts->map(function ($post) {
            $post->image_url = $post->get16by9Attribute();
            $post->preview_url = $post->preview();
        });

        return view('welcome', [
            'posts' => $posts,
            'ad' => $ad,
            'highlights' => $highlights,
            'recentPosts' => $recentPosts,
        ]);
    }
}
