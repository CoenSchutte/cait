<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('product')
                    ->label('Product')
                    ->required()
                    ->placeholder('Product name'),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->placeholder('Description'),

                Forms\Components\TextInput::make('category')
                    ->label('Categorie')
                    ->required()
                    ->placeholder('Categorie'),

                Forms\Components\Select::make('status')
                    ->label('Status')
                    ->options([
                        'betaald' => 'Betaald',
                        'afgeleverd' => 'Afgeleverd',
                    ])
                    ->required(),

                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->placeholder('Price'),

                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship(name: 'user', titleAttribute: 'name')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product'),
                Tables\Columns\TextColumn::make('description'),
                Tables\Columns\TextColumn::make('category'),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('price'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
