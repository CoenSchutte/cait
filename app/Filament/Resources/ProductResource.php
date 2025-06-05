<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use ValentinMorice\FilamentJsonColumn\FilamentJsonColumn;


class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';
    
    protected static ?string $navigationGroup = 'Content';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')->required(),
            
            Forms\Components\Select::make('category')->options([
                'merch' => 'Merchandise',
                'ticket' => 'Ticket',
            ])->required(),


            Forms\Components\TextInput::make('normal_price')->numeric()->required(),
            Forms\Components\TextInput::make('member_price')->numeric()->required(),

            Forms\Components\MarkdownEditor::make('description')->required(),

            FilamentJsonColumn::make('options')
                ->label('Options'),
            

            Forms\Components\TextInput::make('stock')->numeric(),


            Forms\Components\SpatieMediaLibraryFileUpload::make('images')
                ->collection('images')
                ->conversion('preview')
                ->required()
                ->multiple()
                ->disk('public')
                ->visibility('public'),

            Forms\Components\Checkbox::make('is_available')->columnSpanFull(),
            Forms\Components\Checkbox::make('is_displayed'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name'),
            Tables\Columns\TextColumn::make('category'),
            Tables\Columns\IconColumn::make('is_available')->boolean(),
            Tables\Columns\IconColumn::make('is_displayed')->boolean(),
            Tables\Columns\TextColumn::make('stock'),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
