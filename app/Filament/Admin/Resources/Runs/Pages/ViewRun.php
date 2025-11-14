<?php

namespace App\Filament\Admin\Resources\Runs\Pages;

use App\Filament\Admin\Resources\Runs\RunResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewRun extends ViewRecord
{
    protected static string $resource = RunResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
