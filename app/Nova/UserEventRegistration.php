<?php

namespace App\Nova;

use App\Models\UserEventRegistration as UserEventRegistrationModel;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;

class UserEventRegistration extends Resource
{
    public static $model = UserEventRegistrationModel::class;

    public function title()
    {
        return $this->resource->user->name . ' - ' . $this->resource->eventRegistration->event->title;
    }

    public static $search = [];

    public static $group = 'Events';

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->searchable(),

            BelongsTo::make('Event', 'eventRegistration', EventRegistration::class)
                ->searchable(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }
}
