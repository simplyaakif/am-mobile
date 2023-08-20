<?php

namespace App\Livewire;

use App\Models\Recovery;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        $startOfNextMonth = now()->addMonth()->startOfMonth();
        $endOfNextMonth = now()->addMonth()->endOfMonth();


        $todaySale = Recovery::where('is_paid',1)
            ->whereDate('paid_on',now()->toDate())->sum('amount');
        $monthSale = Recovery::where('is_paid',1)
            ->whereBetween('paid_on',[
            $startOfMonth,
            $endOfMonth,
        ])->sum('amount');
        $previousMonthSale = Recovery::where('is_paid',1)
            ->whereBetween('paid_on',[
            now()->subMonth()->startOfMonth()->toDate(),
            now()->subMonth()->endOfMonth()->toDate(),
        ])->sum('amount');



        $todayCollectible = Recovery::where('is_paid',0)
            ->whereDate('due_date',now()->toDate())->sum('amount');
        $monthCollectible = Recovery::where('is_paid',0)
            ->whereBetween('due_date',[
                $startOfMonth,
                $endOfMonth,
            ])->sum('amount');
        $nextMonthCollectible = Recovery::where('is_paid',0)
            ->whereBetween('due_date',[
                $startOfNextMonth->toDate(),
                $endOfNextMonth->toDate(),
            ])->sum('amount');

        return [
            Stat::make('Sale Today',$todaySale),
            Stat::make('Sale Month',$monthSale),
            Stat::make('Sale Previous Month',$previousMonthSale),

            Stat::make('Collectible Till Today',$todayCollectible),
            Stat::make('Collectible This Month',$monthCollectible),
            Stat::make('Collectible Next Month',$nextMonthCollectible),
        ];
    }
}
