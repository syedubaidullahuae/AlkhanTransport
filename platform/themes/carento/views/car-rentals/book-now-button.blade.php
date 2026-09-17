@if (CarRentalsHelper::isRentalBookingEnabled() && ! $car->is_for_sale)

<div class="d-flex gap-2 mb-2">

    {{-- Book Now --}}
    <div class="card-button flex-fill">
        <button type="button" class="btn btn-gray w-100 book-now-btn" data-slug="{{ $car->id }}" data-title="{{ $car->name }}" >
            {{ __('Book Now') }}
        </button>
    </div>

    {{-- WhatsApp --}}
    @if (setting('car_rentals_whatsapp_enable'))
     @php
        $number = setting('car_rentals_whatsapp_number');
        $template = setting('car_rentals_whatsapp_message');

        $message = str_replace(
            ['{{car_name}}', '{{price}}', '{{url}}'],
            [
                $car->name,
                format_price($car->price),
                url($car->url), // Always generate a full URL
            ],
            $template
        );

        $whatsappUrl = 'https://wa.me/' . preg_replace('/\D/', '', $number) . '?text=' . urlencode($message);
    @endphp

    <div class="card-button flex-fill">
        <button type="button" class="btn  btn-whatsapp w-100" data-url="{{ $whatsappUrl }}" >
            <i class="bi bi-whatsapp"></i>
        </button>
        
    </div>
    @endif

</div>

@endif