<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Parameter;
use Filament\Tables\Table;
use App\Models\RelParameter;
use Filament\Resources\Resource;
use Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Support\Enums\FontFamily;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\RelParameterResource\Pages;

class RelParameterResource extends Resource
{
    protected static ?string $model = RelParameter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Quality Control';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->description('Tentukan beberapa pilihan parameter untuk masing-masing item')
                            ->icon('heroicon-m-beaker')
                            ->columns()
                            ->schema([
                                Select::make('item_id')
                                    ->required()
                                    ->searchable()
                                    ->preload()
                                    ->relationship('item', 'item_name'),
                            ]),
                        Section::make()
                            ->description('Tentukan beberapa pilihan parameter untuk masing-masing item')
                        Forms\Components\Repeater::make('rel_parameter')
                            ->relationship()
                            ->schema([
                                CheckboxList::make('rel_parameter')
                                    ->options([
                                        'tailwind' => 'Tailwind CSS',
                                        'alpine' => 'Alpine.js',
                                        'laravel' => 'Laravel',
                                        'livewire' => 'Laravel Livewire',
                                    ])
                                //->options(Parameter::query()->pluck('parameter', 'id'))
                            ])
                    ])->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('Item.item_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Parameter.parameter')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
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
            'index' => Pages\ListRelParameters::route('/'),
            'create' => Pages\CreateRelParameter::route('/create'),
            'edit' => Pages\EditRelParameter::route('/{record}/edit'),
        ];
    }
}
