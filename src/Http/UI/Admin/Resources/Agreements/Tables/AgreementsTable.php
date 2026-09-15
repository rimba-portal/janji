<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Tables;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AgreementsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('uuid')
                    ->label('Contract No')
                    ->searchable(),

                TextColumn::make('type.name')
                    ->label('Contract Classification')
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable(),

                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'Draft',
                        'info' => 'Approved',
                        'success' => 'Active',
                        'danger' => 'Archive',
                    ]),

                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('scopes_count')
                    ->label('Items Scoped')
                    ->counts('scopes')
                    ->badge(),
            ])
            ->filters([
                SelectFilter::make('agreement_type_id')
                    ->label('Contract Type')
                    ->relationship('type', 'name'),
            ]);
    }
}
