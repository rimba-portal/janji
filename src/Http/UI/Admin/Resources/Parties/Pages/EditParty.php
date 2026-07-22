<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Parties\Pages;

use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\PartyResource;

class EditParty extends EditRecord
{
    protected static string $resource = PartyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
