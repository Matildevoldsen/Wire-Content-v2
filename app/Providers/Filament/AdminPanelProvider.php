<?php

declare(strict_types=1);

namespace App\Providers\Filament;

use CWSPS154\AppSettings\AppSettingsPlugin;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use App\Filament\Pages\Dashboard;
use Awcodes\Curator\CuratorPlugin;
use Filament\Support\Colors\Color;
use Hasnayeen\Themes\ThemesPlugin;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\TextInput;
use Filament\Http\Middleware\Authenticate;
use MarcoGermani87\FilamentCaptcha\FilamentCaptcha;
use pxlrbt\FilamentSpotlight\SpotlightPlugin;
use Hasnayeen\Themes\Http\Middleware\SetTheme;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Visualbuilder\EmailTemplates\EmailTemplatesPlugin;
use Z3d0X\FilamentFabricator\FilamentFabricatorPlugin;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Datlechin\FilamentMenuBuilder\FilamentMenuBuilderPlugin;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

final class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->login()
            ->databaseNotifications()
            ->plugins([
                ThemesPlugin::make(),
                AppSettingsPlugin::make(),
                CuratorPlugin::make()
                    ->label('Media')
                    ->pluralLabel('Media')
                    ->navigationIcon('heroicon-o-photo')
                    ->navigationGroup('Content')
                    ->navigationSort(3)
                    ->navigationCountBadge()
                    ->defaultListView('grid'),
                FilamentCaptcha::make(),
                SpotlightPlugin::make(),
                FilamentShieldPlugin::make(),
                EmailTemplatesPlugin::make(),
                FilamentFabricatorPlugin::make(),
                FilamentMenuBuilderPlugin::make()
                    ->addLocation('header', 'Header')
                    ->addLocation('dropdown', 'Dropdown')
                    ->addMenuFields([
                        Toggle::make('is_logged_in'),
                    ])
                    ->addMenuItemFields([
                        Toggle::make('is_admin'),
                        Toggle::make('use_navigate'),
                        TextInput::make('icon'),
                    ]),
            ])
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                SetTheme::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
