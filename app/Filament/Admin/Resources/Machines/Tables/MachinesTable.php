<?php

namespace App\Filament\Admin\Resources\Machines\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables;


class MachinesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                    Tables\Columns\TextColumn::make('equipment.name')
                        ->label('Equipment')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('equipment_version')
                        ->label('Eq. version')
                        ->sortable()
                        ->searchable(),

                    TextColumn::make('serial_number')
                        ->label('Serial number')
                        ->searchable(),

                    TextColumn::make('softwareVersion.version')
                        ->label('Software version')
                        ->formatStateUsing(function ($state, $record) {
                            $sv = $record->softwareVersion;
                            if (!$sv)
                                return '—';
                            return trim(($sv->app_name ?? '') . ' ' . ($sv->version ?? ''));
                        })
                        ->sortable()
                        ->searchable(),

                    TextColumn::make('customer.name')
                        ->label('Customer')
                        ->sortable()
                        ->searchable(),
                    TextColumn::make('created_at')
                        ->dateTime()
                        ->sortable()
                        ->toggleable(isToggledHiddenByDefault: true),
                ])
            ->filters([
                    //
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
