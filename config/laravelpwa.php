<?php

return [
    'name' => 'MITRF Inc. PWA',
    'manifest' => [
        'name' => env('APP_NAME', 'MITRF Inc. App'),
        'short_name' => 'MITRF Inc.',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'maroon',
        'icons' => [
            '36x36' => [
                'path' => '/images/icons/android/android-icon-36x36.png',
                'purpose' => 'any'
            ],
            '48x48' => [
                'path' => '/images/icons/android/android-icon-48x48.png',
                'purpose' => 'any'
            ],
            '57x57' => [
                'path' => '/images/icons/apple/apple-icon-57x57.png',
                'purpose' => 'any'
            ],
            '60x60' => [
                'path' => '/images/icons/apple/apple-icon-60x60.png',
                'purpose' => 'any'
            ],
            '72x72' => [
                'path' => '/images/icons/android/adroid-icon-72x72.png',
                'purpose' => 'any'
            ],
            '76x76' => [
                'path' => '/images/icons/apple/apple-icon-76x76.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/android/android-icon-96x96.png',
                'purpose' => 'any'
            ],
            '114x114' => [
                'path' => '/images/icons/apple/apple-icon-114x114.png',
                'purpose' => 'any'
            ],
            '120x120' => [
                'path' => '/images/icons/apple/apple-icon-120x120.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/android/android-icon-144x144.png',
                'purpose' => 'any'
            ],

            '152x152' => [
                'path' => '/images/icons/apple/apple-icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/android/android-icon-192x192.png',
                'purpose' => 'any'
            ],
            '180x180' => [
                'path' => '/images/icons/apple/apple-icon-180x180.png',
                'purpose' => 'any'
            ],
            '310x310' => [
                'path' => '/images/icons/ms-icon-310x310.png',
                'purpose' => 'any'
            ],

        ],
        'splash' => [
            '640x1136' => '/images/icons/splash/iphone5-splash.png',
            '750x1334' => '/images/icons/splash/iphone6-splash.png',
            '828x1792' => '/images/icons/splash/iphonexr-splash.png',
            '1125x2436' => '/images/icons/splash/iphonex-splash.png',
            '1242x2208' => '/images/icons/splash/iphoneplus-splash.png',
            '1242x2688' => '/images/icons/splash/iphonexsmax-splash.png',
            '1536x2048' => '/images/icons/splash/ipad-splash.png',
            '1668x2224' => '/images/icons/splash/ipadpro1-splash.png',
            '1668x2388' => '/images/icons/splash/ipadpro3-splash.png',
            '2048x2732' => '/images/icons/splash/ipadpro2-splash.png',
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
        ],
        'custom' => []
    ]
];
