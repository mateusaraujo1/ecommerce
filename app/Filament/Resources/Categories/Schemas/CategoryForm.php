<?php

namespace App\Filament\Resources\Categories\Schemas;

use App\Models\Category;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([
                    Grid::make(1)
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true) //ativará quando o campo perder o foco
                                ->afterStateUpdated(fn (string $operation, $state, Set $set) => $operation === 'create' ? $set('slug', str()->slug($state)) : null), //gerar o slug automaticamente ao criar

                            TextInput::make('slug')
                                ->required()
                                ->disabled()
                                ->dehydrated()
                                ->unique(Category::class, 'slug', ignoreRecord: true)
                                ->maxLength(255),

                            FileUpload::make('image')
                                ->image()
                                ->directory('categories'),
                                
                            Toggle::make('is_active')
                                ->label('Is Active')
                                ->required()
                                ->default(true),
                        ])
                ])
            ]);
    }
}
