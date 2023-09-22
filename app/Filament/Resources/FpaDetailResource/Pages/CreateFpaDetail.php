<?php

namespace App\Filament\Resources\FpaDetailResource\Pages;

use App\Filament\Resources\FpaDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFpaDetail extends CreateRecord
{
    protected static string $resource = FpaDetailResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
