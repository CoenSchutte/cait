<?php

namespace App\Nova\Metrics;

use App\Models\Invoice;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class InvoicesPerProduct extends Partition
{
    public $name = 'Aantal facturen per product';

    public $width = '1/3';

    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Invoice::class, 'product');
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'invoices-per-product';
    }
}
