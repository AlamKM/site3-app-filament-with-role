<?php

namespace App\Filament\Resources\RelParameterResource\Pages;

use App\Filament\Resources\RelParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRelParameter extends CreateRecord
{
    protected static string $resource = RelParameterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
