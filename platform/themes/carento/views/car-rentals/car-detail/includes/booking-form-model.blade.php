@php
    use Carbon\Carbon;

    $dateFormat = 'Y-m-d'; // HTML date input format
    $startDate = request()->query('rental_start_date', Carbon::now()->format($dateFormat));
    $endDate = request()->query('rental_end_date', Carbon::now()->addDay()->format($dateFormat));
@endphp


<form action="{{ route('public.checkout.post') }}" method="POST" data-estimate-url="{{ route('public.ajax.booking.estimate') }}"  class="">
    @csrf

    <input type="hidden" name="car_id" value="{{ $car->id }}">

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

        {{-- Start Date --}}
        <div class="col-lg-6 date-fields">
            <div class="form-group">
                <label class="text-sm-medium neutral-1000">Start Date</label>
                <input type="date" name="rental_start_date" class="form-control" value="{{ $startDate  }}">
            </div>
        </div>

        {{-- End Date --}}
        <div class="col-lg-6 date-fields">
            <div class="form-group">
                <label class="text-sm-medium neutral-1000">End Date</label>
                <input type="date" name="rental_end_date" class="form-control" value="{{ $endDate  }}">
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

        {{-- Phone --}}
        <div class="col-lg-6">
            <div class="form-group">
                <label class="text-sm-medium neutral-1000">Phone</label>
                {!! $phoneInput !!}
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

