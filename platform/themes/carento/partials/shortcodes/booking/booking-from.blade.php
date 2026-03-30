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

        <div class="booking-from-advance background-card p-4">

            <form action="{{ route('public.checkout.post') }}" method="POST" data-estimate-url="{{ route('public.ajax.booking.estimate') }}" class="booking-form-advance">
                @csrf

                <input type="hidden" name="car_id" value="1">

                <div class="row">

                    {{-- Rent Type --}}
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">Rent Type</label>
                            <select name="rent_type" class="booking-input">
                                <option value="daily">Daily Rent</option>
                                <option value="monthly">Monthly Rent</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">Vechical Type</label>
                            <select name="vehical_type" class="booking-input">
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
                            <input type="number" name="no_of_months" class="booking-input" value="1">
                        </div>
                    </div>

                    {{-- Start Date --}}
                    <div class="col-lg-3 item-line-booking">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">Start Date</label>
                            <input type="date" name="rental_start_date" class="booking-input" value="{{ $startDate  }}">
                        </div>
                    </div>

                    {{-- End Date --}}
                    <div class="col-lg-3 item-line-booking">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">End Date</label>
                            <input type="date" name="rental_end_date" class="booking-input" value="{{ $endDate  }}">
                        </div>
                    </div>



                    {{-- Name --}}
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">Full Name</label>
                            <input type="text" name="customer_name" class="booking-input" placeholder="Enter your name">
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="text-sm-medium neutral-1000">Email</label>
                            <input type="email" name="customer_email" class="booking-input" placeholder="Enter email">
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
</section>