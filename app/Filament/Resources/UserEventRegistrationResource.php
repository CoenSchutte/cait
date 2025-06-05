<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserEventRegistrationResource\Pages;
use App\Filament\Resources\UserEventRegistrationResource\RelationManagers;
use App\Models\UserEventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserEventRegistrationResource extends Resource
{
    protected static ?string $model = UserEventRegistration::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Events';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('user_id')
                ->relationship('user', 'name')
                ->searchable(),

            Forms\Components\Select::make('event_registration_id')
                ->relationship('eventRegistration', 'id')
                ->searchable(),

            Forms\Components\DateTimePicker::make('created_at')->disabled()->dehydrated(false),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('user.name'),
            Tables\Columns\TextColumn::make('eventRegistration.event.title')->label('Event'),
            Tables\Columns\TextColumn::make('created_at')->dateTime(),
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
            'index' => Pages\ListUserEventRegistrations::route('/'),
            'create' => Pages\CreateUserEventRegistration::route('/create'),
            'edit' => Pages\EditUserEventRegistration::route('/{record}/edit'),
        ];
    }
}
