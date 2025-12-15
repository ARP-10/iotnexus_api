<?php

namespace App\Filament\Admin\Resources\Machines\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;


class MachineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            Select::make('equipment_id')
                ->relationship('equipment', 'name')
                ->label('Equipment')
                ->searchable()
                ->required(),

            TextInput::make('equipment_version')
                ->label('Equipment version')
                ->placeholder('D1')
                ->maxLength(20)
                ->required(),

            TextInput::make('serial_number')
                ->required(),

            Select::make('software_version_id')
                ->label('Installed software')
                ->relationship('softwareVersion', 'version')
                ->searchable()
                ->preload()
                ->nullable(),

            TextInput::make('license_id')
                ->numeric()
                ->default(null),

            TextInput::make('customer_id')
                ->numeric()
                ->default(null),
        ]);
    }
}
