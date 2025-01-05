<?php

namespace App\Filament\Resources;

use App\Filament\Imports\UniteImporter;
use App\Filament\Resources\UniteResource\Pages;
use App\Filament\Resources\UniteResource\RelationManagers;
use App\Models\Unite;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UniteResource extends Resource
{
    use Translatable;

    protected static ?string $model = Unite::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Unite::COL_NAME),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Unite::COL_NAME),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // ->headerActions([
            //     Tables\Actions\ImportAction::make()
            //         ->importer(UniteImporter::class)
            // ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\LocaleSwitcher::make(),

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
            'index' => Pages\ListUnites::route('/'),
            'create' => Pages\CreateUnite::route('/create'),
            'edit' => Pages\EditUnite::route('/{record}/edit'),
        ];
    }
}
