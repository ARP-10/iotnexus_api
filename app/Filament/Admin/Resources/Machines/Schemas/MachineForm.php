<?php

namespace App\Filament\Admin\Resources\Machines\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms;


class MachineForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('customer_id')
                    ->numeric()
                    ->default(null),
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->label('Product')
                    ->searchable()
                    ->required(),

                TextInput::make('license_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('serial_number')
                    ->required(),
            ]);
    }
}
