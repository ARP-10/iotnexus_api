<?php

namespace App\Filament\Admin\Resources\Runs\Pages;

use App\Filament\Admin\Resources\Runs\RunResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRuns extends ListRecords
{
    protected static string $resource = RunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
