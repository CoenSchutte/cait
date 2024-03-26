<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('title')
                    ->label('Titel')
                    ->required()
                    ->placeholder('Titel'),

                Forms\Components\TextInput::make('subtitle')
                    ->label('Ondertitel')
                    ->required()
                    ->placeholder('Ondertitel'),

                Forms\Components\MarkdownEditor::make('body')
                    ->label('Body')
                    ->required()
                    ->placeholder('Body'),

                Forms\Components\Select::make('category')
                    ->label('Categorie')
                    ->options([
                        'Workshop' => 'Workshop',
                        'Promo' => 'Promo',
                        'Borrel' => 'Borrel',
                        'Vacature' => 'Vacature',
                        'Activiteit' => 'Activiteit',
                        'Nieuws' => 'Nieuws',
                        'Overig' => 'Overig',
                    ])
                    ->required(),

                Forms\Components\Checkbox::make('is_published')
                    ->label('Is Gepubliceerd')
                    ->inline()
                    ->default(false),

                Forms\Components\Checkbox::make('is_featured')
                    ->label('Is gefeatured')
                    ->inline()
                    ->default(false),

                Forms\Components\DateTimePicker::make('event_held_at')
                    ->label('Evenement gehouden op')
                    ->required()
                    ->placeholder('Evenement gehouden op'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('Main Image')
                    ->label('Main Image')
                    ->disk('s3')
                    ->visibility('private')
                    ->maxFiles(1),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->label('Titel'),

                Tables\Columns\TextColumn::make('subtitle')
                    ->searchable()
                    ->label('Ondertitel'),

                Tables\Columns\SpatieMediaLibraryImageColumn::make('Main Image')
                    ->label('Main Image')
                    ->disk('s3')
                    ->visibility('private'),

                Tables\Columns\TextColumn::make('category')
                    ->searchable()
                    ->label('Categorie'),

                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Is Gepubliceerd'),

                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean()
                    ->label('Is gefeatured'),

                Tables\Columns\TextColumn::make('event_held_at')
                    ->date('D j M Y H:i')
                    ->searchable()
                    ->label('Evenement gehouden op'),


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
            ])->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
