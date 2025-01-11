<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Unite;
use App\Models\Categorie;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;

use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\TextInput::make(Product::COL_NAME),
                Forms\Components\TextInput::make(Product::COL_DESCRIPTION),
                Forms\Components\TextInput::make(Product::COL_QUANTITY)->numeric(),
                Forms\Components\Select::make(Product::COL_CATEGORIE_ID)
                ->label('Categorie')
                ->options(Categorie::all()->pluck('name', 'id'))
                ->searchable(),
                Forms\Components\Select::make(Product::COL_UNITE_ID)
                    ->label('Unite')
                    ->options(Unite::all()->pluck('name', 'id'))
                    ->searchable(),

                Forms\Components\TextInput::make(Product::COL_PRICE)->money(),

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
                TextColum::make(Product::COL_NAME)
                ->label('Name')
                ->sortable()
                ->searchable(),
            
            // Description column
            TextColumn::make(Product::COL_DESCRIPTION)
                ->label('Description')
                ->sortable()
                ->searchable(),
    
            // Quantity column
            TextColumn::make(Product::COL_QUANTITY)
                ->label('Quantity')
                ->sortable(),
    
            // Price column with money format
            TextColumn::make(Product::COL_PRICE)
                ->label('Price')
                ->money()
                ->sortable(),
    
            // Status column with human-readable label from enum
            TextColumn::make(Product::COL_STATUE)
                ->label('Status')
                ->formatStateUsing(fn (ProductStatus $status) => $status->label())
                ->sortable()
                ->filterable()
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options(ProductStatus::cases())
                ->label('Filter by Status')
                ->query(fn ($query, $status) => $query->where('status', $status->value))
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
