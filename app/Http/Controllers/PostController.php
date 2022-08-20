<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Post;
use Illuminate\Http\Request;
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
        $ad = Ad::inRandomOrder()->first();
        $ad->image_url = $ad->getSidebarAttribute();

        $posts = Post::where('is_published', 1)->orderBy('created_at', 'desc')->paginate(1);
        $posts->map(function ($post) {
            $post->image_url = $post->get4by3Attribute();
            $post->low_res = $post->preview();
        });
        return view('posts.index', [
            'posts' => $posts,
            'ad' => $ad,
        ]);
    }

    public function pay(Request $request)
    {
        $user = auth()->user();

        $item = new ChargeItemBuilder($user);
        $item->unitPrice(money(3000, 'EUR')); //1 EUR
        $item->description('STIR Lidmaatschap');
        $chargeItem = $item->make();

        $result = $user->newCharge()
            ->addItem($chargeItem)
            ->setRedirectUrl('https://www.nuzzles.nl/')
            ->create();

        if (is_a($result, RedirectToCheckoutResponse::class)) {
            return $result;
        }

        return back()->with('status', 'Thank you.');
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
        $post->image_url = $post->fileUrl();
        return view('posts.show', compact('post'));
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
