<?php

namespace App\Filament\Admin\Resources\SoftwareVersions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Machine;

class SoftwareVersionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('serial_number')
                    ->label('Machine')
                    ->options(
                        Machine::query()
                            ->pluck('serial_number', 'serial_number')
                    )
                    ->searchable()
                    ->required(),
                TextInput::make('app_name')
                    ->required()
                    ->default('IT032_PC'),
                TextInput::make('version')
                    ->required(),
                TextInput::make('download_url')
                    ->required(),
                Textarea::make('changelog')
                    ->default(null)
                    ->columnSpanFull(),
                Toggle::make('mandatory')
                    ->required(),
            ]);
    }
}
