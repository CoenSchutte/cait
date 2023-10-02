<?php

namespace App\Nova;

use App\Models\EventRegistration as EventRegistrationModel;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class EventRegistration extends Resource
{
    public static $model = EventRegistrationModel::class;

    public function title()
    {
        return $this->resource->event->title;
    }

    public static $search = [
        'id',
    ];

    public static $group = 'Events';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Event', 'event', Post::class)
                ->searchable(),

            Number::make('Max number of attendees', 'max_attendees')
                ->min(1),

            DateTime::make('Registration start date', 'registration_start')
                ->rules('required'),

            DateTime::make('Registration end date', 'registration_end')
                ->rules('required'),

            HasMany::make('Attendees', 'attendees', UserEventRegistration::class),
        ];
    }

    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}
