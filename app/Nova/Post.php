<?php

namespace App\Nova;

use App\Enums\PostCategory;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
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
    public static $model = \App\Models\Post::class;

    public static $title = 'title';

    public static $group = 'Content';


    public static $search = [
        'id',
        'title',
        'subtitle',
        'category',
    ];

    public function fields(NovaRequest $request)
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
                ->options(
                    collect(PostCategory::cases())->mapWithKeys(fn ($case) => [$case->value => $case->value])
                )
                ->displayUsingLabels()
                ->rules('required')
                ->resolveUsing(fn ($value) => $value) // Pass the raw value to Nova
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    $model->{$attribute} = $request->{$requestAttribute}; // Save the raw value directly
                }),


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
