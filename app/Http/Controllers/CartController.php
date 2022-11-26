<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::find($request->product_id);

        $url = $product->preview();
        \Cart::session(auth()->user()->id)
            ->add([
                'id' => Str::uuid()->toString(),
                'name' => $product->name,
                'price' => $product->getPrice(),
                'quantity' => 1,
                'attributes' => array(
                    'color' => $request->color,
                    'size' => $request->size,
                    'product_id' => $product->id,
                    'image_url' => $url,
                    'category' => $product->category,
                )
            ]);

        session()->flash('success', $product->name . ' is aan je winkelmandje toegevoegd');

        return redirect()->route('products.checkout');
    }

    public function removeFromCart(Request $request)
    {
        $product = Product::find($request->product_id);
        \Cart::session(auth()->user()->id)->remove($request->item_id);
        session()->flash('success', $product?->name . ' is uit je winkelmandje verwijderd');
        return redirect()->route('products.index');
    }
}
