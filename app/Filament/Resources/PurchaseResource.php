<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use App\Models\Purchase;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\PurchaseResource\Pages;

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
                                    ->native(false)
                                    ->default(now()),
                                Forms\Components\TextInput::make('no_pr')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->label('NO PR'),
                                Forms\Components\TextInput::make('no_po')
                                    ->required()
                                    ->default(NULL)
                                    ->unique(ignoreRecord: true)
                                    ->label('NO PO'),
                                Forms\Components\DatePicker::make('req_date')
                                    ->default(now())
                                    ->native(false)
                                    ->required(),
                            ])->columns(['sm' => 2]),

                        Forms\Components\Card::make()
                            ->schema([
                                Forms\Components\Placeholder::make('Product Name'),
                                Forms\Components\Repeater::make('PurchaseItem')
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
                Tables\Columns\TextColumn::make('index')->rowIndex()->label('No'),
                Tables\Columns\TextColumn::make('date')->date()->sortable(),
                Tables\Columns\TextColumn::make('no_pr')->label('NO PR'),
                Tables\Columns\TextColumn::make('no_po')->label('NO PO'),
                Tables\Columns\TextColumn::make('purchaseItem.item.item_name')->label('Item Name')->limit(35),
                Tables\Columns\TextColumn::make('req_date')->date(),
                Tables\Columns\TextColumn::make('user.name')->label('Created By'),
            ])
            ->defaultSort('date', 'desc')
            ->paginated([10, 25, 50, 100])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y'))->default(now()->startOfMonth())
                            ->native(false),
                        Forms\Components\DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y'))->default(now()->endOfMonth())
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('date', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators['created_from'] = 'Order from ' . Carbon::parse($data['created_from'])->toFormattedDateString();
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators['created_until'] = 'Order until ' . Carbon::parse($data['created_until'])->toFormattedDateString();
                        }

                        return $indicators;
                    }),
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
            'index' => Pages\ListPurchases::route('/'),
            'create' => Pages\CreatePurchase::route('/create'),
            // 'edit' => Pages\EditPurchase::route('/{record}/edit'),
        ];
    }
}
