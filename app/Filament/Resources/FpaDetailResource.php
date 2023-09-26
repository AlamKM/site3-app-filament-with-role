<?php

namespace App\Filament\Resources;

use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Fpa_Detail;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Placeholder;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\FpaDetailResource\Pages;
use App\Filament\Resources\FpaDetailResource\Pages\EditFpaDetail;
use App\Filament\Resources\FpaDetailResource\Pages\ListFpaDetails;
use App\Filament\Resources\FpaDetailResource\Pages\CreateFpaDetail;

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
                                TextInput::make('no_fpa')
                                    ->required()
                                    ->disabled()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('item_id')
                                    ->required()
                                    ->dehydrated()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('no_lot')->required()
                                    ->unique(ignoreRecord: true)
                                    ->disabled(),

                                RichEditor::make('Note')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                    ])
                                    ->columnSpan('full')
                            ])->columns(3),
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
                Tables\Columns\TextColumn::make('no_fpa')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('item_id')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('no_lot')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('status_item')->badge(),

            ])->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->iconButton(),
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
