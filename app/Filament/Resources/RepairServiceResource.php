<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepairServiceResource\Pages;
use App\Filament\Resources\RepairServiceResource\RelationManagers;
use App\Models\RepairService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepairServiceResource extends Resource
{
    protected static ?string $model = RepairService::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required()
                    ->label('Product'),

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Service Name'),

                Forms\Components\Textarea::make('description')
                    ->label('Description'),

                Forms\Components\FileUpload::make('image')
                    ->disk('r2')
                    ->visibility('public')
                    ->label('Image'),

                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->label('Price'),

                Forms\Components\TextInput::make('estimated_duration_minutes')
                    ->numeric()
                    ->label('Estimated Duration (minutes)'),
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
                TextColumn::make('name')
                    ->label('Service Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('description')
                    ->label('Description')
                    ->sortable()
                    ->limit(20)
                    ->searchable(),

                ImageColumn::make('image')
                    ->label('Image')
                    ->disk('r2')
                    ->visibility('public'),

                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->money('gbp', true),

                TextColumn::make('estimated_duration_minutes')
                    ->label('Estimated Duration (minutes)')
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
            'index' => Pages\ListRepairServices::route('/'),
            'create' => Pages\CreateRepairService::route('/create'),
            'edit' => Pages\EditRepairService::route('/{record}/edit'),
        ];
    }
}
