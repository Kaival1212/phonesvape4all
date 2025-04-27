<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class VariantsRelationManagerRelationManager extends RelationManager
{
    protected static string $relationship = 'variants';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_id')
                ->relationship('product', 'name')
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('variant_name')
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
