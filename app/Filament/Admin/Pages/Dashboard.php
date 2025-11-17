<?php

namespace App\Filament\Admin\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Admin\Widgets\StatsOverview;
use App\Filament\Admin\Widgets\AnomaliesWidget;
use App\Filament\Admin\Widgets\RunsChart;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            StatsOverview::class,   
            AnomaliesWidget::class,
            RunsChart::class,
        ];
    }
}
