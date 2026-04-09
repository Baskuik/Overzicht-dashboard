<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Stats data
        $records = Record::all();
        $avg_duration = $records->avg('duration') ?? 0;

        $stats = [
            'total_actions' => $records->count(),
            'total_cost' => $records->sum('cost'),
            'avg_duration' => (int) $avg_duration,
            'total_employees' => $records->pluck('employee_name')->unique()->count(),
        ];

        // Chart data
        $actionsPerMonth = $records->groupBy(function ($record) {
            return $record->date?->format('Y-m') ?? now()->format('Y-m');
        })->map->count();

        $costPerEmployee = $records->groupBy('employee_name')->map->sum('cost');
        $actionsByType = $records->groupBy('action')->map->count();

        $chartData = [
            'actionsPerMonth' => $actionsPerMonth,
            'costPerEmployee' => $costPerEmployee,
            'actionsByType' => $actionsByType,
        ];

        // Kosten per maand data
        $kostenPerMaand = $records
            ->filter(fn($record) => $record->cost !== null)
            ->groupBy(function ($record) {
                return $record->date?->format('Y-m') ?? now()->format('Y-m');
            })
            ->mapWithKeys(function ($group) {
                return [$group->first()->date?->format('Y-m') ?? now()->format('Y-m') => round($group->sum('cost'), 2)];
            })
            ->sortKeys()
            ->toArray();

        return view('dashboard', [
            'stats' => $stats,
            'chartData' => $chartData,
            'kostenPerMaand' => $kostenPerMaand,
        ]);
    }
}
