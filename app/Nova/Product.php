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

    public static $model = \App\Models\Product::class;

    public static $title = 'id';

    public static $group = 'Content';

    public static $search = [
        'id',
        'name',
        'category',
    ];

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
                ->json()
                ->required(),

            Images::make('Main image', 'images')
                ->conversionOnIndexView('preview')
                ->rules('required')
                ->showStatistics()
                ->temporary(now()->addMinutes(10)),


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
