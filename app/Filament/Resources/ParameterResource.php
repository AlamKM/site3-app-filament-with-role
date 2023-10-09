<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Parameter;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\ParameterResource\Pages;

class ParameterResource extends Resource
{
    protected static ?string $model = Parameter::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';

    protected static ?string $navigationGroup = 'Quality Control';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('parameter')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('unit')
                            ->maxLength(255)
                            ->required()
                            ->default('-')
                            ->helperText('Isikan "-" jika kolom kosong'),
                        Forms\Components\TextInput::make('metode')
                            ->maxLength(255)
                            ->required()
                            ->default('-')
                            ->helperText('Isikan "-" jika kolom kosong'),
                        Forms\Components\TextInput::make('note')
                            ->maxLength(255)
                    ])->columns(2)
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('parameter'),
                Tables\Columns\TextColumn::make('unit'),
                Tables\Columns\TextColumn::make('metode'),
                Tables\Columns\TextColumn::make('note'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-M-y'),
            ])->paginated([10, 25, 50, 100])
            ->filters([
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
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
            'index' => Pages\ListParameters::route('/'),
            'create' => Pages\CreateParameter::route('/create'),
            'edit' => Pages\EditParameter::route('/{record}/edit'),
        ];
    }
}
