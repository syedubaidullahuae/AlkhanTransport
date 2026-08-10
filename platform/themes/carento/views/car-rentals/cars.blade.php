@php
    Theme::layout('homepage');
@endphp
<div class="container py-4">
    <div class="text-center mb-4">
        <h1 class="display-5 fw-bold">Our Fleet of Buses, Vans & Pickups</h1>
        <p class="text-muted mb-0">
            Explore our wide range of buses, vans, pickups, and commercial vehicles available for rental across the UAE.
        </p>
    </div>
</div>


{!! apply_filters('ads_render', null, 'car_list_before', ['class' => 'mb-2']) !!}

{!! do_shortcode('[car-list enable_filter="yes" default_layout="grid"][/car-list]') !!}

{!! apply_filters('ads_render', null, 'car_list_after', ['class' => 'mt-2']) !!}
