<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\AgreementScopeResource;

class ListAgreementScopes extends ListRecords
{
    protected static string $resource = AgreementScopeResource::class;

    protected static ?string $title = 'Agreement Scopes';

    protected ?string $subheading = 'Define contextual boundaries and item extensions for linked contracts.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
