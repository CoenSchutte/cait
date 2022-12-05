<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Cashier\Charge\ChargeItemBuilder;
use Laravel\Cashier\Http\RedirectToCheckoutResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = Ad::where('expiration_date', '>=', today())->inRandomOrder()->first();
        if($ad) $ad->image_url = $ad->getSidebarAttribute();

        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(6);
        $posts->map(function ($post) {
            $post->image_url = $post->get4by3Attribute();
            $post->low_res = $post->preview();
        });

        return view('posts.index', [
            'posts' => $posts,
            'ad' => $ad,
            'title' => 'activiteiten'
        ]);
    }

    public function vacatures()
    {
        $ad = Ad::where('expiration_date', '>=', today())->inRandomOrder()->first();
        if($ad) $ad->image_url = $ad->getSidebarAttribute();

        $posts = Post::where('category', 'Vacature')->where('is_published', 1)->orderBy('created_at', 'desc')->paginate(6);
        $posts->map(function ($post) {
            $post->image_url = $post->get4by3Attribute();
            $post->low_res = $post->preview();
        });
        return view('posts.index', [
            'posts' => $posts,
            'ad' => $ad,
            'title' => 'vacatures'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if (! Gate::allows('post-published', $post)) {
            abort(404);
        }
        $post->image_url = $post->fileUrl();
        $registration = $post->registration;
        return view('posts.show', compact('post', 'registration'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
