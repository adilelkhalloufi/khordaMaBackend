<?php

namespace App\Filament\Resources;

use App\Filament\Imports\CategoryImporter;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\TranslationsResource\RelationManagers\TranslationsRelationManager;
use App\Models\Categorie;
use App\Models\Family;
use Filament\Actions\ImportAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = Categorie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Settings';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Categorie::COL_NAME),
                TextInput::make(Categorie::COL_DESCRIPTION),
                TextInput::make(Categorie::COL_IMAGE),
                TextInput::make(Categorie::COL_DISPLAY)->minValue(1)
                    ->maxValue(100),
                Select::make(Categorie::COL_FAMILY_ID)
                    ->label('Family')
                    ->options(Family::all()->pluck('name', 'id'))
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Categorie::COL_NAME)->searchable(),
                TextColumn::make(Categorie::COL_DESCRIPTION)->searchable(),
                ImageColumn::make(Categorie::COL_IMAGE),
                TextColumn::make(Categorie::COL_DISPLAY)->numeric(),
                TextColumn::make("family.name")
                    ->label('Family')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            // ->headerActions([
            //     Tables\Actions\ImportAction::make()
            //         ->importer(CategoryImporter::class)
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
