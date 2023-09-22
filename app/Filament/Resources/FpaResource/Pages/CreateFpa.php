<?php

namespace App\Filament\Resources\FpaResource\Pages;

use App\Filament\Resources\FpaResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFpa extends CreateRecord
{
    protected static string $resource = FpaResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
