<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Dom\Text;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
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
                Select::make('category_id')
                    ->relationship('category' , 'name')
                    ->required()
                    ->label('Category'),

                Select::make('brand_id')
                    ->relationship('brand' , 'name')
                    ->nullable()
                    ->label('Brand'),

                TextInput::make('name')
                    ->required()
                    ->label('Product Name')
                    ->maxLength(255),

                    TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true)
                    ->dehydrated(fn ($state) => ! blank($state))
                    ->dehydrateStateUsing(function ($state) {
                        return str($state)->slug();
                    }),

                FileUpload::make('image')
                ->disk('r2')
                ->visibility('public')
                ->imageEditor()
                ->label('Image'),

                TextInput::make('description')
                    ->label('Description')
                    ->maxLength(65535)
                    ->columnSpanFull(),

                    Toggle::make('is_selling')
                    ->label('Is Selling')
                    ->default(true),

                    Toggle::make('is_repairable')
                    ->label('Is Repairable')
                    ->default(true)

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Image')
                    ->disk('r2')
                    ->visibility('public'),

                IconColumn::make('is_selling')
                    ->label('Is Selling')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_repairable')
                    ->label('Is Repairable')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->sortable()
                    ->searchable(),

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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
