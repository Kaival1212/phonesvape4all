<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RepairBookingResource\Pages;
use App\Filament\Resources\RepairBookingResource\RelationManagers;
use App\Models\RepairBooking;
use App\Models\RepairService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepairBookingResource extends Resource
{
    protected static ?string $model = RepairBooking::class;
    protected static ?string $navigationGroup = 'Orders & Bookings';

    protected static ?string $navigationIcon = 'heroicon-o-calendar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                // $table->id();

                // $table->foreignId('repair_service_id')->constrained('repair_services')->onDelete('cascade');
                // $table->string('name');
                // $table->string('email');
                // $table->string('phone');
                // $table->date('selected_date');
                // $table->time('selected_time');
                // $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
                // $table->text('notes')->nullable();
                // $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
                // $table->enum('payment_method', ['card', 'stripe', 'bank_transfer' , 'cash'])->nullable();
                // $table->string('transaction_id')->nullable();

                // $table->double('price');
                // $table->decimal('discount', 8, 2)->nullable();
                // $table->decimal('total', 8, 2)->nullable();
                // $table->string('currency')->default('GBP');

                // $table->foreignId('store_id')->constrained('stores')->onDelete('cascade');

                // $table->timestamps();

                Forms\Components\Select::make('repair_service_id')
                ->options(function () {
                    return RepairService::all()
                        ->mapWithKeys(fn ($service) => [
                            $service->id => "{$service->name} – {$service->product->name}"
                        ]);
                })
                    ->label('Repair Service')
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Customer Name')
                    ->placeholder('Enter customer name'),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->label('Customer Email')
                    ->placeholder('Enter customer email')
                    ->email(),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->label('Customer Phone')
                    ->placeholder('Enter customer phone'),
                Forms\Components\DatePicker::make('selected_date')
                    ->required()
                    ->label('Selected Date')
                    ->default(now())
                    ->minDate(now())
                    ->placeholder('Enter selected date')
                    ->date(),

                Forms\Components\TimePicker::make('selected_time')
                    ->required()
                    ->label('Selected Time')
                    ->default(now())
                    ->hoursStep(1)
                    ->minutesStep(60)
                    ->placeholder('Enter selected time')
                    ->time(),

                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'cancelled' => 'Cancelled',
                    ])
                    ->default('pending')
                    ->label('Status'),
                Forms\Components\TextInput::make('notes')
                    ->label('Notes')
                    ->placeholder('Enter notes'),
                Forms\Components\Select::make('payment_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                        'failed' => 'Failed',
                    ])
                    ->default('pending')
                    ->label('Payment Status'),
                Forms\Components\Select::make('payment_method')
                    ->options([
                        'card' => 'Card',
                        'stripe' => 'Stripe',
                        'bank_transfer' => 'Bank Transfer',
                        'cash' => 'Cash',
                    ])
                    ->label('Payment Method'),
                Forms\Components\TextInput::make('transaction_id')
                    ->label('Transaction ID')
                    ->placeholder('Enter transaction ID'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->label('Price')
                    ->placeholder('Enter price')
                    ->numeric(),

                Forms\Components\TextInput::make('discount')
                    ->label('Discount')
                    ->placeholder('Enter discount')
                    ->numeric(),
                Forms\Components\TextInput::make('total')
                    ->label('Total')
                    ->placeholder('Enter total')
                    ->numeric(),

                Forms\Components\Select::make('store_id')
                    ->relationship('store', 'name')
                    ->label('Store')
                    ->required()
                    ->placeholder('Select store'),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('id')
                    ->label('ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('name')
                    ->label('Customer')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('repairService.name')
                    ->label('Service')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('repairService.product.name')
                    ->label('Product')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('selected_date')
                    ->label('Date')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('selected_time')
                    ->label('Time')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_status')
                    ->label('Payment Status')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('payment_method')
                    ->label('Payment Method')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('transaction_id')
                    ->label('Transaction ID')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('currency')
                    ->label('Currency')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('store.name')
                    ->label('Store')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->sortable()
                    ->dateTime()
                    ->formatStateUsing(fn ($state) => $state->format('d/m/Y H:i:s'))
                    ->toggleable(),

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
            'index' => Pages\ListRepairBookings::route('/'),
            'create' => Pages\CreateRepairBooking::route('/create'),
            'edit' => Pages\EditRepairBooking::route('/{record}/edit'),
        ];
    }
}
