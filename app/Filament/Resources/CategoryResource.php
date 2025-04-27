<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Dom\Text;
use Faker\Core\File;
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

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $navigationGroup = 'Catalog';

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
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
                    ->imageEditorAspectRatios([
                        '16:9', // Good for laptops and wide shots
                        '4:3',  // Ideal for tablets
                        '1:1',  // Perfect for uniform display
                        '3:4',  // Better for phones in portrait
                        '9:16', // Great for phones in landscape
                        '2:3',  // Versatile for various devices
                    ])
                    ->image() // Ensure only images are uploaded
                    ->imageCropAspectRatio('1:1') // Default crop ratio for consistency
                    ->imageResizeMode('contain') // Prevents important parts from being cut off
                    ->imageResizeTargetWidth(800) // Higher resolution for better quality
                    ->imageResizeTargetHeight(800)
                    ->helperText('Upload a high-quality image (recommended: 800×800px or larger). PNG or JPG only.')
                    ->imagePreviewHeight(150) // Slightly larger preview
                    ->columnSpanFull() // Full width in the form
                    ->required()
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
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('slug')
                    ->label('Slug')
                    ->sortable()
                    ->searchable(),
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
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
