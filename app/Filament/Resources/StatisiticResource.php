<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StatisiticResource\Pages;
use App\Filament\Resources\StatisiticResource\RelationManagers;
use App\Models\Statisitic;
use App\Models\Statistic;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StatisiticResource extends Resource
{

    protected static ?string $model = Statistic::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Landing Page';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Statistic::COL_TITLE),
                TextInput::make(Statistic::COL_DESCRIPTION),
                FileUpload::make(Statistic::COL_ICON),
                TextInput::make(Statistic::COL_TOTAL)->numeric(),
                TextInput::make(Statistic::COL_UNITE)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Statistic::COL_TITLE),
                TextColumn::make(Statistic::COL_DESCRIPTION),
                ImageColumn::make(Statistic::COL_ICON),
                TextColumn::make(Statistic::COL_TOTAL),
                TextColumn::make(Statistic::COL_UNITE),

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
            'index' => Pages\ListStatisitics::route('/'),
            'create' => Pages\CreateStatisitic::route('/create'),
            'edit' => Pages\EditStatisitic::route('/{record}/edit'),
        ];
    }
}
