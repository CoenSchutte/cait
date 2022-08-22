<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ad = Ad::inRandomOrder()->first();
        if($ad) $ad->image_url = $ad->getMainbarAttribute();

        $products = Product::where('is_displayed', 1)->orderBy('created_at', 'desc')->paginate(1);

        $products->map(function ($product) {
            $product->image_url = $product->get4by3Attribute();
        });


        return view('products.index', [
            'products' => $products,
            'ad' => $ad,
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product->urls = $product->getUrlsAttribute();
        return view('products.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function buy(Request $request)
    {
        $product = Product::find($request->product_id);
        $user = auth()->user();
        $item = new \Laravel\Cashier\Charge\ChargeItemBuilder($user);

        $price = $user->hasSubscription() ? $product->member_price : $product->normal_price;

    // create an order item for the charge
        $item->amount($price)
            ->description($product->name)
            ->build();


        $order = new \Laravel\Cashier\Order\OrderBuilder($user);
        $order->setItems([$item])
            ->paymentDescription($product->name)
            ->processAt(now())
            ->create();



        return redirect()->route('profile.show');


    }
}
