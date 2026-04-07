<?php

namespace App\Filament\Widgets;

use App\Models\Record;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class KostenPerMaandChart extends ChartWidget
{
    protected ?string $heading = 'Kosten per maand';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Record::query()
            ->select(
                DB::raw("DATE_FORMAT(date, '%Y-%m') as maand"),
                DB::raw('SUM(cost) as totaal')
            )
            ->groupBy('maand')
            ->orderBy('maand')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Kosten (€)',
                    'data' => $data->pluck('totaal')->toArray(),
                    'backgroundColor' => '#3b82f6',
                    'borderColor' => '#1d4ed8',
                ]
            ],
            'labels' => $data->pluck('maand')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
