<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget;
use App\Models\Product;
use App\Models\Machine;
use App\Models\Run;
use App\Models\Result;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 10;
    protected function getStats(): array
    {
        return [
            Stat::make('Productos', Product::count())
                ->description('Registrados en total')
                ->descriptionIcon('heroicon-o-cube')
                ->color('info'),

            Stat::make('Máquinas', Machine::count())
                ->description('Activas en el sistema')
                ->descriptionIcon('heroicon-o-cog')
                ->color('warning'),

            Stat::make('Runs', Run::count())
                ->description('Ejecuciones registradas')
                ->descriptionIcon('heroicon-o-play-circle')
                ->color('success'),

            Stat::make('Resultados', Result::count())
                ->description('Datos almacenados')
                ->descriptionIcon('heroicon-o-chart-bar')
                ->color('primary'),
        ];
    }
}
