<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Set;
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
                                                    ->afterStateUpdated(function (Set $set) {
                                                        $set('std_nilai', null);
                                                        $set('note', null);
                                                        $set('metode', null);
                                                        $set('unit', null);
                                                    }),
                                                TextInput::make('std_nilai')
                                                    ->required(),
                                                Select::make('unit')
                                                    // ->options(fn ($get) => Parameter::whereHas('itemParameters', function ($query) use ($get) {
                                                    //     $query->where('parameter_id', $get('parameter_id'));
                                                    // })->pluck('unit', 'id'))
                                                    ->options(function ($get) {
                                                        $parameter_id = $get('parameter_id');
                                                        return Parameter::where('id', $parameter_id)->pluck('unit', 'unit');
                                                    })
                                                    ->required()
                                                    ->native(false),
                                                TextInput::make('note'),
                                                Select::make('metode')
                                                    // ->options(fn ($get) => Parameter::whereHas('itemParameters', function ($query) use ($get) {
                                                    //     $query->where('parameter_id', $get('parameter_id'));
                                                    // })->pluck('metode', 'id'))
                                                    ->options(function ($get) {
                                                        $parameter_id = $get('parameter_id');
                                                        return Parameter::where('id', $parameter_id)->pluck('metode', 'metode');
                                                    })
                                                    ->required()
                                                    ->columnSpanFull()
                                                    ->native(false),
                                            ])->columns(4)
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
                Tables\Columns\TextColumn::make('ItemParameter.parameter.unit')->limit(35)
                    ->label('Unit')
                    ->numeric(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-M-y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->paginated([10, 25, 50, 100])
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
            'edit' => Pages\EditRelParameter::route('/{record}/edit'),
        ];
    }
}
