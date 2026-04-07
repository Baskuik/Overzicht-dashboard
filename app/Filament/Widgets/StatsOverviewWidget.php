<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\Widget;
use Illuminate\Contracts\View\View;

class StatsOverviewWidget extends Widget
{
    protected string $view = 'filament.widgets.stats-overview';

    public function getStats(): array
    {
        $records = Record::all();
        $avg_duration = $records->avg('duration') ?? 0;

        return [
            'total_actions' => $records->count(),
            'total_cost' => $records->sum('cost'),
            'avg_duration' => (int) $avg_duration,
            'total_employees' => $records->distinct('employee_name')->count(),
        ];
    }

    public function render(): View
    {
        return view($this->view, [
            'stats' => $this->getStats(),
        ]);
    }
}
