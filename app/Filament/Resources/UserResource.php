<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

// use datepicker
use Filament\Forms\Components\DatePicker;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Naam')
                    ->required()
                    ->placeholder('John Doe'),

                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->required()
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->placeholder('user@email.com'),

                Forms\Components\TextInput::make('student_number')
                    ->label('Student nummer')
                    ->required()
                    ->maxLength(7)
                    ->placeholder('1234567'),

                DatePicker::make('birthdate')
                    ->label('Geboortedatum')
                    ->maxDate(now()),


                Forms\Components\Checkbox::make('is_admin')
                    ->label('Is Admin')
                    ->inline()
                    ->default(false),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Name'),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->label('Email'),

                Tables\Columns\TextColumn::make('student_number')
                    ->searchable()
                    ->label('Student Number'),

                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean()
                    ->label('Is Admin'),

                Tables\Columns\IconColumn::make('hasSubscription')
                    ->label('Heeft lopend abonnement')
                    ->boolean()
                    ->getStateUsing(function ($record) {
                        return $record->hasSubscription();
                    }),

                Tables\Columns\TextColumn::make('member_until')
                    ->date('d M Y')
                    ->searchable()
                    ->label('Lid tot'),

//                Tables\Columns\TextColumn::make('birthdate')
//                    ->date('d M Y')
//                    ->searchable()
//                    ->label('Geboortedatum'),


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
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\InvoicesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public function getHasSubscriptionAttribute(): bool
    {
        return $this->record->hasSubscription();
    }
}
