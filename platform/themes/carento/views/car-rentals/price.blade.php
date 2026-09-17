@php

    $isPriceEnabled = get_car_rentals_setting('enabled_car_price', true);

  
@endphp


<div class="card-price" style="{{ $isPriceEnabled ? '' : 'display: none;' }}" >
    <p>
        <span class="heading-6 neutral-1000 car-price-text">{{ $car->price_html }}</span>
    </p>
</div>
