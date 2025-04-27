<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SellBookingResource\Pages;
use App\Filament\Resources\SellBookingResource\RelationManagers;
use App\Models\SellBooking;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ActionGroup;
use App\Models\ProductVariant;
use App\Models\Store;
use Filament\Forms\Components\Select;

class SellBookingResource extends Resource
{
    protected static ?string $model = SellBooking::class;
    protected static ?string $navigationGroup = 'Orders & Bookings';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('product_variant_id')
                ->label('Variant')
                ->required()

                // build id => "variant – product" pairs
                ->options(function () {
                    return ProductVariant::with('product')
                        ->get()
                        ->mapWithKeys(fn ($variant) => [
                            $variant->id => "{$variant->variant_name} – {$variant->product->name}"
                        ]);
                })

                // allow searching through the labels
                ->searchable()
                ->preload(),

                Select::make('store_id')
                    ->relationship('store', 'name')
                    ->required()
                    ->label('Store'),

                TextInput::make('customer_name')
                    ->required()
                    ->maxLength(255)
                    ->label('Customer Name'),

                TextInput::make('customer_email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->label('Customer Email'),

                TextInput::make('customer_phone')
                    ->tel()
                    ->required()
                    ->label('Customer Phone'),

                TextInput::make('customer_address')
                    ->maxLength(255)
                    ->label('Address'),

                TextInput::make('customer_city')
                    ->maxLength(255)
                    ->label('City'),

                TextInput::make('customer_state')
                    ->maxLength(255)
                    ->label('State'),

                TextInput::make('customer_zip')
                    ->maxLength(20)
                    ->label('ZIP Code'),

                TextInput::make('customer_country')
                    ->maxLength(255)
                    ->label('Country'),

                Textarea::make('customer_message')
                    ->maxLength(65535)
                    ->label('Message'),

                Select::make('status')
                    ->options([
                        'pending'   => 'Pending',
                        'completed' => 'Completed',
                        'rejected'  => 'Rejected',
                    ])
                    ->default('pending')
                    ->required()
                    ->label('Status'),

                TextInput::make('price')
                    ->numeric()
                    ->label('Price'),

                TextInput::make('discount')
                    ->numeric()
                    ->label('Discount'),

                TextInput::make('total')
                    ->numeric()
                    ->label('Total'),

                Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid'    => 'Paid',
                        'failed'  => 'Failed',
                    ])
                    ->default('pending')
                    ->required()
                    ->label('Payment Status'),

                Select::make('payment_method')
                    ->options([
                        'cash'        => 'Cash',
                        'card'        => 'Card',
                        'stripe'      => 'Stripe',
                    ])
                    ->nullable()
                    ->label('Payment Method'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->sortable()
                    ->searchable()
                    ->label('ID'),

                TextColumn::make('productVariant.variant_name')
                    ->sortable()
                    ->searchable()
                    ->label('Variant'),

                TextColumn::make('store.name')
                    ->sortable()
                    ->searchable()
                    ->label('Store'),

                TextColumn::make('customer_name')
                    ->sortable()
                    ->searchable()
                    ->label('Customer Name'),

                TextColumn::make('customer_email')
                    ->sortable()
                    ->searchable()
                    ->label('Customer Email'),

                TextColumn::make('customer_phone')
                    ->sortable()
                    ->searchable()
                    ->label('Customer Phone'),

                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime()
                    ->label('Created At'),

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
            'index' => Pages\ListSellBookings::route('/'),
            'create' => Pages\CreateSellBooking::route('/create'),
            'edit' => Pages\EditSellBooking::route('/{record}/edit'),
        ];
    }
}
