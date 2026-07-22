<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\AgreementResource;

class CreateAgreement extends CreateRecord
{
    protected static string $resource = AgreementResource::class;
}
