<?php

namespace App\Filament\Admin\Resources\Machines\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Infolists;


class MachineInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('customer_id')
                    ->numeric(),
                Infolists\Components\TextEntry::make('product.name')
                    ->label('Product'),

                TextEntry::make('license_id')
                    ->numeric(),
                TextEntry::make('serial_number'),
                TextEntry::make('created_at')
                    ->dateTime(),
            ]);
    }
}
