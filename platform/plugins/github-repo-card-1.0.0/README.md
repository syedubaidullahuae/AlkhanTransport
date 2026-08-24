# GitHub Repo Card

A Botble CMS plugin that embeds GitHub repository cards into your content — just like Medium.

```
[github-repo url="https://github.com/laravel/laravel"]
```

Renders a card with: owner avatar, repo name, description, stars, forks, language, and license.

## Features

- Server-side only — no JavaScript required
- Caches GitHub API responses for 1 hour (stays under rate limits)
- Falls back gracefully on invalid URLs, network errors, or rate limits
- Works in blog posts and pages out of the box

## Installation

1. Download the plugin
2. Extract to `platform/plugins/github-repo/`
3. Go to Admin → Plugins and activate **GitHub Repo Card**

## Usage

Insert the shortcode into any blog post or page:

```
[github-repo url="https://github.com/owner/repo"]
```

You can also use just the owner/repo format:

```
[github-repo url="laravel/laravel"]
```

## Theme Customization

To override the card template in your theme, create:

```
platform/themes/your-theme/partials/shortcodes/github-repo/index.blade.php
```

The view receives `$repo` (GitHub API response array) and `$url` (the original URL).

## Requirements

- Botble CMS 7.3.0+
- PHP 8.0+
- Laravel `Http` client (comes with Laravel)

## Changelog

### 1.0.0

- Initial release

## Support

Created by [Dheer Gupta](https://dheergupta.in). For support, contact dheerguptaa35959@gmail.com.

## License

MIT
