<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Parties;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\Pages\CreateParty;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\Pages\EditParty;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\Pages\ListParties;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\Schemas\PartyForm;
use Rimba\Agreement\Http\UI\Admin\Resources\Parties\Tables\PartiesTable;
use Rimba\Agreement\Models\Party;
use UnitEnum;

class PartyResource extends Resource
{
    protected static ?string $model = Party::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowSmallRight;

    protected static ?string $recordTitleAttribute = 'role';

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static ?string $navigationLabel = 'Parties';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return PartyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PartiesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListParties::route('/'),
            'create' => CreateParty::route('/create'),
            'edit' => EditParty::route('/{record}/edit'),
        ];
    }
}
