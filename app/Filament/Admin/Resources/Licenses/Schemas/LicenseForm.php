<?php

namespace App\Filament\Admin\Resources\Licenses\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class LicenseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('machine_id')
                    ->relationship('machine', 'id')
                    ->required(),
                TextInput::make('license_code')
                    ->required(),
                DatePicker::make('valid_from'),
                DatePicker::make('valid_until'),
                TextInput::make('lic_storage_path')
                    ->default(null),
                Select::make('status')
                    ->options(['active' => 'Active', 'expired' => 'Expired', 'revoked' => 'Revoked'])
                    ->default('active')
                    ->required(),
            ]);
    }
}
