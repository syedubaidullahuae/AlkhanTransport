<!doctype html>
<html {!! Theme::htmlAttributes() !!} data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! Theme::partial('css-variable-declare') !!}


    {!! Theme::header() !!}
    <style>
        .post-content h1 {
            font-size: 32px !important;

        }

        .post-content h2 {
            font-size: 24px !important;
        }

        .post-content h3 {
            font-size: 20px !important;
        }

        .post-content th,
        tr,
        td {
            border: 1px solid #ddd !important;
            padding: 8px !important;
        }

        .btn-whatsapp {
            background-color: #7aa93c;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
        }
        .select2-selection{
            height: 48px !important;
        }
        .select2-dropdown .select2-results__option[aria-selected=true] {
            background-color: #7aa93c !important;
        }
        .select2-selection__clear{
            display: none;
        }
        .select2-selection__choice{
            background-color: #7aa93c !important;
            border: none !important;
            color: #fff !important;
            padding: 4px 10px !important;
            border-radius: 20px !important;
            font-size: 13px !important;
        }

        .select2-container--default .select2-selection--multiple {
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    min-height: 48px;
    padding: 6px 10px;
    display: flex;
    align-items: center;
}

.select2-container--default .select2-selection--multiple:focus {
    border-color: #84cc16; /* green like your theme */
    box-shadow: 0 0 0 2px rgba(132, 204, 22, 0.2);
}

.select2-container--default .select2-selection__choice {
    background-color: #84cc16;
    border: none;
    color: #fff;
    padding: 4px 10px;
    border-radius: 20px;
    font-size: 13px;
}


.select2-container {
    width: 100% !important;
}
.select2-selection {
    min-height: 48px !important;
}

.select2-container--default .select2-selection__choice__remove {
    color: #fff;
    font-size: 14px;
    margin-right: 6px;
    border: none;
    background: transparent;
    cursor: pointer;
    font-weight: bold;
}

.select2-container--default .select2-selection__choice__remove:hover {
    color: #ff4d4f; /* red on hover */
}
    </style>

</head>

<body {!! Theme::bodyAttributes() !!}>

    {!! apply_filters(THEME_FRONT_BODY, null) !!}

    {!! Theme::partial('header') !!}

    <main>
        @yield('content')
    </main>


    <div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content mb-30 background-card  p-4 rounded-3 mt-lg-0 ">

                <div class="modal-header" style="border-bottom: none;">
                    <h5 class="modal-title neutral-1000 mb-2" id="car_title">{{ __('Book This Car') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body" id="bookingModalBody">

                    @php
                    use Carbon\Carbon;

                    $dateFormat = 'Y-m-d'; // HTML date input format
                    $startDate = request()->query('rental_start_date', Carbon::now()->format($dateFormat));
                    $endDate = request()->query('rental_end_date', Carbon::now()->addDay()->format($dateFormat));
                    @endphp

                    <form action="{{ route('public.checkout.post') }}" method="POST" data-estimate-url="{{ route('public.ajax.booking.estimate') }}" class="">
                        @csrf

                        <input type="hidden" id="cat_id" name="car_id" value="">

                        <div class="row">

                            {{-- Rent Type --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Rent Type</label>
                                    <select name="rent_type" class="form-select rent_type">
                                        <option value="daily">Daily Rent</option>
                                        <option value="monthly">Monthly Rent</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Months --}}
                            <div class="col-lg-6 months-field d-none">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Number of Months</label>
                                    <input type="number" name="no_of_months" class="form-control" value="1">
                                </div>
                            </div>

                            <div class="col-lg-6 item-line-booking border-bottom-0 pb-0 date-fields">
                                <strong class="text-sm-medium neutral-1000">Start Date</strong>
                                <div class="input-calendar">
                                    <input class="form-control calendar-date" type="text" name="rental_start_date" value="{{ $startDate }}">
                                    <svg class="icon icon-xs svg-icon-ti-ti-calendar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12"></path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </div>
                            </div>

                            <div class="col-lg-6 item-line-booking border-bottom-0 pb-0 date-fields">
                                <strong class="text-sm-medium neutral-1000">End Date</strong>
                                <div class="input-calendar">
                                    <input class="form-control calendar-date" type="text" name="rental_end_date" value="{{ $endDate }}">
                                    <svg class="icon icon-xs svg-icon-ti-ti-calendar" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12"></path>
                                        <path d="M16 3v4"></path>
                                        <path d="M8 3v4"></path>
                                        <path d="M4 11h16"></path>
                                        <path d="M11 15h1"></path>
                                        <path d="M12 15v3"></path>
                                    </svg>
                                </div>
                            </div>

                            {{-- Name --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Full Name</label>
                                    <input type="text" name="customer_name" class="form-control" placeholder="Enter your name">
                                </div>
                            </div>

                            {{-- Email --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Email</label>
                                    <input type="email" name="customer_email" class="form-control" placeholder="Enter email">
                                </div>
                            </div>

                            @php
                            $form = FormBuilder::create(\Botble\CarRentals\Forms\Fronts\Customers\PhoneBookinFrom::class);
                            @endphp

                            {{-- Phone --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Phone</label>
                                    {!! optional($form->getField('customer_phone'))->render() !!}

                                </div>
                            </div>

                            {{-- Services --}}
                            @if (!empty($services))
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="text-sm-medium neutral-1000">Additional Services</label>
                                    @foreach ($services as $service)
                                    <div>
                                        <input type="checkbox" name="service_ids[]" value="{{ $service->id }}">
                                        {{ $service->name }} - {{ $service->price_text }}
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            {{-- Estimate --}}


                            {{-- Submit --}}
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-book w-100">
                                    Book Now
                                </button>
                            </div>

                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>

    <script>
        'use strict';

        window.siteConfig = {
            locale: @json(app()->getLocale()),
            dateRangeSeparator: @json(' '.__('to').' ')
        };
    </script>

    {!! Theme::partial('footer') !!}

    {!! Theme::footer() !!}

    <script>
        $(document).ready(function() {

            var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
            var modalBody = $('#bookingModalBody');

            $('.book-now-btn').on('click', function(e) {
                e.preventDefault();

                var carSlug = $(this).data('slug');
                modal.show();
                $('#cat_id').val(carSlug);

                var CarTitle = $(this).data('title');

                $('#car_title').text(CarTitle);

            });
        });


        $("#vehicle_types").select2({
            width: '100%',
            allowClear: true
        });
    </script>
</body>

</html>