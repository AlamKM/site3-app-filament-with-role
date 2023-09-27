<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Fpa_Detail;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use App\Filament\Resources\FpaDetailResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FpaDetailResource extends Resource
{
    protected static ?string $model = Fpa_Detail::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Quality Control';

    protected static ?string $navigationLabel = 'FPA Details';

    protected static ?string $modelLabel = 'FPA Details';

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
                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                RepeatableEntry::make('fpa')
                                    ->schema([
                                        TextEntry::make('no_fpa'),
                                        TextEntry::make('item_id'),
                                        TextEntry::make('no_lot')
                                            ->columnSpan(2),
                                    ])
                                // TextInput::make('no_fpa')
                                //     ->required()
                                //     ->disabled(),

                                // TextInput::make('item_id')
                                //     ->required()
                                //     ->disabled(),

                                // TextInput::make('no_lot')->required()
                                //     ->disabled()
                                //     ->required(),

                                // TextInput::make('note')
                                //     ->columnSpan('full'),
                            ])->columns(3),

                        Card::make()
                            ->schema([
                                Placeholder::make('')
                                    ->label('Hasil Analisa Tiap-tiap Parameter'),
                                //TextInput::make('parameter'),
                                TextInput::make('std_parameter'),
                                TextInput::make('unit'),
                                TextInput::make('hasil_analisa'),
                                TextInput::make('qc_analis'),
                                DatePicker::make('tgl_analisa')
                                    ->label('Tanggal Analisa')
                                    ->default(now())
                                    ->required(),
                                DatePicker::make('tgl_input')
                                    ->label('Tanggal Input')
                                    ->default(now())
                                    ->required(),
                            ]),
                    ])->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Select::make('status_item')
                                    ->options(self::$statuses)
                                    ->visible(auth()->user()->name === 'admin'),
                            ])
                    ])->columnSpan(['lg' => 1]),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('created_at')->label('Date')->dateTime('d - M - Y'),
                Tables\Columns\TextColumn::make('no_fpa')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('item.item_name')->searchable()->sortable()->limit(25),
                Tables\Columns\TextColumn::make('no_lot')->searchable()->sortable()->limit(25),
                Tables\Columns\TextColumn::make('status_item')->badge(),
                Tables\Columns\TextColumn::make('note')->limit(35),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TrashedFilter::make(),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')
                            ->placeholder(fn ($state): string => 'Dec 18, ' . now()->subYear()->format('Y'))->default(now()->startOfMonth()),
                        DatePicker::make('created_until')
                            ->placeholder(fn ($state): string => now()->format('M d, Y'))->default(now()->endOfMonth()),
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
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
                //Tables\Actions\DeleteAction::make()->iconButton(),
                //Tables\Actions\ForceDeleteAction::make(),
                //Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListFpaDetails::route('/'),
            'create' => Pages\CreateFpaDetail::route('/create'),
            'edit' => Pages\EditFpaDetail::route('/{record}/edit'),
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
