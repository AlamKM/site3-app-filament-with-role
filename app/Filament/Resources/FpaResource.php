<?php

namespace App\Filament\Resources;

use App\Models\Fpa;
use Filament\Forms;
use App\Models\Item;
use Filament\Tables;
use App\Models\Purchase;
use Filament\Forms\Form;
use App\Models\Parameter;
use Filament\Tables\Table;
use App\Models\RelParameter;
use App\Models\ItemParameter;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\FpaResource\Pages;

class FpaResource extends Resource
{
    protected static ?string $model = Fpa::class;

    protected static ?string $navigationLabel = 'FPA';

    protected static ?string $navigationIcon = 'heroicon-o-folder';

    protected static ?string $navigationGroup = 'Quality Control';

    protected static ?string $modelLabel = 'FPA List';

    protected static array $statuses = [
        'Accepted' => 'Accepted',
        'Reject' => 'Reject',
        'Use as is' => 'Use as is',
        'Waiting' => 'Waiting',
    ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->columns([
                        'sm' => 3,
                    ])->columnSpan([
                        'sm' => 4
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('no_fpa')
                            ->maxLength(255)
                            ->disabled()
                            ->default(function () {
                                $lastFpa = Fpa::max('no_fpa'); // Get the last FPA number
                                $nextNumber = $lastFpa ? (int) substr($lastFpa, 4) + 1 : 1; // Extract and increment the number part
                                return 'FPA-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT); // Pad with leading zeros if necessary
                            })
                            ->unique(ignoreRecord: true),
                        Forms\Components\Hidden::make('no_fpa')
                            ->default(function () {
                                $lastFpa = Fpa::max('no_fpa'); // Get the last FPA number
                                $nextNumber = $lastFpa ? (int) substr($lastFpa, 4) + 1 : 1; // Extract and increment the number part
                                return 'FPA-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT); // Pad with leading zeros if necessary
                            })
                            ->unique(ignoreRecord: true),
                        Select::make('category_item_id')
                            ->label('Category')
                            ->relationship('category_item', 'category')
                            ->searchable()
                            ->disabled(auth()->user()->name === 'admin')
                            ->required()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('category')
                                    ->required()
                                    ->maxLength(255)
                            ]),
                        Select::make('purchase_id')
                            //->relationship('purchase', 'no_po')
                            ->searchable()
                            ->disabled(auth()->user()->name === 'admin')
                            ->required()
                            ->options(function () {
                                return Purchase::whereNotNull('no_po')
                                    ->orWhere('no_po', '1')
                                    ->pluck('no_po', 'id');
                            })
                            ->live()
                            ->label('NO PO'),
                        Select::make('item_id')
                            ->options(fn ($get) => Item::whereHas('purchaseItems', function ($query) use ($get) {
                                $query->where('purchase_id', $get('purchase_id'));
                            })->pluck('item_name', 'id'))
                            ->preload()
                            ->disabled(auth()->user()->name === 'admin')
                            ->required()
                            ->searchable()
                            ->label('Item Name'),
                        Forms\Components\TextInput::make('no_lot')
                            ->maxLength(255)
                            ->required()
                            ->disabled(auth()->user()->name === 'admin')
                            ->unique(ignoreRecord: true),
                        Forms\Components\TextInput::make('note')
                            ->disabled(auth()->user()->name === 'admin'),
                        Forms\Components\Hidden::make('create_by')
                            ->default(auth()->user()->name),
                        Forms\Components\Hidden::make('status_item')
                            ->default('Waiting'),
                        Forms\Components\Radio::make('status_item')
                            ->options(self::$statuses)
                            ->visible(auth()->user()->name === 'admin')
                    ]),
                Forms\Components\Section::make('Parameter')
                    ->visible(auth()->user()->name === 'admin')
                    ->label('Parameter')
                    ->icon('heroicon-m-beaker')
                    ->schema([
                        Card::make()
                            ->schema([
                                Repeater::make('fpa_details')
                                    ->label('Analysis Results')
                                    ->relationship()
                                    ->schema([
                                        Select::make('parameter')
                                            ->default(NULL)
                                            ->label('Parameter')
                                            ->options(Parameter::query()->pluck('parameter', 'id'))
                                            ->searchable()
                                            ->columnSpan([
                                                'sm' => 1,
                                            ]),
                                        //->helperText('Click "Add to item parameter" jika lebih dari satu parameter'),
                                        TextInput::make('hasil_analisa'),
                                        TextInput::make('unit'),
                                        TextInput::make('std_parameter')
                                            ->label('Standard'),
                                        TextInput::make('note')
                                            ->columnSpan([
                                                'sm' => 2,
                                            ]),
                                        Forms\Components\DatePicker::make('tgl_analisa')
                                            ->default(now())
                                            ->required(),
                                        TextInput::make('qc_analis')
                                            ->default(auth()->user()->name)
                                            ->visible(auth()->user()->name === 'admin'),
                                    ])
                                    ->columns(4)
                                    ->defaultItems(1)
                            ])
                    ])
            ])->columns([
                'sm' => 4,
                'lg' => null,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime('d - M - Y'),
                Tables\Columns\TextColumn::make('no_fpa')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('item.item_name')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('no_lot')->searchable()->sortable()->limit(35),
                Tables\Columns\TextColumn::make('status_item')->badge(),
                Tables\Columns\TextColumn::make('note')->limit(35),
                Tables\Columns\TextColumn::make('fpa_details.qc_analis')->label('Analyst By'),
                Tables\Columns\TextColumn::make('purchases.name')->label('Created By'),
            ])->defaultSort('created_at', 'desc')
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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'] ?? null,
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
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
            'index' => Pages\ListFpas::route('/'),
            'create' => Pages\CreateFpa::route('/create'),
            'edit' => Pages\EditFpa::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
