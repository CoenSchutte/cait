<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventRegistrationResource\Pages;
use App\Filament\Resources\EventRegistrationResource\RelationManagers;
use App\Models\EventRegistration;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;


class EventRegistrationResource extends Resource
{
    protected static ?string $model = EventRegistration::class;

    protected static ?string $navigationGroup = 'Events';

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('post_id')
                ->label('Post')
                ->relationship('event', 'title')
                ->searchable()
                ->required(),

            Forms\Components\TextInput::make('max_attendees')->numeric()->minValue(1),
            Forms\Components\DateTimePicker::make('registration_start')->required(),
            Forms\Components\DateTimePicker::make('registration_end')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('event.title')->label('Event'),
            Tables\Columns\TextColumn::make('max_attendees'),
            Tables\Columns\TextColumn::make('registration_start')->dateTime(),
            Tables\Columns\TextColumn::make('registration_end')->dateTime(),
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
            'index' => Pages\ListEventRegistrations::route('/'),
            'create' => Pages\CreateEventRegistration::route('/create'),
            'edit' => Pages\EditEventRegistration::route('/{record}/edit'),
        ];
    }
}
