<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Ad extends Resource
{
    public static $model = \App\Models\Ad::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Company Name', 'company_name')
                ->rules('required', 'max:255'),

            Text::make('Company URL', 'company_url')
                ->rules('required'),

            Date::make('Expiration date', 'expiration_date')
                ->rules('required'),

            Images::make('vertical', 'sidebar') // second parameter is the media collection name
                ->conversionOnIndexView('preview') // conversion used to display the image
                ->showStatistics()
                ->temporary(now()->addMinutes(10)),

            Images::make('horizontal', 'mainbar') // second parameter is the media collection name
                ->conversionOnIndexView('preview') // conversion used to display the image
                ->showStatistics()
                ->temporary(now()->addMinutes(10)),
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
