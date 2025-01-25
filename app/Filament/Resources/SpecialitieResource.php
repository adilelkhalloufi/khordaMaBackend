<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialitieResource\Pages;
use App\Filament\Resources\SpecialitieResource\RelationManagers;
use App\Models\Specialitie;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SpecialitieResource extends Resource
{
    use Translatable;

    protected static ?string $model = Specialitie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Specialitie::COL_NAME),
                Select::make(Specialitie::COL_TYPE)
                    ->options([
                        'Buyer' => 2,
                        'Seller' => 3,

                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make(Specialitie::COL_NAME)->searchable(),
                Tables\Columns\TextColumn::make(Specialitie::COL_TYPE)->searchable(),
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
            'index' => Pages\ListSpecialities::route('/'),
            'create' => Pages\CreateSpecialitie::route('/create'),
            'edit' => Pages\EditSpecialitie::route('/{record}/edit'),
        ];
    }
}
