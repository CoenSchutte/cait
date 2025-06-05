<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HighlightResource\Pages;
use App\Filament\Resources\HighlightResource\RelationManagers;
use App\Models\Highlight;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class HighlightResource extends Resource
{
    protected static ?string $model = Highlight::class;

    protected static ?string $navigationGroup = 'Content';

    protected static ?string $navigationIcon = 'heroicon-o-star';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')->required(),
            Forms\Components\Select::make('category')->options([
                'Workshop' => 'Workshop',
                'Promo' => 'Promo',
                'Borrel' => 'Borrel',
                'Vacature' => 'Vacature',
                'Activiteit' => 'Activiteit',
                'Nieuws' => 'Nieuws',
                'Overig' => 'Overig',
            ])->required(),

            Forms\Components\Checkbox::make('is_published'),
            Forms\Components\DatePicker::make('event_date')->required(),

            Forms\Components\SpatieMediaLibraryFileUpload::make('Main Image')
                ->label('Main Image')
                ->disk('public')
                ->visibility('public')
                ->maxFiles(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('title'),
            Tables\Columns\TextColumn::make('category'),
            Tables\Columns\IconColumn::make('is_published')->boolean(),
            Tables\Columns\TextColumn::make('event_date')->date(),
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
            'index' => Pages\ListHighlights::route('/'),
            'create' => Pages\CreateHighlight::route('/create'),
            'edit' => Pages\EditHighlight::route('/{record}/edit'),
        ];
    }
}
