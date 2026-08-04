<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\AgreementTypeResource;

class CreateAgreementType extends CreateRecord
{
    protected static string $resource = AgreementTypeResource::class;

    // Custom
}
