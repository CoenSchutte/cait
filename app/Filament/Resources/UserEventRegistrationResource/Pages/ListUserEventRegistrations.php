<?php

namespace App\Filament\Resources\UserEventRegistrationResource\Pages;

use App\Filament\Resources\UserEventRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUserEventRegistrations extends ListRecords
{
    protected static string $resource = UserEventRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
