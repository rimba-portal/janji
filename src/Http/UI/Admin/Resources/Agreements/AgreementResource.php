<?php

namespace Rimba\Agreement\Http\UI\Admin\Resources\Agreements;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AgreementResource extends Resource
{
    protected static ?string $model = \Rimba\Agreement\Models\Agreement::class;

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 28;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema { return \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas\AgreementForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Schemas\AgreementInfolist::configure($schema); }

    public static function table(Table $table): Table { return \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Tables\AgreementsTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\ListAgreements::route('/'),
             'create' => \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\CreateAgreement::route('/create'),
             'view' => \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\ViewAgreement::route('/{record}'),
             'edit' => \Rimba\Agreement\Http\UI\Admin\Resources\Agreements\Pages\EditAgreement::route('/{record}/edit'),
            //
        ];
    }
}
