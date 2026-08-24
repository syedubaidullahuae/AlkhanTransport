<?php

use Botble\Slug\Facades\SlugHelper;
use Botble\Theme\Events\ThemeRoutingAfterEvent;
use Botble\Theme\Events\ThemeRoutingBeforeEvent;
use Botble\Theme\Facades\SiteMapManager;
use Botble\Theme\Facades\Theme;
use Botble\Theme\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Theme::registerRoutes(function (): void {
    Route::group(['controller' => PublicController::class], function (): void {
        event(new ThemeRoutingBeforeEvent(app()->make('router')));

        Route::get('/', 'getIndex')->name('public.index');

         if (setting('sitemap_enabled', true)) {
        //     Route::get('sitemap.xml', 'getSiteMap')->name('public.sitemap');

        //     Route::get('{key}.{extension}', 'getSiteMapIndex')
        //         ->whereIn('extension', SiteMapManager::allowedExtensions())
        //         ->name('public.sitemap.index');
        

            Route::get('sitemap.xml', function () {

                    $sitemap = app(\Botble\Theme\Supports\SiteMapManager::class);

                    $sitemap->init('pages');

                    // ADD PAGES HERE
                    $pages = \Botble\Page\Models\Page::query()
                        ->wherePublished()
                        ->with('slugable')
                        ->get();

                    foreach ($pages as $page) {
                        $url = $page->url;
                    
                        if ($page->slug === 'services') {
                        
                                $url = url('services.xml');
                            }

                            if ($page->slug === 'rental') {
                                $url = url('rental.xml');
                            }

                            if ($page->slug === 'fleet') {
                                $url = url('fleet.xml');
                            }
                             if ($page->slug === 'events') {
                                $url = url('events.xml');
                            }

                        $sitemap->add(
                        $url,
                            $page->updated_at,
                            '0.8',
                            'weekly'
                        );
                    }

                    return $sitemap->render('xml');
            })->name('public.sitemap');

            Route::get('services.xml', function () {

                $sitemap = app(\Botble\Theme\Supports\SiteMapManager::class);
                $sitemap->init('services');

                $services = Botble\CarRentals\Models\Service::where('status', 'published')->get();
                
                foreach ($services as $service) {

                    $sitemap->add(
                        url('services/' . $service->slug),
                        $service->updated_at,
                        '0.8',
                        'weekly'
                    );
                }

                return $sitemap->render('xml');
            });

            Route::get('rental.xml', function () {

                $sitemap = app(\Botble\Theme\Supports\SiteMapManager::class);
                $sitemap->init('rental');

                $categories = Botble\CarRentals\Models\CarCategory::where('status', 'published')->get();
                
                foreach ($categories as $cat) {

                    $sitemap->add(
                        url('rental/' . $cat->slug),
                        $cat->updated_at,
                        '0.8',
                        'weekly'
                    );
                }

                return $sitemap->render('xml');
            });

            Route::get('fleet.xml', function () {

                $sitemap = app(\Botble\Theme\Supports\SiteMapManager::class);
                $sitemap->init('fleet');

                $cars = Botble\CarRentals\Models\Car::get();
                
                foreach ($cars as $car) {

                    $sitemap->add(
                        url($car->url),
                        $car->updated_at,
                        '0.8',
                        'weekly'
                    );
                }

                return $sitemap->render('xml');
            });
         }

        Route::get('{slug?}', 'getView')->name('public.single');

        Route::get('{prefix}/{slug?}', 'getViewWithPrefix')
            ->whereIn('prefix', SlugHelper::getAllPrefixes() ?: ['1437bcd2-d94e-4a5fd-9a39-b5d60225e9af']);

        event(new ThemeRoutingAfterEvent(app()->make('router')));
    });
});
