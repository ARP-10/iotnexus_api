<?php

namespace App\Filament\Admin\Resources\Runs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class RunForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('machine_id')
                    ->required()
                    ->numeric(),
                TextInput::make('app_version')
                    ->default(null),
            ]);
    }
}
