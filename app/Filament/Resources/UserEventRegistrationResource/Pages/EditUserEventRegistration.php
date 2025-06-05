<?php

namespace App\Filament\Resources\UserEventRegistrationResource\Pages;

use App\Filament\Resources\UserEventRegistrationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUserEventRegistration extends EditRecord
{
    protected static string $resource = UserEventRegistrationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
