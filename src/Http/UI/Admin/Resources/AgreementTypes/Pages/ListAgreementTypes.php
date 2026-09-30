<?php

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages;

use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAgreementTypes extends ListRecords
{
    protected static string $resource = \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\AgreementTypeResource::class;

    protected static ?string $title = 'Agreement Types';

    protected ?string $subheading = 'Types of agreements that can be created.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
