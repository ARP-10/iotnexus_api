<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

use App\Models\Run;
use App\Models\Result;
use App\Models\Machine;

class AnomaliesWidget extends StatsOverviewWidget
{
    protected ?string $heading = 'Anomalías detectadas';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 20;

    protected function getColumns(): int|array|null
    {
        return 2; // 2 tarjetas por fila
    }

    protected function getStats(): array
    {
        // 1️⃣ Runs sin resultados
        $runsSinResultados = Run::doesntHave('results')->count();
        $iconRuns = $runsSinResultados > 0 ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle';

        // 2️⃣ Resultados inválidos
        $resultadosInvalidos = Result::get()
            ->filter(function ($result) {
                $metrics = $result->metrics;

                // Si viene como string, probar decode
                if (is_string($metrics)) {
                    $decoded = json_decode($metrics, true);
                    if (json_last_error() === JSON_ERROR_NONE) {
                        $metrics = $decoded;
                    }
                }

                if (!is_array($metrics)) {
                    return false;
                }

                return collect($metrics)->contains(fn($v) => is_numeric($v) && $v < 0);
            })
            ->count();

        $iconInvalidos = $resultadosInvalidos > 0 ? 'heroicon-o-x-circle' : 'heroicon-o-check-circle';

        // 3️⃣ Runs con una medición
        $runsConUnaMedicion = Run::withCount('results')
            ->having('results_count', 1)
            ->count();

        $iconUnaMedicion = $runsConUnaMedicion > 0 ? 'heroicon-o-exclamation-circle' : 'heroicon-o-check-circle';

        // 4️⃣ Máquinas sin producto
        $maquinasSinProducto = Machine::whereNull('product_id')->count();
        $iconMaquinas = $maquinasSinProducto > 0 ? 'heroicon-o-exclamation-circle' : 'heroicon-o-check-circle';

        return [
            Stat::make('Runs sin resultados', $runsSinResultados)
                ->description($runsSinResultados > 0 ? 'Se detectaron problemas' : 'Todo correcto')
                ->descriptionIcon($iconRuns)
                ->icon('heroicon-o-document-magnifying-glass')
                ->color($runsSinResultados > 0 ? 'danger' : 'success'),

            Stat::make('Resultados inválidos', $resultadosInvalidos)
                ->description($resultadosInvalidos > 0 ? 'Valores negativos detectados' : 'Sin problemas')
                ->descriptionIcon($iconInvalidos)
                ->icon('heroicon-o-exclamation-triangle')
                ->color($resultadosInvalidos > 0 ? 'danger' : 'success'),

            Stat::make('Runs con 1 medición', $runsConUnaMedicion)
                ->description($runsConUnaMedicion > 0 ? 'Mediciones incompletas' : 'Todo en orden')
                ->descriptionIcon($iconUnaMedicion)
                ->icon('heroicon-o-arrow-path')
                ->color($runsConUnaMedicion > 0 ? 'danger' : 'success'),

            Stat::make('Máquinas sin producto', $maquinasSinProducto)
                ->description($maquinasSinProducto > 0 ? 'Asignación pendiente' : 'Correcto')
                ->descriptionIcon($iconMaquinas)
                ->icon('heroicon-o-cube')
                ->color($maquinasSinProducto > 0 ? 'danger' : 'success'),
        ];
    }
}
