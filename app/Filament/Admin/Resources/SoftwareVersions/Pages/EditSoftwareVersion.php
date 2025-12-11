<?php

namespace App\Filament\Admin\Resources\SoftwareVersions\Pages;

use App\Filament\Admin\Resources\SoftwareVersions\SoftwareVersionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSoftwareVersion extends EditRecord
{
    protected static string $resource = SoftwareVersionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
