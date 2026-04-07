<?php

namespace App\Filament\Resources\Records\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class RecordsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('upload.file_name')
                    ->label('Upload')
                    ->sortable(),

                TextColumn::make('action')
                    ->label('Action')
                    ->sortable(),

                TextColumn::make('employee_name')
                    ->label('Employee')
                    ->sortable(),

                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),

                TextColumn::make('duration')
                    ->label('Duration (min)')
                    ->sortable(),

                TextColumn::make('cost')
                    ->label('Cost (€)')
                    ->numeric(2)
                    ->sortable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
            ])
            ->filters([
                SelectFilter::make('employee_name')
                    ->label('Employee')
                    ->options(function () {
                        return \App\Models\Record::distinct()->pluck('employee_name', 'employee_name');
                    }),

                SelectFilter::make('action')
                    ->label('Action')
                    ->options(function () {
                        return \App\Models\Record::distinct()->pluck('action', 'action');
                    }),

                Filter::make('cost_between')
                    ->form([
                        \Filament\Forms\Components\TextInput::make('min_cost')
                            ->label('Min Cost')
                            ->numeric(),
                        \Filament\Forms\Components\TextInput::make('max_cost')
                            ->label('Max Cost')
                            ->numeric(),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['min_cost'] ?? null, fn($q) => $q->where('cost', '>=', $data['min_cost']))
                            ->when($data['max_cost'] ?? null, fn($q) => $q->where('cost', '<=', $data['max_cost']));
                    }),
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
