<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class ChartDataWidget extends Widget
{
    protected string $view = 'filament.widgets.chart-data';

    public function getChartData(): array
    {
        $records = Record::all();

        $actionsPerMonth = $records->groupBy(function ($record) {
            return $record->date?->format('Y-m') ?? now()->format('Y-m');
        })->map->count();

        $costPerEmployee = $records->groupBy('employee_name')->map->sum('cost');
        $actionsByType = $records->groupBy('action')->map->count();

        return [
            'actionsPerMonth' => $actionsPerMonth,
            'costPerEmployee' => $costPerEmployee,
            'actionsByType' => $actionsByType,
        ];
    }

    public function render(): View
    {
        return view($this->view, [
            'chartData' => $this->getChartData(),
        ]);
    }
}
