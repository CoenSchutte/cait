<?php

namespace App\Nova\Metrics;

use App\Models\UserEventRegistration;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class RegistrationsPerEvent extends Partition
{
    public $name = 'Inschrijvingen Per Evenement';

    public function calculate(NovaRequest $request)
    {
        return $this->result(
            UserEventRegistration::join('event_registrations', 'user_event_registrations.event_registration_id', '=', 'event_registrations.id')
                ->join('posts', 'event_registrations.post_id', '=', 'posts.id')
                ->select(DB::raw('count(*) as count'), 'posts.title as label')
                ->groupBy('posts.title')
                ->get()
                ->pluck('count', 'label')
                ->toArray()
        );
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
        return 'registrations-per-event';
    }
}
