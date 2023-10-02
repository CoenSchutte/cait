<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Highlight extends Resource
{

    public static $model = \App\Models\Highlight::class;

    public static $title = 'id';

    public static $search = [
        'id',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Title', 'title')
                ->rules('required', 'max:255'),

            Select::make('Category', 'category')
                ->options([
                    'Workshop' => 'Workshop',
                    'Promo' => 'Promo',
                    'Borrel' => 'Borrel',
                    'Vacature' => 'Vacature',
                    'Activiteit' => 'Activiteit',
                    'Nieuws' => 'Nieuws',
                    'Overig' => 'Overig',
                ])
                ->rules('required'),

            Boolean::make('Is Published', 'is_published')
                ->default(false),

            Date::make('Event Date', 'event_date')
                ->rules('required'),

            Images::make('Main image') // second parameter is the media collection name
            ->conversionOnIndexView('preview') // conversion used to display the image
            ->rules('required')
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
