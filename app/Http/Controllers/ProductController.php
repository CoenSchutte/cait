<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Money\Money;
use function Symfony\Component\Translation\t;

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
        if ($ad) $ad->image_url = $ad->getMainbarAttribute();

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
     * @param \App\Models\Product $product
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
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
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
//        $user->clearMollieMandate();

        $item = new \Laravel\Cashier\Charge\ChargeItemBuilder($user);
        $item->unitPrice(money($product->getPrice() * 100, 'EUR'));
        $item->description($product->name . ' - ' . $request->color . ' - ' . $request->size);
        $chargeItem = $item->make();

        $invoice = $user->invoices()->create([
            'product' => $product->name . ' - ' . $request->color . ' - ' . $request->size,
            'price' => $product->getPrice(),
            'category' => $product->category,
        ]);

        $result = $user->newCharge()
            ->addItem($chargeItem)
            ->setRedirectUrl(route('products.success', [
                'invoice' => $invoice,
            ]))
            ->create();

        if (is_a($result, \Laravel\Cashier\Http\RedirectToCheckoutResponse::class)) {
            return $result;
        }

        return redirect()->route('products.success', [
                'invoice' => $invoice,]
        );
    }

    public function success(Invoice $invoice)
    {

        return view('products.success',
            [
                'invoice' => $invoice,
            ]);
    }
}
