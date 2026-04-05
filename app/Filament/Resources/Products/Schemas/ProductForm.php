<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Components\Grid;
use Filament\Components\Section;
use Filament\Components\Select;
use Filament\Components\TextInput;
use Filament\Components\Textarea;
use Filament\Components\FileUpload;
use Filament\Schemas\Schema;
use App\Models\Category;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Thông tin cơ bản')
                    ->description('Nhập thông tin chi tiết về sản phẩm')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('name')
                                    ->label('Tên sản phẩm')
                                    ->required()
                                    ->maxLength(255),
                                Select::make('category_id')
                                    ->label('Danh mục')
                                    ->options(Category::pluck('name', 'id'))
                                    ->required(),
                            ]),
                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),
                        Textarea::make('description')
                            ->label('Mô tả')
                            ->columnSpan('full')
                            ->rows(4),
                    ]),

                Section::make('Chi tiết sản phẩm')
                    ->description('Giá, tồn kho và thông tin khác')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextInput::make('price')
                                    ->label('Giá')
                                    ->numeric()
                                    ->required()
                                    ->minValue(0)
                                    ->step(0.01),
                                TextInput::make('stock_quantity')
                                    ->label('Số lượng tồn kho')
                                    ->integer()
                                    ->required()
                                    ->minValue(0),
                                TextInput::make('warranty_period')
                                    ->label('Thời gian bảo hành (tháng)')
                                    ->integer()
                                    ->nullable(),
                            ]),
                        Select::make('status')
                            ->label('Trạng thái')
                            ->options([
                                'draft' => 'Nháp',
                                'published' => 'Đã xuất bản',
                                'out_of_stock' => 'Hết hàng',
                            ])
                            ->required(),
                    ]),

                Section::make('Hình ảnh')
                    ->description('Tải hình ảnh sản phẩm')
                    ->schema([
                        FileUpload::make('image_path')
                            ->label('Hình ảnh sản phẩm')
                            ->image()
                            ->directory('products')
                            ->visibility('public'),
                    ]),
            ]);
    }
}
