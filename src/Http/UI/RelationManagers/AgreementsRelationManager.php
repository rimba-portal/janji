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
                TextColumn::make('title')
                    ->wrap(),
                TextColumn::make('party_a')
                    ->label('Party A')
                    ->state(
                        fn (Agreement $record): string => $this->modelLabel($record->partyA)
                    ),

                TextColumn::make('party_b')
                    ->label('Party B')
                    ->state(
                        fn (Agreement $record): string => $this->modelLabel($record->partyB)
                    ),

                TextColumn::make('scopes')
                    ->label('Scope')
                    ->state(
                        fn (Agreement $record): string => $record->scopes
                            ->map(
                                fn ($scope): string => $this->modelLabel($scope->scopeable)
                            )
                            ->filter()
                            ->implode(', ') ?: '-'
                    )
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

    protected function modelLabel(?object $model): string
    {
        if (! $model) {
            return '-';
        }

        foreach (['name', 'title', 'label', 'code', 'staff_no', 'uuid'] as $attribute) {
            $value = $model->getAttribute($attribute);

            if (filled($value)) {
                return (string) $value;
            }
        }

        return class_basename($model).' #'.$model->getKey();
    }
}
