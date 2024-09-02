<?php

namespace App\Nova\Metrics;

use App\Models\User;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class UsersPerOpleiding extends Partition
{
    public $name = 'Users Per Opleiding';

    public $width = '1/3';

    public function calculate(NovaRequest $request)
    {
        return $this->count($request, User::class, 'opleiding');
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
