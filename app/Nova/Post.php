<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Post::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'subtitle',
        'category',
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
            ID::make()->sortable(),

            Text::make('Title', 'title')
                ->rules('required', 'max:255'),

            Text::make('Subtitle', 'subtitle')
                ->rules('required', 'max:255'),

            Markdown::make('Body', 'body')
                ->rules('required'),

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

            Boolean::make('Is Featured', 'is_featured')
                ->default(false),

            DateTime::make('Event held at', 'event_held_at')
                ->nullable(),

            Images::make('Main image') // second parameter is the media collection name
                ->conversionOnIndexView('preview') // conversion used to display the image
                ->rules('required')
                ->showStatistics()
                ->temporary(now()->addMinutes(10)),

            HasOne::make('Registration', 'registration', EventRegistration::class)
                ->nullable(),
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
