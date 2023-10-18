<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Hash;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Phpsa\FilamentPasswordReveal\Password;
use Filament\Forms\Components\CheckboxList;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Filament\Resources\UserResource\Pages\CreateUser;
use App\Filament\Resources\UserResource\RelationManagers\RolesRelationManager;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Admin Management';

    //protected static bool $shouldRegisterNavigation = false;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->label('Input Name')
                            ->autofocus(),
                        Forms\Components\TextInput::make('nik')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(8)
                            ->label('NIK'),
                        Forms\Components\Select::make('departement')
                            ->options([
                                'warehouse' => 'Warehouse',
                                'Production' => 'Production',
                                'Quality Control' => 'Quality Control',
                                'SHE' => 'SHE',
                                'PPIC' => 'PPIC',
                                'Document Control' => 'Document Control',
                                'HRD/GA' => 'HRD/GA',
                                'Maintenance' => 'Maintenance',
                            ])
                            ->required()
                            ->native(false)
                            ->label('Departement'),
                        Forms\Components\TextInput::make('email')
                            ->required()
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('use "@salimagro.com"')
                            ->label('Email Company'),
                        Password::make('password')
                            ->password()
                            ->dehydrateStateUsing(static fn (null|string $state): null|string => filled($state) ? Hash::make($state) : null,)
                            ->required(static fn (Page $livewire): string => $livewire instanceof CreateUser,)
                            ->dehydrated(static fn (null|string $state): bool => filled($state))
                            ->label(static fn (Page $livewire): string => ($livewire instanceof EditUser) ? 'New Password' : 'Password')
                            ->showIcon('heroicon-o-eye')
                            ->hideIcon('heroicon-o-eye-open'),
                        Forms\Components\Toggle::make('is_admin'),
                    ])->columns([
                        'sm' => 2
                    ]),

                Forms\Components\Section::make()
                    ->schema([
                        CheckboxList::make('roles')
                            ->relationship('roles', 'name')
                            ->columns(2)
                            ->helperText('Hanya boleh pilih salah satu!')
                            ->required(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('No')
                    ->rowIndex(),
                Tables\Columns\TextColumn::make('name'),
                Tables\Columns\IconColumn::make('is_admin')
                    ->boolean()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime('d-M-y')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime('d-M-y')
                    ->sortable()
                    ->searchable(),
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
            //RolesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
