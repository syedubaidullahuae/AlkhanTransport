@php

use Carbon\Carbon;



$linkNeedHelp = $shortcode->link_need_help;
$top = $shortcode->top;
$bottom = $shortcode->bottom;
$left = $shortcode->left;
$right = $shortcode->right;
$url = $shortcode->url;
$backgroundColor = $shortcode->background_color;


$variablesStyle = [
"margin-top: {$top}px" => $top,
"margin-bottom: {$bottom}px" => $bottom,
"margin-left: {$left}px" => $left,
"margin-right: {$right}px" => $right,
"background-color: $backgroundColor" => $backgroundColor,
"z-index: 10" => true,
"position: sticky" => true
];



$selectedTabs = explode(',', $shortcode->tabs ?: 'all,new_car,used_car');

$tabs = collect(['all' => __('All cars'), 'new_car' => __('New cars'), 'used_car' => __('Used cars')])
->reject(fn ($tab, $key) => ! in_array($key, $selectedTabs))
->sortBy(fn ($tab, $key) => array_search($key, $selectedTabs))
->all();

$isRentalEnabled = get_car_rentals_setting('enabled_car_rental', true);

$carCategories = \Botble\CarRentals\Facades\CarListHelper::carCategoriesForFilter();




$dateFormat = 'Y-m-d'; // HTML date input format
$startDate = request()->query('rental_start_date', Carbon::now()->format($dateFormat));
$endDate = request()->query('rental_end_date', Carbon::now()->addDay()->format($dateFormat));


@endphp

<section {!! $shortcode->htmlAttributes(['style' => $variablesStyle]) !!} class="shortcode-car-advance-search box-section box-search-advance-home10" id="js-box-search-advance">
    <div class="container">

        <div class="booking-from-advance booking-form">

            <div class="content-booking-form">

                <form action="{{ route('public.checkout.post') }}" method="POST" data-estimate-url="{{ route('public.ajax.booking.estimate') }}" class="booking-form-advance">
                    @csrf

                    <input type="hidden" name="car_id" value="1">

                    <div class="row">

                        {{-- Rent Type --}}
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-sm-medium neutral-1000">Rent Type</label>
                                <select name="rent_type" class="form-select">
                                    <option value="daily">Daily Rent</option>
                                    <option value="monthly">Monthly Rent</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-sm-medium neutral-1000">Vechical Type</label>
                                <select name="vehical_type" class="form-select">
                                    @foreach($carTypes as $carType)
                                    <option value="{{ $carType->id }}">{{ $carType->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        {{-- Months --}}
                        <div class="col-lg-3 position-relative">
                            <div class="form-group ">
                                <label class="text-sm-medium neutral-1000">Number of Months</label>
                                <input type="number" name="no_of_months" class="form-control " value="1">
                            </div>
                        </div>

                        <div class="col-lg-3 item-line-booking border-bottom-0 pb-0">
                            <strong class="text-sm-medium neutral-1000">Start Date</strong>
                            <div class="input-calendar">
                                <input class="form-control calendar-date" type="text" name="rental_start_date" value="2026-04-03">
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

                        <div class="col-lg-3 item-line-booking border-bottom-0 pb-0">
                            <strong class="text-sm-medium neutral-1000">End Date</strong>
                            <div class="input-calendar">
                                <input class="form-control calendar-date" type="text" name="rental_end_date" value="2026-04-03">
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
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-sm-medium neutral-1000">Full Name</label>
                                <input type="text" name="customer_name" class="form-control " placeholder="Enter your name">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-sm-medium neutral-1000">Email</label>
                                <input type="email" name="customer_email" class="form-control " placeholder="Enter email">
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label class="text-sm-medium neutral-1000">Phone</label>
                                {!! $phoneInput !!}
                            </div>
                        </div>

                        <div class="col-lg-3 extra-info" style="display: none;"></div>

                        {{-- Submit --}}
                        <div class="col-lg-3 mt-1">
                            <label class="text-sm-medium neutral-1000"></label>
                            <button type="submit" class="btn btn-book w-100">
                                Book Now
                            </button>
                        </div>

                    </div>
                </form>

            </div>


        </div>

    </div>
</section>