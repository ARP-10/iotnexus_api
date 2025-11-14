<?php

namespace App\Filament\Admin\Resources\Machines;

use App\Filament\Admin\Resources\Machines\Pages\CreateMachine;
use App\Filament\Admin\Resources\Machines\Pages\EditMachine;
use App\Filament\Admin\Resources\Machines\Pages\ListMachines;
use App\Filament\Admin\Resources\Machines\Pages\ViewMachine;
use App\Filament\Admin\Resources\Machines\Schemas\MachineForm;
use App\Filament\Admin\Resources\Machines\Schemas\MachineInfolist;
use App\Filament\Admin\Resources\Machines\Tables\MachinesTable;
use App\Models\Machine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MachineResource extends Resource
{
    protected static ?string $model = Machine::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'serial_number';

    public static function form(Schema $schema): Schema
    {
        return MachineForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MachineInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MachinesTable::configure($table);
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
            'index' => ListMachines::route('/'),
            'create' => CreateMachine::route('/create'),
            'view' => ViewMachine::route('/{record}'),
            'edit' => EditMachine::route('/{record}/edit'),
        ];
    }
}
