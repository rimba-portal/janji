<?php

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes;

use BackedEnum;
use UnitEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class AgreementScopeResource extends Resource
{
    protected static ?string $model = \Rimba\Agreement\Models\AgreementScope::class;

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 29;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema { return $schema->components([]); }

    public static function infolist(Schema $schema): Schema { return $schema->components([]); }

    public static function table(Table $table): Table { return $table->columns([]); }

    public static function getRelations(): array 
    { 
        return [ 
            // 
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\ListAgreementScopes::route('/'),
            // 'create' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\CreateAgreementScope::route('/create'),
            // 'view' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\ViewAgreementScope::route('/{record}'),
            // 'edit' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\EditAgreementScope::route('/{record}/edit'),
            //
        ];
    }
}
