<?php

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AgreementTypeResource extends Resource
{
    protected static ?string $model = \Rimba\Agreement\Models\AgreementType::class;

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 30;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema { return \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Schemas\AgreementTypeForm::configure($schema); }

    public static function infolist(Schema $schema): Schema { return \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Schemas\AgreementTypeInfolist::configure($schema); }

    public static function table(Table $table): Table { return \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Tables\AgreementTypesTable::configure($table); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\ListAgreementTypes::route('/'),
             'create' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\CreateAgreementType::route('/create'),
             'view' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\ViewAgreementType::route('/{record}'),
             'edit' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementTypes\Pages\EditAgreementType::route('/{record}/edit'),
            //
        ];
    }
}
