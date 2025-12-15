<?php

namespace App\Filament\Admin\Resources\SoftwareVersions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class SoftwareVersionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('app_name')
                    ->searchable(),
                TextColumn::make('version')
                    ->searchable(),
                TextColumn::make('serial_number')
                    ->label('Serial number')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('download_url')
                    ->searchable(),
                TextColumn::make('changelog')
                    ->label('Changelog')
                    ->formatStateUsing(function ($state): HtmlString {
                        if (!$state)
                            return new HtmlString('-');

                        $data = is_array($state) ? $state : json_decode($state, true);

                        $out = [];
                        if (!empty($data['es']))
                            $out[] = "es: {$data['es']}";
                        if (!empty($data['en']))
                            $out[] = "en: {$data['en']}";

                        return new HtmlString(nl2br(e(implode("\n", $out ?: ['-']))));
                    })
                    ->html()
                    ->wrap()
                    ->toggleable(),

                IconColumn::make('mandatory')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
