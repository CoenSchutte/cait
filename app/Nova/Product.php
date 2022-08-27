<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;


class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

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

            Text::make('Naam', 'name')
                ->required(),

            Select::make('Categorie', 'category')
                ->options([
                    'merch' => 'Merchandise',
                    'ticket' => 'Ticket',
                ])
                ->required(),

            Markdown::make('Omschrijving', 'description')
                ->required(),

            Currency::make('Normale prijs', 'normal_price')
                ->currency('EUR')
                ->required(),

            Currency::make('Lid prijs', 'member_price')
                ->currency('EUR')
                ->required(),

            Boolean::make('Beschikbaar', 'is_available'),

            Boolean::make('Weergegeven', 'is_displayed'),

            Number::make('Voorraad', 'stock'),


            Code::make('Options', 'options')
                ->language('json')
                ->required(),

            Images::make('Main image', 'images')
                ->conversionOnIndexView('preview')
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
