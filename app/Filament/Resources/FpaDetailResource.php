<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FpaDetailResource\Pages;
use App\Filament\Resources\FpaDetailResource\RelationManagers;
use App\Models\Fpa_Detail;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FpaDetailResource extends Resource
{
    protected static ?string $model = Fpa_Detail::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Quality Control';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]);
        // ->bulkActions([
        //     Tables\Actions\DeleteBulkAction::make(),
        // ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFpaDetails::route('/'),
            'create' => Pages\CreateFpaDetail::route('/create'),
            'edit' => Pages\EditFpaDetail::route('/{record}/edit'),
        ];
    }
}
