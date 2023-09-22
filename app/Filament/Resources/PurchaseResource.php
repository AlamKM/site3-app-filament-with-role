<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use App\Models\Purchase;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\PurchaseResource\Pages;
use App\Filament\Resources\PurchaseResource\RelationManagers;

class PurchaseResource extends Resource
{
    protected static ?string $model = Purchase::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Purchase';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()
                    ->schema([
                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\DatePicker::make('date')
                                    ->required()
                                    ->default(now()),
                                Forms\Components\TextInput::make('no_pr')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('NO PR'),
                                Forms\Components\TextInput::make('no_po')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('NO PO'),
                                Forms\Components\DatePicker::make('req_date')
                                    ->default(now())
                                    ->required(),
                            ])->columns(['sm' => 2]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('Product Name'),
                                Forms\Components\Repeater::make('purchaseItem')
                                    ->relationship()
                                    ->schema([
                                        Forms\Components\Select::make('item_id')
                                            ->label('Item Code')
                                            ->options(Item::query()->pluck('item_name', 'id'))
                                            ->required()
                                            ->searchable()
                                            ->columnSpan(['md' => 5]),
                                        Forms\Components\TextInput::make('quantity')
                                            ->numeric()
                                            ->required()
                                            ->columnSpan(['md' => 2]),
                                        Forms\Components\TextInput::make('notes')
                                            ->columnSpan(['md' => 3]),
                                    ])
                                    ->defaultItems(1)
                                    ->columns(['md' => 10])
                                    ->columnSpan('full')
                            ]),
                    ])->columnSpan('full')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('no_pr')->label('NO PR'),
                Tables\Columns\TextColumn::make('no_po')->label('NO PO'),
                Tables\Columns\TextColumn::make('purchaseItem.item.item_name')->label('Item Name')->limit(35),
                Tables\Columns\TextColumn::make('req_date')->date(),
                Tables\Columns\TextColumn::make('user.name')->label('Created By'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            // 'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
