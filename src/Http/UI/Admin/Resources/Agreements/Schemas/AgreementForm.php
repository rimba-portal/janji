<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Rimba\Agreement\Models\AgreementType;

class AgreementForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Agreement Header')
                    ->columns(2)
                    ->schema([
                        TextInput::make('uuid')
                            ->label('UUID / Contract No')
                            ->default(fn () => Str::uuid()->toString())
                            ->disabled()
                            ->dehydrated()
                            ->required(),

                        Select::make('agreement_type_id')
                            ->label('Agreement Rules Profile')
                            ->relationship('type', 'name')
                            ->live() // Triggers real-time re-rendering on mutation events
                            ->required(),

                        TextInput::make('title')
                            ->required()
                            ->columnSpanFull(),

                        TextArea::make('description')
                            ->columnSpanFull(),

                        DatePicker::make('start_date'),
                        DatePicker::make('end_date'),
                    ]),

                // DYNAMIC PARTY IDENTIFICATION SECTION
                Section::make('Contracting Parties')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('party_a_notice')
                            ->label('Party A Details')
                            ->state(
                                fn (Get $get): string => ($type = AgreementType::find($get('agreement_type_id')))
                                    ? 'Expected Type: '.class_basename($type->party_a_type)
                                    : 'Select a rules profile first.'
                            ),

                        TextEntry::make('party_b_notice')
                            ->label('Party B Details')
                            ->state(
                                fn (Get $get): string => ($type = AgreementType::find($get('agreement_type_id')))
                                    ? 'Expected Type: '.class_basename($type->party_b_type)
                                    : 'Select a rules profile first.'
                            ),

                        TextInput::make('party_a_id')
                            ->label('Party A Record ID')
                            ->numeric()
                            ->required(),

                        TextInput::make('party_b_id')
                            ->label('Party B Record ID')
                            ->numeric()
                            ->required(),

                        Hidden::make('party_a_type')
                            ->state(fn (Get $get) => AgreementType::find($get('agreement_type_id'))?->party_a_type),

                        Hidden::make('party_b_type')
                            ->state(fn (Get $get) => AgreementType::find($get('agreement_type_id'))?->party_b_type),
                    ]),

                // METADATA DRIVEN RELATIONSHIP LEDGER
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

                        $targetClass = $agreementType->scopeable_type;
                        $label = class_basename($targetClass);

                        // If class doesn't support pluck options cleanly, fall back to standard text input
                        $hasOptions = method_exists($targetClass, 'pluck');
                        $options = $hasOptions ? $targetClass::pluck('title', 'id') : [];

                        return [
                            Repeater::make('scopes')
                                ->relationship('scopes') // Maps straight to HasMany
                                ->schema([
                                    $hasOptions
                                        ? Select::make('scopeable_id')
                                            ->label("Select {$label} Target")
                                            ->options($options)
                                            ->required()
                                        : TextInput::make('scopeable_id')
                                            ->label("{$label} Target ID")
                                            ->numeric()
                                            ->required(),

                                    Hidden::make('scopeable_type')
                                        ->default($targetClass),
                                ])
                                // Restrict the adding mechanism based on the scope relation parameter
                                ->addable(fn (): bool => $agreementType->allowsMultipleScopes() || count($get('scopes') ?? []) < 1)
                                ->deletable(true)
                                ->columns(1),
                        ];
                    }),
            ]);
    }
}
