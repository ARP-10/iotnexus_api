<?php

namespace App\Filament\Admin\Resources\Customers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomersForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Customer name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('company_vat')
                    ->label('Company VAT')
                    ->maxLength(255)
                    ->nullable(),
            ]);
    }
}
