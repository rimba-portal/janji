<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Rimba\Agreement\Models\AgreementType;

class AgreementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('agreement_type_id')
                    ->relationship('type', 'name')
                    ->reactive() // Intercepts change events instantly
                    ->required(),

                TextInput::make('title')->required(),

                // Dynamic Scope UI block dictated completely by your control table metadata
                Section::make('Agreement Scope Allocation')
                    ->schema(function (Get $get): array {
                        $typeId = $get('agreement_type_id');
                        if (! $typeId) {
                            return [];
                        }

                        $agreementType = AgreementType::find($typeId);
                        if (! $agreementType) {
                            return [];
                        }

                        // Case A: Enforcement says 'many' -> Render a layout grid repeater
                        if ($agreementType->allowsMultipleScopes()) {
                            return [
                                Repeater::make('scopes')
                                    ->relationship('scopes')
                                    ->schema([
                                        Select::make('scopeable_id')
                                            ->label(class_basename($agreementType->scopeable_type).' Target')
                                            ->options(($agreementType->scopeable_type)::pluck('title', 'id'))
                                            ->required(),
                                        Hidden::make('scopeable_type')
                                            ->default($agreementType->scopeable_type),
                                    ])
                                    ->columns(1),
                            ];
                        }

                        // Case B: Enforcement says 'one' -> Render a single, clean structural field
                        return [
                            Select::make('single_scope_id')
                                ->label('Assigned '.class_basename($agreementType->scopeable_type))
                                ->options(($agreementType->scopeable_type)::pluck('title', 'id'))
                                ->required(),
                        ];
                    }),
            ]);
    }
}
