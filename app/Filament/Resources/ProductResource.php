<?php

namespace App\Filament\Resources;

use App\enum\ProductAdminStatus;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Create Product')
                    ->description('Create product over here')
                    ->schema([
                        TextInput::make(Product::COL_NAME)
                            ->required()
                            ->label('Product Name'),
                        RichEditor::make(Product::COL_DESCRIPTION)
                            ->label('Description'),
                    ])
                    ->columnSpan(1)
                    ->columns(1),
                Group::make()->schema([

                    TextInput::make(Product::COL_QUANTITY)
                        ->required()
                        ->label('Quantity')
                        ->numeric(),
                    TextInput::make(Product::COL_PRICE)
                        ->label('Price')
                        ->required()
                        ->numeric(),
                ]),
                Section::make()->schema([
                    Select::make(Product::COL_CATEGORIE_ID)
                        ->label('Categorie')
                        ->relationship('Categorie', 'name')
                        ->required()
                        ->searchable(),

                    Select::make(Product::COL_UNITE_ID)
                        ->label('Unite')
                        ->relationship('Unite', 'name')

                        ->required()
                        ->searchable(),
                    Select::make(Product::COL_STATUS)
                        ->options(ProductAdminStatus::class)
                        ->required()
                        ->default(ProductAdminStatus::Draft),
                ]),
                // Group::make()->schema([
                //     FileUpload::make('attachments')
                //         ->label('Attachements')
                //         ->multiple()
                //         ->directory('products')
                //         ->required(false),
                // ])

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
                    ->limit(50)
                    ->sortable()
                    ->searchable(),

                TextColumn::make(Product::COL_QUANTITY)
                    ->label('Quantity')
                    ->sortable(),

                TextColumn::make(Product::COL_PRICE)
                    ->label('Price')
                    ->sortable(),

                 TextColumn::make('status')
                     ->label('Status')
                     ->badge()
                     ->formatStateUsing(function (int $state): string {
                         return ProductAdminStatus::from($state)->getLabel();
                     })
                     ->color(function (int $state): string {
                         return ProductAdminStatus::from($state)->getColor();
                     })
                     ->searchable()
                     ->sortable(),

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
        return [];
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
