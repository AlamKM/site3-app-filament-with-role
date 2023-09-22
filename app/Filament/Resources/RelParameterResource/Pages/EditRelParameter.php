<?php

namespace App\Filament\Resources\RelParameterResource\Pages;

use App\Filament\Resources\RelParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRelParameter extends EditRecord
{
    protected static string $resource = RelParameterResource::class;

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
