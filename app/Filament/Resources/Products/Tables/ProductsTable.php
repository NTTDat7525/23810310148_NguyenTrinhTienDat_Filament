<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use App\Models\Category;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Hình ảnh')
                    ->square(),
                TextColumn::make('name')
                    ->label('Tên sản phẩm')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Danh mục')
                    ->sortable(),
                TextColumn::make('price')
                    ->label('Giá')
                    ->sortable()
                    ->formatStateUsing(fn($state) => number_format($state, 2)),
                TextColumn::make('stock_quantity')
                    ->label('Tồn kho')
                    ->sortable(),
                BadgeColumn::make('status')
                    ->label('Trạng thái')
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                        'danger' => 'out_of_stock',
                    ])
                    ->formatStateUsing(fn($state) => match ($state) {
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        'out_of_stock' => 'Hết hàng',
                        default => $state,
                    }),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Trạng thái')
                    ->options([
                        'draft' => 'Nháp',
                        'published' => 'Đã xuất bản',
                        'out_of_stock' => 'Hết hàng',
                    ]),
                SelectFilter::make('category_id')
                    ->label('Danh mục')
                    ->options(Category::pluck('name', 'id')),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
