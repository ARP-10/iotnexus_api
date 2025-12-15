<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;
use App\Models\Equipment;
use App\Models\Machine;
use App\Models\Run;
use App\Models\Result;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 10;
    protected function getStats(): array
    {
        return [
            Stat::make('Equipment', Equipment::count())
                ->description('Total registered')
                ->descriptionIcon('heroicon-o-cube')
                ->color('info'),

            Stat::make('Machines', Machine::count())
                ->description('Active in the system')
                ->descriptionIcon('heroicon-o-cog')
                ->color('warning'),

            Stat::make('Runs', Run::count())
                ->description('Recorded executions')
                ->descriptionIcon('heroicon-o-play-circle')
                ->color('success'),

            Stat::make('Results', Result::count())
                ->description('Stored data')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('primary'),
        ];
    }
}
