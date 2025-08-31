<?php

declare(strict_types=1);

namespace App\Providers;

use App\Filament\Tiptap\Stats;
use App\Filament\Tiptap\Carousel;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\ServiceProvider;

final class AppServiceProvider extends ServiceProvider
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
                    Carousel::class,
                ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verify Email Address')
                ->view('mails.verify', [
                    'url' => $url,
                    'user' => $notifiable,
                ]);
        });
    }
}
