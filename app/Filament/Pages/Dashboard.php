<?php

declare(strict_types=1);

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Support\Enums\ActionSize;
use Filament\Pages\Dashboard as BaseDashboard;
use Dotswan\FilamentLaravelPulse\Widgets\PulseCache;
use Dotswan\FilamentLaravelPulse\Widgets\PulseUsage;
use Dotswan\FilamentLaravelPulse\Widgets\PulseQueues;
use Dotswan\FilamentLaravelPulse\Widgets\PulseServers;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;
use Dotswan\FilamentLaravelPulse\Widgets\PulseExceptions;
use Dotswan\FilamentLaravelPulse\Widgets\PulseSlowQueries;
use Dotswan\FilamentLaravelPulse\Widgets\PulseSlowRequests;
use Dotswan\FilamentLaravelPulse\Widgets\PulseSlowOutGoingRequests;

final class Dashboard extends BaseDashboard
{
    use HasFiltersAction;

    public function getColumns(): int|string|array
    {
        return 12;
    }

    public function getWidgets(): array
    {
        return [
            PulseServers::class,
            PulseCache::class,
            PulseExceptions::class,
            PulseUsage::class,
            PulseQueues::class,
            PulseSlowQueries::class,
            PulseSlowRequests::class,
            PulseSlowOutGoingRequests::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ActionGroup::make([
                Action::make('1h')
                    ->action(fn () => $this->redirect(route('filament.admin.pages.dashboard'))),
                Action::make('24h')
                    ->action(fn () => $this->redirect(route('filament.admin.pages.dashboard', ['period' => '24_hours']))),
                Action::make('7d')
                    ->action(fn () => $this->redirect(route('filament.admin.pages.dashboard', ['period' => '7_days']))),
            ])
                ->label(__('Filter'))
                ->icon('heroicon-m-funnel')
                ->size(ActionSize::Small)
                ->color('gray')
                ->button(),
        ];
    }
}
