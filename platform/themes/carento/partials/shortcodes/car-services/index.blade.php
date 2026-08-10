@php
    $style = $shortcode->style;
    $style = $style ? (in_array($style, ['style-1', 'style-2', 'style-3']) ? $style : 'style-1') : 'style-1';
    $title = $shortcode->title;
    $subtitle = $shortcode->description;
    $buttonLabel = $shortcode->button_label;
    $buttonUrl = $shortcode->button_url;
@endphp

{!! Theme::partial("shortcodes.car-services.styles.$style", compact('shortcode', 'services', 'title', 'subtitle', 'buttonLabel', 'buttonUrl')) !!}
