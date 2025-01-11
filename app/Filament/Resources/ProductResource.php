<?php

namespace App\Filament\Resources;

use App\enum\ProductStatus;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Unite;
use App\Models\Categorie;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Product::COL_NAME),
                Tiny::make(Product::COL_DESCRIPTION)->type("text"),
                TextInput::make(Product::COL_QUANTITY)->numeric(),
                TextInput::make(Product::COL_PRICE)->numeric(),
                Select::make(Product::COL_CATEGORIE_ID)
                    ->label('Categorie')
                    ->options(Categorie::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make(Product::COL_UNITE_ID)
                    ->label('Unite')
                    ->options(Unite::all()->pluck('name', 'id'))
                    ->searchable(),
                Select::make(Product::COL_STATUE)
                    ->label('Statue')
                    ->options(collect(ProductStatus::cases())->mapWithKeys(function ($status) {
                        return [$status->value => $status->label()]; // Use a label() method for better readability
                    }))->default(ProductStatus::Pending)
                    ->searchable(),
                FileUpload::make('attachments')
                    ->label('Attachments')
                    ->multiple()
                    ->directory('product-attachments')
                    ->maxSize(10240)
                    ->acceptedFileTypes(['image/*', 'application/pdf']),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Product::COL_NAME)
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                TextColumn::make(Product::COL_DESCRIPTION)
                    ->label('Description')
                    ->sortable()
                    ->searchable(),

                TextColumn::make(Product::COL_QUANTITY)
                    ->label('Quantity')
                    ->sortable(),

                TextColumn::make(Product::COL_PRICE)
                    ->label('Price')
                    ->money()
                    ->sortable(),

                TextColumn::make(Product::COL_STATUE)
                    ->label('Status')
                    ->formatStateUsing(fn(ProductStatus $status) => $status->label())
                    ->sortable()

            ])
            ->filters([])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
