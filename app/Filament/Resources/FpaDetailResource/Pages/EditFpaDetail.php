<?php

namespace App\Filament\Resources\FpaDetailResource\Pages;

use App\Filament\Resources\FpaDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFpaDetail extends EditRecord
{
    protected static string $resource = FpaDetailResource::class;

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
