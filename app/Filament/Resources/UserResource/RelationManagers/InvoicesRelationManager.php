<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('product')
            ->columns([
                Tables\Columns\TextColumn::make('product')
                    ->label('Product'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Beschrijving'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Categorie'),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status'),
                Tables\Columns\TextColumn::make('price')
                    ->label('Prijs'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
