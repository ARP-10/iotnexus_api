<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Equipment;
use App\Models\Machine;
use App\Models\Run;
use App\Models\Result;
use Filament\Support\Icons\Heroicon;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 10;

    protected function getStats(): array
    {
        return [
            Stat::make('Equipment', Equipment::count())
                ->icon(Heroicon::OutlinedWrenchScrewdriver)
                ->description('Total registered')
                ->color('info'),

            Stat::make('Machines', Machine::count())
                ->icon(Heroicon::OutlinedCog6Tooth)
                ->description('Active in the system')
                ->color('warning'),

            Stat::make('Runs', Run::count())
                ->icon(Heroicon::OutlinedPlay)
                ->description('Recorded executions')
                ->color('success'),

            Stat::make('Results', Result::count())
                ->icon(Heroicon::OutlinedChartBar)
                ->description('Stored data')
                ->color('primary'),
        ];
    }
}
