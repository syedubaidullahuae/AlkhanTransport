@php

use Carbon\Carbon;


$carCategories = \Botble\CarRentals\Facades\CarListHelper::carCategoriesForFilter();




$dateFormat = 'Y-m-d'; // HTML date input format
$startDate = request()->query('rental_start_date', Carbon::now()->format($dateFormat));
$endDate = request()->query('rental_end_date', Carbon::now()->addDay()->format($dateFormat));


@endphp

<div class="">
    <div class="booking-form">
        <div class="head-booking-form">
            <p class="text-xl-bold neutral-1000">Rent This Vehicle</p>
        </div>
        <div class="content-booking-form" style="padding-top: 0px;">
            <form action="{{ route('public.checkout.post') }}" method="POST" data-estimate-url="{{ route('public.ajax.booking.estimate') }}" class="booking-form-advance">
                @csrf

                <div class="mb-3 position-relative">

                    <label class="form-label form-label required" for="rent_type"> Rent Type </label>
                    <select class="form-select" required="required" name="rent_type">
                        <option value="daily" selected="selected">Daily Rent</option>
                        <option value="monthly">Monthly Rent</option>
                    </select>
                </div>

                <div class="mb-3 position-relative">

                    <label class="form-label form-label required" for="vehical_type">Vechical Type </label>
                    <select class="form-select" required="required" name="vehical_type">
                        @foreach($carTypes as $carType)
                        <option value="{{ $carType->id }}">{{ $carType->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 position-relative">

                    <label class="form-label form-label required" for="no_of_months">Number of Months </label>
                    <input type="number" name="no_of_months" class="booking-input" value="1">
                </div>

        
                <div class="item-line-booking border-bottom-0 pb-0">
                    <strong class="text-md-bold neutral-1000">Pick-Up</strong>
                    <div class="input-group mt-2">
                        <input class="form-control calendar-date" type="text" name="rental_start_date" value="{{ $startDate }}" aria-invalid="false">
                        <span class="input-group-text">
                            <i class="bi bi-calendar3"></i>
                        </span>
                    </div>
                </div>

                <div class="item-line-booking border-bottom-0 pb-0">
                    <strong class="text-md-bold neutral-1000">Drop-Off</strong>
                    <div class="input-group mt-2">
                        <input class="form-control calendar-date" type="text" name="rental_end_date"  value="{{ $endDate }}" aria-invalid="false">
                        <span class="input-group-text">
                            <i class="bi bi-calendar3"></i>
                        </span>
                    </div>
                </div>

                <hr>

                <div class="mb-3 position-relative">

                    <label class="form-label  required" for="customer_name">Full Name <span class="text-danger">*</span></label>
                    <input type="text" name="customer_name" id="customer_name" class="" placeholder="Enter your full name" >
                </div>

                <div class="mb-3 position-relative">

                    <label class="form-label  required" for="customer_email"> Email  <span class="text-danger">*</span></label>
                    <input type="email" name="customer_email" id="customer_email" class=""  placeholder="Enter your email">
                </div>

                <div class="mb-3 position-relative">

                    <label class="form-label  required" for="customer_phone">Phone <span class="text-danger">*</span></label>
                    {!! $phoneInput !!}
                </div>

                <button type="submit" class="btn btn-book">
                            Book Now
                        </button>


            </form>
        </div>
    </div>

</div>