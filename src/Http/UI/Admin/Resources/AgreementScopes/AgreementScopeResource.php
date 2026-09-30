<?php

declare(strict_types=1);

namespace Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\ListAgreementScopes;
use Rimba\Agreement\Models\AgreementScope;
use UnitEnum;

class AgreementScopeResource extends Resource
{
    protected static ?string $model = AgreementScope::class;

    protected static string|UnitEnum|null $navigationGroup = 'Agreement';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-play';

    protected static ?int $navigationSort = 29;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
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
            'index' => ListAgreementScopes::route('/'),
            // 'create' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\CreateAgreementScope::route('/create'),
            // 'view' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\ViewAgreementScope::route('/{record}'),
            // 'edit' => \Rimba\Agreement\Http\UI\Admin\Resources\AgreementScopes\Pages\EditAgreementScope::route('/{record}/edit'),
            //
        ];
    }
}
