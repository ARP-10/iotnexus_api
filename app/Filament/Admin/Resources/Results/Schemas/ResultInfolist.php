<?php

namespace App\Filament\Admin\Resources\Results\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ResultInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('run_id'),
                TextEntry::make('created_at')
                    ->dateTime(),
            ]);
    }
}
