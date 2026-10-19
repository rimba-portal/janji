<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\RelationManagers;

use Filament\Actions\Action;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Rimba\Agreement\Models\Agreement;

class AgreementsRelationManager extends RelationManager
{
    protected static string $relationship = 'agreementsAsPartyA';

    protected static ?string $title = 'Agreements';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn (): Builder => $this->getOwnerRecord()->agreementsQuery()
            )
            ->columns([
                TextColumn::make('uuid')
                    ->label('Agreement No.')
                    ->searchable()
                    ->copyable(),

                TextColumn::make('type.name')
                    ->label('Type')
                    ->badge()
                    ->sortable(),

                TextColumn::make('title')
                    ->searchable()
                    ->wrap(),

                TextColumn::make('role')
                    ->label('Involvement')
                    ->state(
                        function (Agreement $record): string {
                            $model = $this->getOwnerRecord();

                            $id = $model->getKey();
                            $type = $model->getMorphClass();

                            if (
                                $record->party_a_type === $type &&
                                $record->party_a_id == $id
                            ) {
                                return 'Party A';
                            }

                            if (
                                $record->party_b_type === $type &&
                                $record->party_b_id == $id
                            ) {
                                return 'Party B';
                            }

                            return 'Scope';
                        }
                    )
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Party A' => 'primary',
                        'Party B' => 'info',
                        'Scope' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('status')
                    ->badge()
                    ->color(fn (?string $state): string => match ($state) {
                        'Draft' => 'gray',
                        'Approved' => 'info',
                        'Active' => 'success',
                        'Archive' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('start_date')
                    ->label('Start')
                    ->date()
                    ->sortable(),

                TextColumn::make('end_date')
                    ->label('End')
                    ->date()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->url(
                        fn (Agreement $record): string => route(
                            'filament.admin.resources.agreements.view',
                            ['record' => $record]
                        )
                    ),
            ])
            ->defaultSort('start_date', 'desc');
    }
}
