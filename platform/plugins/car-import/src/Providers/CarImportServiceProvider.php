<?php

namespace Botble\CarImport\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\DashboardMenuItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;

class CarImportServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/car-import')
            ->loadAndPublishConfigurations(['permissions'])
            ->loadRoutes()
            ->loadAndPublishViews();

        DashboardMenu::default()->beforeRetrieving(function (): void {
            DashboardMenu::make()
                ->registerItem(
                    DashboardMenuItem::make()
                        ->id('cms-plugins-car-import')
                        ->priority(450)
                        ->parentId('cms-plugins-car-rentals')
                        ->name('Car Import')
                        ->icon('ti ti-upload')
                        ->route('import.index')
                        ->permissions(['car.import'])
                );
        });
    }
}