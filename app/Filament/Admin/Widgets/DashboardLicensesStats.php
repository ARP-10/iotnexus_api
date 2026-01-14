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
            ->whereNotNull('valid_until')
            ->whereDate('valid_until', '<', $today)
            ->count();

        $expiringSoonCount = License::query()
            ->whereNotNull('valid_until')
            ->whereBetween('valid_until', [$today, $today->copy()->addDays(30)])
            ->count();

        $noExpiryCount = License::query()
            ->whereNull('valid_until')
            ->count();

        // Colores “lógicos” (como abajo):
        $expiredColor = $expiredCount > 0 ? 'danger' : 'success';
        $soonColor    = $expiringSoonCount > 0 ? 'warning' : 'success';
        $noExpColor   = $noExpiryCount > 0 ? 'info' : 'gray';

        return [
            Stat::make('Licenses expired', $expiredCount)
                ->description($expiredCount > 0 ? 'Expired licenses detected' : 'No expired licenses')
                ->descriptionIcon($expiredCount > 0 ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle')
                ->color($expiredColor)
                ->descriptionColor($expiredColor)
                ->icon('heroicon-o-key'),

            Stat::make('Expiring soon (30d)', $expiringSoonCount)
                ->description($expiringSoonCount > 0 ? 'Expiring in the next 30 days' : 'Nothing expiring soon')
                ->descriptionIcon($expiringSoonCount > 0 ? 'heroicon-o-exclamation-triangle' : 'heroicon-o-check-circle')
                ->color($soonColor)
                ->descriptionColor($soonColor)
                ->icon('heroicon-o-clock'),

            Stat::make('No expiry date', $noExpiryCount)
                ->description($noExpiryCount > 0 ? 'Licenses without expiry date' : 'All licenses have expiry date')
                ->descriptionIcon('heroicon-o-information-circle')
                ->color($noExpColor)
                ->descriptionColor($noExpColor)
                ->icon('heroicon-o-document-text'),
        ];
    }
}
