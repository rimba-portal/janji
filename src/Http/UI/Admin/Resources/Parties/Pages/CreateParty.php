<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Parties\Pages;

use Filament\Resources\Pages\CreateRecord;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\PartyResource;

class CreateParty extends CreateRecord
{
    protected static string $resource = PartyResource::class;
}
