<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\CreateAgreementType;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\EditAgreementType;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\ListAgreementTypes;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\ViewAgreementType;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Schemas\AgreementTypeForm;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Schemas\AgreementTypeInfolist;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Tables\AgreementTypesTable;
use Rimba\Agreement\Models\AgreementType;
use UnitEnum;

class AgreementTypeResource extends Resource
{
    protected static ?string $model = AgreementType::class;

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 30;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return AgreementTypeForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AgreementTypeInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgreementTypesTable::configure($table);
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
            'index' => ListAgreementTypes::route('/'),
            'create' => CreateAgreementType::route('/create'),
            'view' => ViewAgreementType::route('/{record}'),
            'edit' => EditAgreementType::route('/{record}/edit'),
            //
        ];
    }
}
