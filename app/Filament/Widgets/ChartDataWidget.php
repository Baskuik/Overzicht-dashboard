<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class ChartDataWidget extends Widget
{
    protected static string $view = 'filament.widgets.chart-data';

    public function getChartData(): array
    {
        $records = Record::all();

        // Actions per month
        $actionsPerMonth = $records->groupBy(function ($record) {
            return $record->date?->format('Y-m') ?? now()->format('Y-m');
        })->map(function ($group) {
            return $group->count();
        });

        // Cost per employee
        $costPerEmployee = $records->groupBy('employee_name')->map(function ($group) {
            return $group->sum('cost');
        });

        // Actions by type
        $actionsByType = $records->groupBy('action')->map(function ($group) {
            return $group->count();
        });

        return [
            'actionsPerMonth' => $actionsPerMonth,
            'costPerEmployee' => $costPerEmployee,
            'actionsByType' => $actionsByType,
        ];
    }

    public function render()
    {
        return view(static::$view, [
            'chartData' => $this->getChartData(),
        ]);
    }
}
