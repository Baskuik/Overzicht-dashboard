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
        $kostenPerMaand = Record::query()
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as maand"),
                DB::raw('SUM(cost) as totaal')
            )
            ->groupBy('maand')
            ->orderBy('maand')
            ->get()
            ->mapWithKeys(fn($item) => [$item->maand => $item->totaal])
            ->toArray();

        return view('dashboard', [
            'stats' => $stats,
            'chartData' => $chartData,
            'kostenPerMaand' => $kostenPerMaand,
        ]);
    }
}
