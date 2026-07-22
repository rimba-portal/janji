<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages;

use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\AgreementTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAgreementTypes extends ListRecords
{
    protected static string $resource = AgreementTypeResource::class;

    protected static ?string $title = 'Agreement Types';

    protected ?string $subheading = 'Types of agreements that can be created.';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
