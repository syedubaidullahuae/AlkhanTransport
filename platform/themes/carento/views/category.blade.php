@php
    Theme::set('pageTitle', $category->name);
    $itemsPerRow = 3;
@endphp

<div class="container py-4">
    <h1 class="mb-3">{{ $category->name }}</h1>
    
    @if($category->description)
        <p class="text-muted">{{ $category->description }}</p>
    @endif
</div>

@include(Theme::getThemeNamespace('views.loop'))
