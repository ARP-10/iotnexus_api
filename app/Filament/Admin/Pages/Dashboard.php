<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Admin\Widgets\StatsOverview;
use App\Filament\Admin\Widgets\RunsChart;

class Dashboard extends BaseDashboard
{
    protected static ?int $navigationSort = 1;

    public function getWidgets(): array
    {
        return [
            StatsOverview::class,   
            RunsChart::class,
        ];
    }
}
