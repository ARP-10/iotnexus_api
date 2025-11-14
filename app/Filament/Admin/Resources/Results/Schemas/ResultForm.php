<?php

namespace App\Filament\Admin\Resources\Results\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('run_id')
                    ->required(),
                Textarea::make('metrics')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }
}
