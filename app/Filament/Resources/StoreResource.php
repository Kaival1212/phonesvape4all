<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreResource\Pages;
use App\Filament\Resources\StoreResource\RelationManagers;
use App\Models\Store;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StoreResource extends Resource
{
    protected static ?string $model = Store::class;

    protected static ?string $navigationGroup = 'Locations';
    protected static ?string $navigationIcon  = 'heroicon-o-building-storefront';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Store Name'),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->unique(Store::class, 'slug', ignoreRecord: true)
                    ->label('SEO Slug'),

                Forms\Components\TextInput::make('address')
                    ->required()
                    ->label('Full Address'),

                Forms\Components\TextInput::make('city')
                    ->nullable()
                    ->label('City'),

                Forms\Components\TextInput::make('postcode')
                    ->nullable()
                    ->label('Postcode'),

                Forms\Components\TextInput::make('phone')
                    ->nullable()
                    ->label('Phone Number'),

                Forms\Components\TextInput::make('email')
                    ->nullable()
                    ->email()
                    ->label('Email Address'),

                Forms\Components\TextInput::make('google_maps_link')
                    ->nullable()
                    ->url()
                    ->label('Google Maps Link'),

                Forms\Components\FileUpload::make('image')
                    ->disk('r2')
                    ->visibility('public')
                    ->imageEditor()
                     ->imageEditorAspectRatios(['1:1' , '4:1'])
                    ->imageEditorViewportWidth(100)
                    ->imageEditorViewportHeight(100)
                        // after cropping, resize the saved image to 100×100px
                    ->imageResizeTargetWidth(100)
                    ->imageResizeTargetHeight(100)

                    // show a 100px-tall preview in the form
                    ->imagePreviewHeight(100)
                    ->label('Store Image'),

                Forms\Components\Textarea::make('meta_title')
                    ->nullable()
                    ->label('SEO Title'),

                Forms\Components\Textarea::make('meta_description')
                    ->nullable()
                    ->label('SEO Description'),


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

                Tables\Columns\TextColumn::make('name')
                    ->label('Store Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->label('SEO Slug')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('address')
                    ->label('Full Address')
                    ->sortable()
                    ->limit(20)
                    ->searchable(),

                Tables\Columns\ImageColumn::make('image')
                    ->label('Store Image')
                    ->disk('r2')
                    ->visibility('public'),


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
            'index' => Pages\ListStores::route('/'),
            'create' => Pages\CreateStore::route('/create'),
            'edit' => Pages\EditStore::route('/{record}/edit'),
        ];
    }
}
