<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Cashier\Http\RedirectToCheckoutResponse;
use Mollie\Laravel\Facades\Mollie;
use Money\Money;
use function Symfony\Component\Translation\t;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ad = Ad::inRandomOrder()->first();
        if ($ad) $ad->image_url = $ad->getMainbarAttribute();

        $products = Product::where('is_displayed', 1)->orderBy('created_at', 'desc')->paginate(6);

        $products->map(function ($product) {
            $product->image_url = $product->get4by3Attribute();
        });

        $user = auth()->user();


        return view('products.index', [
            'products' => $products,
            'ad' => $ad,
            'user' => $user,
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

    public function preparePayment(Request $request)
    {
        $product = Product::find($request->product_id);
        $user = auth()->user();


        $invoice = $user->invoices()->create([
            'product' => $product->name . ' - ' . $request->color . ' - ' . $request->size,
            'price' => $product->getPrice(),
            'status' => 'awaiting_payment',
            'category' => $product->category,
        ]);

        $payment = Mollie::api()->payments->create([
            "amount" => [
                "currency" => "EUR",
                "value" => number_format($product->getPrice(), 2)
            ],
            "description" => $product->name . ' - ' . $request->color . ' - ' . $request->size,
            "redirectUrl" => route('products.success', [
                'invoice' => $invoice,
            ]),
            "webhookUrl" => route('products.paid'),
            "metadata" => [
                "invoice_id" => $invoice->id
            ],
        ]);

        // redirect customer to Mollie checkout page
        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function handleWebhookNotification(Request $request) {
        $paymentId = $request->input('id');
        $payment = Mollie::api()->payments->get($paymentId);

        $invoice = Invoice::find($payment->metadata->invoice_id);

        if ($payment->isPaid())
        {
            $invoice->status = 'paid';
            $invoice->save();
        }
    }




    public function success(Request $request, Invoice $invoice)
    {
        return view('products.success',
            [
                'invoice' => $invoice,
            ]);
    }
}
