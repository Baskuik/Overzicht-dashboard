<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\Widget;

class StatsOverviewWidget extends Widget
{
    protected static string $view = 'filament.widgets.stats-overview';

    public function getStats(): array
    {
        $records = Record::all();

        return [
            'total_actions' => $records->count(),
            'total_cost' => $records->sum('cost'),
            'avg_duration' => $records->avg('duration'),
            'total_employees' => $records->distinct('employee_name')->count(),
        ];
    }

    public function render()
    {
        return view(static::$view, [
            'stats' => $this->getStats(),
        ]);
    }
}
