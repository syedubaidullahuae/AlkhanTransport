<?php

namespace Zelio\GithubRepo\Providers;

use Botble\Base\Supports\ServiceProvider;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! function_exists('add_shortcode') || ! function_exists('shortcode')) {
            return;
        }

        shortcode()
            ->register(
                'github-repo',
                __('GitHub Repository'),
                __('Embed a GitHub repository card with stats. Usage: [github-repo url="https://github.com/owner/repo"]'),
                [$this, 'render']
            )
            ->setAdminConfig('github-repo', function (array $attributes) {
                return ShortcodeForm::createFromArray($attributes)
                    ->add('url', 'text', [
                        'label' => __('Repository URL'),
                        'attr' => [
                            'placeholder' => 'https://github.com/laravel/laravel',
                        ],
                    ]);
            });
    }

    public function render(Shortcode $shortcode): ?string
    {
        $url = $shortcode->url;

        if (! $url) {
            return null;
        }

        $repo = $this->fetchRepo($url);

        if (! $repo || ! ($repo['full_name'] ?? null)) {
            return null;
        }

        $view = 'plugins/github-repo::card';
        $themeView = Theme::getThemeNamespace('partials.shortcodes.github-repo.index');

        if ($themeView && view()->exists($themeView)) {
            $view = $themeView;
        }

        return view($view, ['repo' => $repo, 'url' => $url])->render();
    }

    protected function fetchRepo(string $url): ?array
    {
        if (preg_match('#github\.com/([^/]+/[^/]+?)(?:/|$)#', $url, $matches)) {
            $path = $matches[1];
        } elseif (preg_match('#^([\w.-]+/[\w.-]+)$#', $url, $matches)) {
            $path = $matches[1];
        } else {
            return null;
        }

        $path = trim($path, '/');
        $cacheKey = 'github-repo-' . md5($path);

        return Cache::remember($cacheKey, 3600, function () use ($path): ?array {
            $response = Http::withUserAgent('Zelio-GitHubRepo/1.0')
                ->timeout(10)
                ->get('https://api.github.com/repos/' . $path);

            if ($response->failed()) {
                return null;
            }

            return $response->json();
        });
    }
}
