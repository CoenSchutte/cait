<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Invoice extends Resource
{
    public static $model = \App\Models\Invoice::class;

    public static $title = 'id';

    public static $search = [
        'id', 'product'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Text::make('Product', 'product')
                ->required()
                ->sortable(),

            Text::make('Categorie', 'category')
                ->required()
                ->sortable(),

            Select::make('Status', 'status')
                ->options([
                    'betaald' => 'Betaald',
                    'afgeleverd' => 'Afgeleverd',
                ])
                ->displayUsingLabels()
                ->required()
                ->sortable(),

            BelongsTo::make('User', 'user', User::class)
                ->required()
                ->sortable(),

            Currency::make('Prijs', 'price')
                ->currency('EUR')
                ->required(),

            DateTime::make('Created At', 'created_at')
                ->sortable()
                ->hideWhenCreating(),

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
