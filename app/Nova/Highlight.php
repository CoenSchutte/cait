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
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Highlight::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
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

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
