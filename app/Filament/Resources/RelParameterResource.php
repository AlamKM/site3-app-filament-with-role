<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Parameter;
use Filament\Tables\Table;
use App\Models\RelParameter;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\RelParameterResource\Pages;

class RelParameterResource extends Resource
{
    protected static ?string $model = RelParameter::class;

    protected static ?string $navigationIcon = 'heroicon-o-arrow-path-rounded-square';

    protected static ?string $navigationGroup = 'Quality Control';

    protected static ?string $navigationLabel = 'Relasi Item Parameter';

    protected static ?string $modelLabel = 'Relasi Parameter';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make()
                            ->description('Tentukan beberapa pilihan parameter untuk masing-masing item')
                            ->icon('heroicon-m-magnifying-glass-circle')
                            ->columns()
                            ->schema([
                                Select::make('item_id')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->searchable()
                                    ->preload()
                                    ->relationship('item', 'item_name'),
                            ]),
                        Section::make('Item Parameter')
                            ->label('Parameter')
                            ->icon('heroicon-m-beaker')
                            ->schema([
                                Card::make()
                                    ->schema([
                                        Repeater::make('ItemParameter')
                                            ->disableLabel()
                                            ->relationship()
                                            ->schema([
                                                Select::make('parameter_id')
                                                    ->label('Parameter')
                                                    ->options(Parameter::query()->pluck('parameter', 'id'))
                                                    ->required()
                                                    ->searchable()
                                                    ->helperText('Click "Add to item parameter" jika lebih dari satu parameter'),
                                                //->columnSpan(['md' => 5]),
                                                TextInput::make('std_nilai'),
                                                TextInput::make('note'),
                                            ])->columns(3)
                                    ])
                            ])
                    ])->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')->rowIndex()->label('No'),
                Tables\Columns\TextColumn::make('Item.item_code')
                    ->label('Item Code')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('Item.item_name')
                    ->label('Item Name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ItemParameter.parameter.parameter')->limit(35)
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
                TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                Tables\Actions\DeleteAction::make()->iconButton(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make()->label('Create New Item Parameter'),
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
            //'edit' => Pages\EditRelParameter::route('/{record}/edit'),
        ];
    }
}
