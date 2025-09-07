<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->alignCenter()
                    ->searchable(),
                    
                TextColumn::make('category.name')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('brand.name')
                    ->alignCenter()
                    ->sortable(),

                TextColumn::make('price')
                    ->alignCenter()
                    ->money('BRL')
                    ->sortable(),

                TextColumn::make('slug')
                    ->alignCenter()
                    ->searchable(),

                IconColumn::make('is_active')
                    ->alignCenter()
                    ->boolean(),

                IconColumn::make('in_stock')
                    ->alignCenter()
                    ->boolean(),

                IconColumn::make('is_featured')
                    ->alignCenter()
                    ->boolean(),

                IconColumn::make('on_sale')
                    ->alignCenter()
                    ->boolean(),

                TextColumn::make('created_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                TextColumn::make('updated_at')
                    ->alignCenter()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->relationship('category', 'name'),

                SelectFilter::make('brand')
                    ->relationship('brand', 'name'),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
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
