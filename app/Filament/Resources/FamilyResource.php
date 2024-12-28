<?php

namespace App\Filament\Resources;

use App\Filament\Imports\FamilyImporter;
use App\Filament\Resources\FamilyResource\Pages;
use App\Filament\Resources\FamilyResource\RelationManagers;
use App\Models\Family;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ImportAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FamilyResource extends Resource
{
    use Translatable;

    protected static ?string $model = Family::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Family::COL_NAME)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Family::COL_NAME)
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),

            ])
            ->headerActions([
                ImportAction::make()
                    ->importer(FamilyImporter::class)
            ])
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
            'index' => Pages\ListFamilies::route('/'),
            'create' => Pages\CreateFamily::route('/create'),
            'edit' => Pages\EditFamily::route('/{record}/edit'),
        ];
    }
}
