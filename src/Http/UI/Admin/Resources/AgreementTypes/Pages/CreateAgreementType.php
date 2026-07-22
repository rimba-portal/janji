<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages;

use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\AgreementTypeResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAgreementType extends CreateRecord
{
    protected static string $resource = AgreementTypeResource::class;
}
