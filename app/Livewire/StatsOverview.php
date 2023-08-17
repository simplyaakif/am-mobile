<?php

namespace App\Livewire;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Collectible Today',0),
            Stat::make('Collectible This Month',0),
            Stat::make('Collectible Next Month',0),
        ];
    }
}
