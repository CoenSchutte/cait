<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdResource\Pages;
use App\Filament\Resources\AdResource\RelationManagers;
use App\Models\Ad;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdResource extends Resource
{
    protected static ?string $model = Ad::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';    
    
    protected static ?string $navigationGroup = 'Content';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('company_name')->label("Bedrijfsnaam")->required()->maxLength(255),
            Forms\Components\TextInput::make('company_url')->label("Website URL")->required(),
            Forms\Components\DatePicker::make('expiration_date')->label("Advertentie expiration date")->required(),
            Forms\Components\SpatieMediaLibraryFileUpload::make('sidebar')
                ->label('Main Image')
                ->disk('public')
                ->visibility('public')
                ->maxFiles(1),

            Forms\Components\SpatieMediaLibraryFileUpload::make('mainbar')
                ->label('Main Image')
                ->disk('public')
                ->visibility('public')
                ->maxFiles(1),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('company_name'),
            Tables\Columns\TextColumn::make('company_url'),
            Tables\Columns\TextColumn::make('expiration_date')->date(),
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
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAd::route('/create'),
            'edit' => Pages\EditAd::route('/{record}/edit'),
        ];
    }
}
