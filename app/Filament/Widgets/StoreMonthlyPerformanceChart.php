<?php

namespace App\Filament\Widgets;

use App\Models\Store;
use App\Models\RepairBooking;
use App\Models\SellBooking;
use Carbon\Carbon;
use Filament\Widgets\LineChartWidget;

class StoreMonthlyPerformanceChart extends LineChartWidget
{
    protected static ?string $heading = 'Monthly Repairs & Sales by Store';

    protected function getData(): array
    {
        // Last 12 months labels
        $labels = [];
        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');
        }

        // Define a palette of colors to cycle through
        $colors = [
            '#3b82f6', // blue
            '#10b981', // green
            '#ef4444', // red
            '#f59e0b', // orange
            '#8b5cf6', // purple
            '#ec4899', // pink
            '#0ea5e9', // sky
            '#84cc16', // lime
        ];
        $colorCount = count($colors);

        $datasets = [];
        $datasetIndex = 0;

        foreach (Store::all() as $store) {
            // Gather data for this store
            $repairData = [];
            $salesData  = [];

            foreach ($labels as $label) {
                $dt    = Carbon::createFromFormat('M Y', $label);
                $year  = $dt->year;
                $month = $dt->month;
                $repairData[] = RepairBooking::where('status', 'completed')
                    ->where('store_id', $store->id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
                $salesData[] = SellBooking::where('status', 'completed')
                    ->where('store_id', $store->id)
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->count();
            }

            // Repairs line
            $color = $colors[$datasetIndex++ % $colorCount];
            $datasets[] = [
                'label'           => "{$store->name} Repairs",
                'data'            => $repairData,
                'borderColor'     => $color,
                'backgroundColor' => $color . '33', // 20% opacity fill
                'fill'            => false,
            ];

            // Sales line
            $color = $colors[$datasetIndex++ % $colorCount];
            $datasets[] = [
                'label'           => "{$store->name} Sales",
                'data'            => $salesData,
                'borderColor'     => $color,
                'backgroundColor' => $color . '33',
                'fill'            => false,
            ];
        }

        return [
            'labels'   => $labels,
            'datasets' => $datasets,
        ];
    }
}
