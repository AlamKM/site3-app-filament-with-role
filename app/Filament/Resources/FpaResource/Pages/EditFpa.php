<?php

namespace App\Filament\Resources\FpaResource\Pages;

use App\Filament\Resources\FpaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFpa extends EditRecord
{
    protected static string $resource = FpaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
