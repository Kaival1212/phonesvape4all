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
use Filament\Tables\Actions\CreateAction;

class RepairsRelationManagerRelationManager extends RelationManager
{
    protected static string $relationship = 'repairServices';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Repairs')
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
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
