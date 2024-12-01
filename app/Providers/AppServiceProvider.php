<?php

namespace App\Providers;

use App\Filament\Tiptap\Carousel;
use App\Filament\Tiptap\Stats;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        TiptapEditor::configureUsing(function (TiptapEditor $component) {
            $component
                ->blocks([
                    Stats::class,
                    Carousel::class
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
