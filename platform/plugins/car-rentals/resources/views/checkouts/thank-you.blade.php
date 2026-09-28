@extends('plugins/car-rentals::checkouts.layouts.master')

@section('title', __('Booking confirmed. Booking number :id', ['id' => $booking->booking_number]))

@push('header')
    <style>
        .booking-confirmation { max-width: 820px; margin: 0 auto; }
        .booking-confirmation__card { position: relative; overflow: hidden; background: #fff; border: 1px solid #e8edf2; border-radius: 24px; box-shadow: 0 24px 70px rgba(25, 42, 70, .11); text-align: center; animation: booking-confirmation-enter .65s cubic-bezier(.2, .8, .2, 1) both; }
        .booking-confirmation__card::before { position: absolute; top: 0; left: 0; width: 100%; height: 6px; background: linear-gradient(90deg, var(--primary-color), #73d5b2); content: ''; }
        .booking-confirmation__hero { display: flex; flex-direction: column; align-items: center; }
        .booking-confirmation__success-icon { width: 72px; height: 72px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; background: rgba(var(--primary-color-rgb), .1); color: var(--primary-color); font-size: 34px; box-shadow: 0 0 0 10px rgba(var(--primary-color-rgb), .045); animation: booking-confirmation-pop .55s .18s cubic-bezier(.2, .8, .2, 1) both; }
        .booking-confirmation__eyebrow { color: var(--primary-color); font-size: 12px; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
        .booking-confirmation__vehicle-image { display: block; width: min(100%, 190px); height: 116px; margin: 0 auto 14px; object-fit: cover; border-radius: 16px; background: #f3f5f7; box-shadow: 0 10px 24px rgba(25, 42, 70, .12); animation: booking-confirmation-image .7s .28s ease-out both; }
        .booking-confirmation__details { display: flex; flex-wrap: wrap; justify-content: center; gap: 12px; margin: 0 auto 28px; }
        .booking-confirmation__detail { min-width: 170px; padding: 17px 22px; border: 1px solid #e9eef3; border-radius: 16px; background: linear-gradient(145deg, #fff, #f8fafc); transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease; animation: booking-confirmation-detail .5s ease-out both; }
        .booking-confirmation__detail:hover { transform: translateY(-3px); border-color: rgba(var(--primary-color-rgb), .35); box-shadow: 0 10px 24px rgba(25, 42, 70, .08); }
        .booking-confirmation__detail-icon { display: block; margin-bottom: 7px; color: var(--primary-color); font-size: 20px; }
        .booking-confirmation__label { color: #737d89; font-size: 12px; font-weight: 600; letter-spacing: .04em; margin-bottom: 5px; text-transform: uppercase; }
        .booking-confirmation__value { color: #202833; font-weight: 700; margin-bottom: 0; }
        .booking-confirmation__reference { display: inline-block; min-width: 240px; padding: 14px 24px; border: 1px dashed rgba(var(--primary-color-rgb), .45); border-radius: 16px; background: rgba(var(--primary-color-rgb), .055) !important; }
        .booking-confirmation__section-title { display: flex; align-items: center; justify-content: center; gap: 9px; margin-bottom: 22px; }
        .booking-confirmation__section-title::before, .booking-confirmation__section-title::after { width: 34px; height: 1px; background: #e7ebef; content: ''; }
        .booking-confirmation__customer { max-width: 560px; margin: 0 auto 24px; padding: 20px; border: 1px solid #edf0f3; border-radius: 18px; background: #fafbfc; }
        .booking-confirmation .checkout-logo { text-align: center; }
        .booking-confirmation .order-customer-info { margin: 0; padding: 0; background: transparent; text-align: center; }
        .booking-confirmation .order-customer-info h3 { margin-bottom: 12px; font-weight: 700; }
        .booking-confirmation .order-customer-info-meta { padding-left: 6px; color: #344050; font-weight: 500; }
        .booking-confirmation .order-customer-info p { display: flex; justify-content: center; flex-wrap: wrap; gap: 4px; }
        .booking-confirmation__home-button { min-width: 190px; border-radius: 12px; padding: 12px 22px; box-shadow: 0 8px 18px rgba(var(--primary-color-rgb), .2); transition: transform .2s ease, box-shadow .2s ease; }
        .booking-confirmation__home-button:hover { transform: translateY(-2px); box-shadow: 0 12px 24px rgba(var(--primary-color-rgb), .28); }
        @keyframes booking-confirmation-enter { from { opacity: 0; transform: translateY(22px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes booking-confirmation-pop { 0% { opacity: 0; transform: scale(.65); } 75% { transform: scale(1.08); } 100% { opacity: 1; transform: scale(1); } }
        @keyframes booking-confirmation-image { from { opacity: 0; transform: translateY(10px) scale(.96); } to { opacity: 1; transform: translateY(0) scale(1); } }
        @keyframes booking-confirmation-detail { from { opacity: 0; transform: translateY(8px); } to { opacity: 1; transform: translateY(0); } }
        .booking-confirmation__detail:nth-child(2) { animation-delay: .08s; }
        .booking-confirmation__detail:nth-child(3) { animation-delay: .16s; }
        @media (max-width: 575.98px) {
            .booking-confirmation__card { border-radius: 18px; }
            .booking-confirmation__detail { width: 100%; }
            .booking-confirmation__reference { min-width: 0; width: 100%; }
        }
        @media (prefers-reduced-motion: reduce) {
            .booking-confirmation__card, .booking-confirmation__success-icon, .booking-confirmation__vehicle-image, .booking-confirmation__detail { animation: none; transition: none; }
        }
    </style>
@endpush

@section('content')
    @php
        $bookingCar = $booking->car;
        $car = $bookingCar->car;
        $isVehicleTypeBooking = (bool) $bookingCar->vehicle_type_id;
        $vehicleType = $isVehicleTypeBooking
            ? $bookingCar->vehicleType->name
            : ($car && $car->type ? $car->type->name : null);
        $isMonthlyRental = $bookingCar->rent_type === 'monthly';
        $months = (float) $bookingCar->no_of_months;
    @endphp

    <div class="booking-confirmation py-3 py-md-4">
        <div class="row">
            <div class="col-12">
                @include('plugins/car-rentals::checkouts.partials.logo')

                <section class="booking-confirmation__card p-4 p-md-5 mt-4">
                    <div class="booking-confirmation__hero mb-4">
                        <span class="booking-confirmation__success-icon">
                            <x-core::icon name="ti ti-circle-check-filled" />
                        </span>
                        <div class="mt-3">
                            <p class="booking-confirmation__eyebrow mb-2">{{ __('Booking complete') }}</p>
                            <h1 class="h3 mb-1">{{ __('Booking confirmed') }}</h1>
                            <p class="text-muted mb-0">{{ __('Thank you for choosing our service!') }}</p>
                        </div>
                    </div>

                    <div class="booking-confirmation__reference bg-light mb-4">
                        <p class="booking-confirmation__label mb-1">{{ __('Booking reference') }}</p>
                        <p class="booking-confirmation__value">{{ $booking->booking_number }}</p>
                    </div>

                    <h2 class="booking-confirmation__section-title h5">{{ __('Your booking details') }}</h2>
                    <div class="mb-4">
                        @if (! $isVehicleTypeBooking && $bookingCar->car_name)
                            <img
                                class="booking-confirmation__vehicle-image"
                                src="{{ RvMedia::getImageUrl($bookingCar->car_image, 'medium', false, RvMedia::getDefaultImage()) }}"
                                alt="{{ $bookingCar->car_name }}"
                            >
                            <h3 class="h5 mb-3">{{ $bookingCar->car_name }}</h3>
                        @endif
                        <div class="booking-confirmation__details">
                            @if ($vehicleType)
                                <div class="booking-confirmation__detail">
                                    <span class="booking-confirmation__detail-icon"><x-core::icon name="ti ti-category" /></span>
                                    <p class="booking-confirmation__label">{{ __('Vehicle type') }}</p>
                                    <p class="booking-confirmation__value">{{ $vehicleType }}</p>
                                </div>
                            @endif

                            @if ($isMonthlyRental && $months > 0)
                                <div class="booking-confirmation__detail">
                                    <span class="booking-confirmation__detail-icon"><x-core::icon name="ti ti-calendar-month" /></span>
                                    <p class="booking-confirmation__label">{{ __('Rental duration') }}</p>
                                    <p class="booking-confirmation__value">
                                        {{ rtrim(rtrim(number_format($months, 2, '.', ''), '0'), '.') }}
                                        {{ $months === 1.0 ? __('month') : __('months') }}
                                    </p>
                                </div>
                            @elseif ($bookingCar->rental_start_date && $bookingCar->rental_end_date)
                                <div class="booking-confirmation__detail">
                                    <span class="booking-confirmation__detail-icon"><x-core::icon name="ti ti-calendar-event" /></span>
                                    <p class="booking-confirmation__label">{{ __('From date') }}</p>
                                    <p class="booking-confirmation__value">{{ $bookingCar->rental_start_date->format('M d, Y') }}</p>
                                </div>
                                <div class="booking-confirmation__detail">
                                    <span class="booking-confirmation__detail-icon"><x-core::icon name="ti ti-calendar-event" /></span>
                                    <p class="booking-confirmation__label">{{ __('To date') }}</p>
                                    <p class="booking-confirmation__value">{{ $bookingCar->rental_end_date->format('M d, Y') }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="booking-confirmation__customer">
                        @include('plugins/car-rentals::checkouts.partials.customer-info', ['customer' => $booking->customer, 'booking' => $booking])
                    </div>

                    <a class="btn btn-primary payment-checkout-btn booking-confirmation__home-button mt-2" href="{{ BaseHelper::getHomepageUrl() }}">
                        <x-core::icon name="ti ti-home" />
                        {{ __('Back to home') }}
                    </a>
                </section>
            </div>
        </div>
    </div>
@stop
