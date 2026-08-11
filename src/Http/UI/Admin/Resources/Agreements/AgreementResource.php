<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\CreateAgreement;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\EditAgreement;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\ListAgreements;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\ViewAgreement;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas\AgreementForm;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas\AgreementInfolist;
use Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Tables\AgreementsTable;
use Rimba\Agreement\Models\Agreement;
use UnitEnum;

class AgreementResource extends Resource
{
    protected static ?string $model = Agreement::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ArrowSmallRight;

    protected static ?string $recordTitleAttribute = 'title';

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static ?string $navigationLabel = 'Agreements';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return AgreementForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return AgreementInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AgreementsTable::configure($table);
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
            'index' => ListAgreements::route('/'),
            'create' => CreateAgreement::route('/create'),
            'view' => ViewAgreement::route('/{record}'),
            'edit' => EditAgreement::route('/{record}/edit'),
        ];
    }
}
