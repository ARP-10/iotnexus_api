<?php

namespace App\Filament\Admin\Resources\Runs;

use App\Filament\Admin\Resources\Runs\Pages\CreateRun;
use App\Filament\Admin\Resources\Runs\Pages\EditRun;
use App\Filament\Admin\Resources\Runs\Pages\ListRuns;
use App\Filament\Admin\Resources\Runs\Pages\ViewRun;
use App\Filament\Admin\Resources\Runs\Schemas\RunForm;
use App\Filament\Admin\Resources\Runs\Schemas\RunInfolist;
use App\Filament\Admin\Resources\Runs\Tables\RunsTable;
use App\Models\Run;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RunResource extends Resource
{
    protected static ?string $model = Run::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return RunForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return RunInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RunsTable::configure($table);
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
            'index' => ListRuns::route('/'),
            'create' => CreateRun::route('/create'),
            'view' => ViewRun::route('/{record}'),
            'edit' => EditRun::route('/{record}/edit'),
        ];
    }
}
