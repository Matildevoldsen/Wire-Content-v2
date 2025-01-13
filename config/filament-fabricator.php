<?php

declare(strict_types=1);

use Z3d0X\FilamentFabricator\Models\Page;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Z3d0X\FilamentFabricator\Resources\PageResource;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

// config for Z3d0X/FilamentFabricator
return [
    'routing' => [
        'enabled' => true,
        'prefix' => null, //    /pages
    ],

    'layouts' => [
        'namespace' => 'App\\Filament\\Fabricator\\Layouts',
        'path' => app_path('Filament/Fabricator/Layouts'),
        'register' => [
            //
        ],
    ],

    'page-blocks' => [
        'namespace' => 'App\\Filament\\Fabricator\\PageBlocks',
        'path' => app_path('Filament/Fabricator/PageBlocks'),
        'register' => [
            //
        ],
    ],

    'middleware' => [
        EncryptCookies::class,
        AddQueuedCookiesToResponse::class,
        StartSession::class,
        // \Illuminate\Session\Middleware\AuthenticateSession::class,
        ShareErrorsFromSession::class,
        VerifyCsrfToken::class,
        SubstituteBindings::class,
    ],

    'page-model' => Page::class,

    'page-resource' => PageResource::class,

    'enable-view-page' => false,

    /*
     * This is the name of the table that will be created by the migration and
     * used by the above page-model shipped with this package.
     */
    'table_name' => 'pages',
];
