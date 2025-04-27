<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\RepairBooking;
use App\Models\SellBooking;
use Carbon\Carbon;

class MonthlyTrendsChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Bookings & Sales';

    protected function getData(): array
    {
        $labels = [];
        $repairData = [];
        $salesData  = [];

        for ($i = 11; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M Y');

            $repairData[] = RepairBooking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();

            $salesData[] = SellBooking::whereYear('created_at', $month->year)
                ->whereMonth('created_at', $month->month)
                ->count();
        }

        return [
            'labels'   => $labels,
            'datasets' => [
                [
                    'label'           => 'Repairs',
                    'data'            => $repairData,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.5)',
                    'borderColor'     => 'rgb(59, 130, 246)',
                ],
                [
                    'label'           => 'Sales',
                    'data'            => $salesData,
                    'backgroundColor' => 'rgba(16, 185, 129, 0.5)',
                    'borderColor'     => 'rgb(16, 185, 129)',
                ],
            ],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
