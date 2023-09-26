<?php

namespace App\Filament\Resources\FpaDetailResource\Pages;

use App\Filament\Resources\FpaDetailResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFpaDetails extends ListRecords
{
    protected static string $resource = FpaDetailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
