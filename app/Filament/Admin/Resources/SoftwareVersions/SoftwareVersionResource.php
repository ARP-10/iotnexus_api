<?php

namespace App\Filament\Admin\Resources\SoftwareVersions;

use App\Filament\Admin\Resources\SoftwareVersions\Pages\CreateSoftwareVersion;
use App\Filament\Admin\Resources\SoftwareVersions\Pages\EditSoftwareVersion;
use App\Filament\Admin\Resources\SoftwareVersions\Pages\ListSoftwareVersions;
use App\Filament\Admin\Resources\SoftwareVersions\Schemas\SoftwareVersionForm;
use App\Filament\Admin\Resources\SoftwareVersions\Tables\SoftwareVersionsTable;
use App\Models\SoftwareVersion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SoftwareVersionResource extends Resource
{
    protected static ?int $navigationSort = 70;

    protected static ?string $model = SoftwareVersion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPuzzlePiece;

    protected static ?string $recordTitleAttribute = 'version';

    public static function form(Schema $schema): Schema
    {
        return SoftwareVersionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SoftwareVersionsTable::configure($table);
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
            'index' => ListSoftwareVersions::route('/'),
            'create' => CreateSoftwareVersion::route('/create'),
            'edit' => EditSoftwareVersion::route('/{record}/edit'),
        ];
    }
}
