@php
    Theme::layout('homepage');
@endphp

{!! apply_filters('ads_render', null, 'car_list_before', ['class' => 'mb-2']) !!}

@php
    request()->merge([
        'car_categories' => [$category->id]
    ]);
@endphp

{!! do_shortcode('[car-list enable_filter="no" default_layout="grid"][/car-list]') !!}

{!! apply_filters('ads_render', null, 'car_list_after', ['class' => 'mt-2']) !!}
