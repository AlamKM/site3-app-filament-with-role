<?php

namespace App\Filament\Resources\ItemResource\Pages;

use App\Filament\Resources\ItemResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\DB;

class ListItems extends ListRecords
{
    protected static string $resource = ItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Inv' => ListRecords\Tab::make()->query(fn ($query) => $query->where('inv_non_inv', 'Inventory'))->label('Inv')->icon('heroicon-m-check')->badge(DB::table('items')->where('inv_non_inv', 'Inventory')->count()),
            'Non_Inv' => ListRecords\Tab::make()->query(fn ($query) => $query->where('inv_non_inv', 'Non-Inventory'))->label('Non-Inv')->icon('heroicon-m-x-mark')->badge(DB::table('Items')->where('inv_non_inv', 'Non-Inventory')->count()),
            'Finished Goods' => ListRecords\Tab::make()->query(fn ($query) => $query->where('category_id', '3'))->label('FG')->icon('heroicon-m-wallet')->badge(DB::table('items')->where('category_id', '3')->count()),
            'Raw Material' => ListRecords\Tab::make()->query(fn ($query) => $query->where('category_id', '2'))->label('RM')->icon('heroicon-m-wallet')->badge(DB::table('items')->where('category_id', '2')->count()),
            'Packaging Material' => ListRecords\Tab::make()->query(fn ($query) => $query->where('category_id', '1'))->label('PM')->icon('heroicon-m-cube')->badge(DB::table('items')->where('category_id', '1')->count()),
            'Others' => ListRecords\Tab::make()->query(fn ($query) => $query->where('category_id', '4'))->label('Others')->icon('heroicon-m-exclamation-circle')->badge(DB::table('items')->where('category_id', '4')->count()),
            'Hold' => ListRecords\Tab::make()->query(fn ($query) => $query->where('sub_category', 'Hold'))->label('Hold')->icon('heroicon-m-x-circle')->badge(DB::table('items')->where('sub_category', 'Hold')->count()),
        ];
    }
}
