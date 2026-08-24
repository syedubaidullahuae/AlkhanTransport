<?php

namespace Zelio\GithubRepo\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Shortcode\View\View;

class GithubRepoServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/github-repo')
            ->loadAndPublishViews();

        $this->app->booted(function (): void {
            $this->app->register(HookServiceProvider::class);
        });

        if (function_exists('shortcode')) {
            view()->composer([
                'plugins/blog::themes.post',
                'plugins/blog::themes.page',
            ], function (View $view): void {
                $view->withShortcodes();
            });
        }
    }
}
