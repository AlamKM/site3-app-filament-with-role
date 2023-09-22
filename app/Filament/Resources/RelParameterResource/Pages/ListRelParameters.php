<?php

namespace App\Filament\Resources\RelParameterResource\Pages;

use App\Filament\Resources\RelParameterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelParameters extends ListRecords
{
    protected static string $resource = RelParameterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create New'),
        ];
    }
}
