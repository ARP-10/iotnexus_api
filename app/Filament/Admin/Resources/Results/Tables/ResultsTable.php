<?php

namespace App\Filament\Admin\Resources\Results\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResultsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('run_id')
                    ->label('Run id')
                    ->searchable(),

                TextColumn::make('metrics')
                    ->label('Métricas')
                    ->formatStateUsing(function ($state) {
                        // Si es array (por el cast del modelo)
                        if (is_array($state)) {
                            // Nos quedamos solo con los valores, sin claves
                            return collect($state)->values()->join(', ');
                        }

                        // Si viene como string JSON, intentamos decodificarlo
                        if (is_string($state)) {
                            $decoded = json_decode($state, true);

                            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                                return collect($decoded)->values()->join(', ');
                            }

                            // Si no es JSON válido, devolvemos el string tal cual
                            return $state;
                        }

                        // Cualquier otro caso
                        return (string) $state;
                    })
                    ->limit(60) // recorta visualmente para que no ocupe medio ancho
                    ->tooltip(fn($state) => $state),

                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
