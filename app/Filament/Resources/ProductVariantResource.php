<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductVariantResource\Pages;
use App\Filament\Resources\ProductVariantResource\RelationManagers;
use App\Models\ProductVariant;
use Dom\Text;
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

class ProductVariantResource extends Resource
{
    protected static ?string $model = ProductVariant::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                TextInput::make('product_id')
                    ->label('Product ID')
                    ->required()
                    ->placeholder('Enter Product ID'),
                TextInput::make('variant_name')
                    ->label(' Variant Name')
                    ->required()
                    ->placeholder('Enter Variant Name'),

                TextInput::make('price')
                    ->label('Price')
                    ->required()
                    ->placeholder('Enter Price')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(10000)
                    ->step(0.01),

                FileUpload::make('image')
                    ->label('Image')
                    ->disk('r2')
                    ->visibility('public')
                    ->imageEditor()
                    ->required()
                    ->placeholder('Upload Image'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('product.name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('variant_name')
                    ->label('Variant Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->money('gbp'),

                    ImageColumn::make('image')
                    ->label('Image')
                    ->disk('r2')
                    ->visibility('public')


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
            'index' => Pages\ListProductVariants::route('/'),
            'create' => Pages\CreateProductVariant::route('/create'),
            'edit' => Pages\EditProductVariant::route('/{record}/edit'),
        ];
    }
}
