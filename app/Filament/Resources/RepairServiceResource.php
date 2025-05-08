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
use Illuminate\Support\Str;

class RepairServiceResource extends Resource
{
    protected static ?string $model = RepairService::class;
    protected static ?string $navigationGroup = 'Catalog';

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\TextInput::make('price')
                    ->numeric()
                    ->required(),
                Forms\Components\TextInput::make('discount')
                    ->numeric()
                    ->nullable(),
                Forms\Components\TextInput::make('estimated_duration_minutes')
                    ->numeric()
                    ->nullable(),
                Forms\Components\FileUpload::make('image')
                    ->image()
                    ->directory('repair-services')
                    ->nullable(),
                Forms\Components\Select::make('products')
                    ->relationship('products', 'name')
                    ->multiple()
                    ->preload()
                    ->searchable()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) =>
                                $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(ignoreRecord: true),
                        Forms\Components\Select::make('category_id')
                            ->relationship('category', 'name')
                            ->required(),
                        Forms\Components\Select::make('brand_id')
                            ->relationship('brand', 'name')
                            ->nullable(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('products')
                            ->nullable(),
                        Forms\Components\Textarea::make('description')
                            ->nullable(),
                        Forms\Components\Toggle::make('is_selling')
                            ->default(true),
                        Forms\Components\Toggle::make('is_repairable')
                            ->default(false),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('GBP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('discount')
                    ->money('GBP')
                    ->sortable(),
                Tables\Columns\TextColumn::make('estimated_duration_minutes')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('products')
                    ->relationship('products', 'name')
                    ->multiple(),
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
