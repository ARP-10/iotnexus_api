<?php

namespace App\Filament\Admin\Resources\Runs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class RunInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID'),
                TextEntry::make('machine_id')
                    ->numeric(),
                TextEntry::make('app_version'),
                TextEntry::make('created_at')
                    ->dateTime(),
            ]);
    }
}
