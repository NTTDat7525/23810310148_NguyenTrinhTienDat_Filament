<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Components\Grid;
use Filament\Components\Section;
use Filament\Components\TextInput;
use Filament\Components\Textarea;
use Filament\Components\Toggle;
use Filament\Schemas\Schema;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin danh mục')
                    ->description('Nhập thông tin cơ bản về danh mục')
                    ->schema([
                        TextInput::make('name')
                            ->label('Tên danh mục')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->rows(4)
                            ->columnSpan('full'),
                        Toggle::make('is_visible')
                            ->label('Hiển thị')
                            ->default(true),
                    ]),
            ]);
    }
}
