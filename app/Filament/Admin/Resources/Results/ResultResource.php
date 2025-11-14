<?php

namespace App\Filament\Admin\Resources\Results;

use App\Filament\Admin\Resources\Results\Pages\CreateResult;
use App\Filament\Admin\Resources\Results\Pages\EditResult;
use App\Filament\Admin\Resources\Results\Pages\ListResults;
use App\Filament\Admin\Resources\Results\Pages\ViewResult;
use App\Filament\Admin\Resources\Results\Schemas\ResultForm;
use App\Filament\Admin\Resources\Results\Schemas\ResultInfolist;
use App\Filament\Admin\Resources\Results\Tables\ResultsTable;
use App\Models\Result;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResultResource extends Resource
{
    protected static ?string $model = Result::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'run_id';

    public static function form(Schema $schema): Schema
    {
        return ResultForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ResultInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResultsTable::configure($table);
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
            'index' => ListResults::route('/'),
            'create' => CreateResult::route('/create'),
            'view' => ViewResult::route('/{record}'),
            'edit' => EditResult::route('/{record}/edit'),
        ];
    }
}
