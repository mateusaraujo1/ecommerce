<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Models\Order;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Costumer')
                    ->sortable()
                    ->alignCenter()
                    ->searchable(),

                TextColumn::make('grand_total')
                    ->numeric()
                    ->searchable()
                    ->money(fn (Order $record): string => $record->currency)
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('payment_method')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),

                SelectColumn::make('status')
                    ->options([
                        'new' => 'New',
                        'processing' => 'Processing',
                        'shipped' => 'Shipped',
                        'delivered' => 'Delivered',
                        'canceled' => 'Canceled'
                    ])
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('currency')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('shipping_amount')
                    ->numeric()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('shipping_method')
                    ->searchable()
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    DeleteAction::make(),
                    EditAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
