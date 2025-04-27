<?php

namespace App\Filament\Widgets;

use App\Models\{
    Brand,
    Category,
    Product,
    ProductVariant,
    RepairBooking,
    RepairService,
    SellBooking,
    Store,
    ProductStoreInventory,
};
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $now          = Carbon::now();
        $thisMonth    = $now->month;
        $thisYear     = $now->year;
        $lastMonth    = (clone $now)->subMonth();

        //
        // 1) Month-over-month counts
        //
        $repairsThis  = RepairBooking::where('status','completed')
            ->whereYear('created_at',$thisYear)
            ->whereMonth('created_at',$thisMonth)
            ->count();
        $repairsLast  = RepairBooking::where('status','completed')
            ->whereYear('created_at',$lastMonth->year)
            ->whereMonth('created_at',$lastMonth->month)
            ->count();
        $repairsDelta = $repairsLast
            ? round((($repairsThis - $repairsLast) / $repairsLast) * 100, 1)
            : 0;

        $salesThis    = SellBooking::where('status','completed')
            ->whereYear('created_at',$thisYear)
            ->whereMonth('created_at',$thisMonth)
            ->count();
        $salesLast    = SellBooking::where('status','completed')
            ->whereYear('created_at',$lastMonth->year)
            ->whereMonth('created_at',$lastMonth->month)
            ->count();
        $salesDelta   = $salesLast
            ? round((($salesThis - $salesLast) / $salesLast) * 100, 1)
            : 0;

        //
        // 2) Revenue metrics
        //
        // Sales revenue
        $revThis      = SellBooking::where('status','completed')
            ->whereYear('created_at',$thisYear)
            ->whereMonth('created_at',$thisMonth)
            ->sum('total');
        $revLast      = SellBooking::where('status','completed')
            ->whereYear('created_at',$lastMonth->year)
            ->whereMonth('created_at',$lastMonth->month)
            ->sum('total');
        $revDelta     = $revLast
            ? round((($revThis - $revLast) / $revLast) * 100, 1)
            : 0;

        // Repair revenue
        $repairRevThis  = RepairBooking::where('status','completed')
            ->whereYear('created_at',$thisYear)
            ->whereMonth('created_at',$thisMonth)
            ->sum('total');
        $repairRevLast  = RepairBooking::where('status','completed')
            ->whereYear('created_at',$lastMonth->year)
            ->whereMonth('created_at',$lastMonth->month)
            ->sum('total');
        $repairRevDelta = $repairRevLast
            ? round((($repairRevThis - $repairRevLast) / $repairRevLast) * 100, 1)
            : 0;

        //
        // 3) Top stores by revenue
        //
        $topSalesStore = Store::withSum(['sellBookings' => fn($q) => $q->where('status','completed')], 'total')
            ->orderByDesc('sell_bookings_sum_total')
            ->first();
        $topRepairStore = Store::withSum(['repairBookings' => fn($q) => $q->where('status','completed')], 'total')
            ->orderByDesc('repair_bookings_sum_total')
            ->first();

        //
        // 4) Other metrics
        //
        $lowStock      = ProductStoreInventory::where('quantity','<', 5)->count();
        $avgRepairMin  = RepairService::avg('estimated_duration_minutes');

        return [
            Stat::make('Categories',        Category::count())
                ->color('primary'),

            Stat::make('Brands',            Brand::count())
                ->color('primary'),

            Stat::make('Products',          Product::count())
                ->color('primary'),

            Stat::make('Variants',          ProductVariant::count())
                ->color('primary'),

            Stat::make('Services',          RepairService::count())
                ->color('primary'),

            Stat::make('Repairs (count)',   $repairsThis)
                ->descriptionIcon($repairsDelta >= 0
                    ? 'heroicon-m-arrow-trending-up'
                    : 'heroicon-m-arrow-trending-down')
                ->description(abs($repairsDelta) . '% vs last month')
                ->color($repairsDelta >= 0 ? 'success' : 'warning'),

            Stat::make('Sales (count)',     $salesThis)
                ->descriptionIcon($salesDelta >= 0
                    ? 'heroicon-m-arrow-trending-up'
                    : 'heroicon-m-arrow-trending-down')
                ->description(abs($salesDelta) . '% vs last month')
                ->color($salesDelta >= 0 ? 'success' : 'warning'),

            Stat::make('Sales Revenue',     '£' . number_format($revThis ?? 0, 2))
                ->descriptionIcon($revDelta >= 0
                    ? 'heroicon-m-arrow-trending-up'
                    : 'heroicon-m-arrow-trending-down')
                ->description(abs($revDelta) . '% vs last month')
                ->color('success'),

            Stat::make('Repair Revenue',    '£' . number_format($repairRevThis ?? 0, 2))
                ->descriptionIcon($repairRevDelta >= 0
                    ? 'heroicon-m-arrow-trending-up'
                    : 'heroicon-m-arrow-trending-down')
                ->description(abs($repairRevDelta) . '% vs last month')
                ->color('info'),

            Stat::make('Top Sales Store',   $topSalesStore
                    ? "{$topSalesStore->name}: £" . number_format($topSalesStore->sell_bookings_sum_total ?? 0, 2)
                    : 'N/A')
                ->icon('heroicon-o-building-office')
                ->color('primary'),

            Stat::make('Top Repair Store',  $topRepairStore
                    ? "{$topRepairStore->name}: £" . number_format($topRepairStore->repair_bookings_sum_total ?? 0, 2)
                    : 'N/A')
                ->icon('heroicon-o-home')
                ->color('primary'),

            Stat::make('Low Stock Items',    $lowStock)
                ->icon('heroicon-o-exclamation-triangle')
                ->description('Items < 5')
                ->color('danger'),

        ];
    }
}
