<?php

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAgreements extends ListRecords
{
    protected static string $resource = \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\AgreementResource::class;

    protected static ?string $title = 'Agreements';

    protected ?string $subheading = 'Binding agreement between parties for a specific purpose. Non private and confidential content of a contract agreement only.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
