<?php

namespace App\Nova;

use App\Models\UserEventRegistration as UserEventRegistrationModel;
use App\Nova\Metrics\NewRegistrations;
use App\Nova\Metrics\RegistrationsPerDay;
use App\Nova\Metrics\RegistrationsPerEvent;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserEventRegistration extends Resource
{
    public static $model = UserEventRegistrationModel::class;

    public function title()
    {
        return $this->resource->user->name . ' - ' . $this->resource->eventRegistration->event->title;
    }

    public static $search = [];

    public static $group = 'Events';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->searchable(),

            BelongsTo::make('Event', 'eventRegistration', EventRegistration::class)
                ->searchable(),

            //created at
            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->hideWhenCreating(),

        ];
    }

    public function cards(NovaRequest $request)
    {
        return [
            new NewRegistrations(),
            new RegistrationsPerDay(),
            new RegistrationsPerEvent()
        ];
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
