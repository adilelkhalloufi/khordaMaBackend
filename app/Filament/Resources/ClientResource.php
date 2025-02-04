<?php

namespace App\Filament\Resources;

use App\enum\ProfilStatus;
use App\Filament\Resources\ClientResource\Pages;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make(User::COL_FIRST_NAME)
                    ->label('First Name')
                    ->required()
                    ->placeholder('John'),
                Forms\Components\TextInput::make(User::COL_LAST_NAME)
                    ->label('Last Name')
                    ->required()
                    ->placeholder('John'),
                Forms\Components\TextInput::make(User::COL_EMAIL)
                    ->label('Email')
                    ->required(),
                Forms\Components\TextInput::make(User::COL_PHONE)
                    ->label('Phone')
                    ->required(),
                Select::make(User::COL_STATUS)
                    ->label('Status')

                    ->options(ProfilStatus::class)
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(User::COL_FIRST_NAME)
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(User::COL_LAST_NAME)
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(User::COL_EMAIL)
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make(User::COL_PHONE)
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(function (int $state): string {
                        return ProfilStatus::from($state)->getLabel();
                    })
                    ->color(function (int $state): string {
                        return ProfilStatus::from($state)->getColor();
                    })
                    ->searchable()
                    ->sortable(),

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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
