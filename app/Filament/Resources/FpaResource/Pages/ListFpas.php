<?php

namespace App\Filament\Resources\FpaResource\Pages;;

use Filament\Pages\Actions;
use App\Filament\Resources\FpaResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListFpas extends ListRecords
{
    protected static string $resource = FpaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Create New FPA'),
        ];
    }

    public function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),


            'Waiting' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status_item', 'Waiting'))->label('By Waiting')->icon('heroicon-m-clock')->badge(DB::table('fpas')->where('status_item', 'Waiting')->count()),
            'Accepted' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status_item', 'Accepted'))->label('By Accepted')->icon('heroicon-m-check'),
            'Reject' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status_item', 'Reject'))->label('By Rejected')->icon('heroicon-m-no-symbol'),
            'Use as is' => ListRecords\Tab::make()->query(fn ($query) => $query->where('status_item', 'Use as is'))->label('By Use as is')->icon('heroicon-m-exclamation-triangle'),
        ];
    }
}
