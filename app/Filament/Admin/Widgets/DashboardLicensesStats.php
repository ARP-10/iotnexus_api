<?php

namespace App\Filament\Admin\Widgets;

use App\Models\License;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;

class DashboardLicensesStats extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $today = Carbon::today();

        $expiredCount = License::query()
            ->whereNotNull('valid_until')              // solo las que tienen fecha
            ->whereDate('valid_until', '<', $today)    // caducadas
            ->count();

        $expiringSoonCount = License::query()
            ->whereNotNull('valid_until') // solo las que tienen fecha
            ->whereBetween('valid_until', [
                $today,
                $today->copy()->addDays(30),
            ])
            ->count();

        $noExpiryCount = License::query()
            ->whereNull('valid_until') // licencias sin caducidad
            ->count();

        return [
            Stat::make('Licenses expired', $expiredCount)
                ->description('valid_until < today')
                ->icon('heroicon-o-x-circle')
                ->color($expiredCount > 0 ? 'danger' : 'success'),

            Stat::make('Expiring soon (30d)', $expiringSoonCount)
                ->description('valid_until in next 30 days')
                ->icon('heroicon-o-exclamation-triangle')
                ->color($expiringSoonCount > 0 ? 'warning' : 'gray'),

            Stat::make('No expiry date', $noExpiryCount)
                ->description('valid_until is NULL')
                ->icon('heroicon-o-information-circle')
                ->color('info'),
        ];
    }
}
