<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\ItemResource\Pages;

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Warehouse';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('item_code')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\TextInput::make('item_name')
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Select::make('category_id')
                            ->preload()
                            ->required()
                            ->relationship('category_item', 'category')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('category_id')
                                    ->required()
                                    ->maxLength(255)
                            ]),
                        Forms\Components\Select::make('inv_non_inv')
                            ->preload()
                            ->label('Inv/Non-Inv')
                            ->required()
                            ->options([
                                'Inventory' => 'Inventory',
                                'Non-Inventory' => 'Non-Inventory',
                            ]),
                        Forms\Components\TextInput::make('sub_category')
                            ->maxLength(255)
                            ->required()
                            ->helperText('Masukkan "-" jika dikosongkan'),
                        Forms\Components\Select::make('unit')
                            ->preload()
                            ->required()
                            ->options([
                                'Kgs' => 'Kgs',
                                'Pcs' => 'Pcs',
                                'Rolls' => 'Rolls',
                                'Ltr' => 'Ltr',
                            ]),
                        Forms\Components\TextInput::make('note')
                            ->maxLength(255),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')->rowIndex(),
                Tables\Columns\TextColumn::make('item_code')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('item_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('inv_non_inv')->searchable()->sortable()->label('Inv/Non-Inv')->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Inventory' => 'success',
                        'Non-Inventory' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('category_item.category')->searchable()->sortable()->label('Category'),
                Tables\Columns\TextColumn::make('sub_category')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('unit')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('note'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d-M-y')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d-M-y')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListItems::route('/'),
            // 'create' => Pages\CreateItem::route('/create'),
            // 'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
