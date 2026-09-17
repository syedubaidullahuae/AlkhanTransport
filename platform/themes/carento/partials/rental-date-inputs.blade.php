@php
    $startDate = request()->query('rental_start_date', now()->format('Y-m-d'));
    $endDate = request()->query('rental_end_date', now()->addDay()->format('Y-m-d'));
@endphp

<div class="item-line-booking border-bottom-0 pb-0">
    <strong class="text-md-bold neutral-1000">{{ __('Pick-Up') }}</strong>
  
        <div class="input-group mt-2">
            <input class="form-control calendar-date" type="text" name="rental_start_date" value="{{ $startDate }}">
            <span class="input-group-text">
                <i class="bi bi-calendar3"></i>
            </span>
            
        </div>
 
</div>
<div class="item-line-booking border-bottom-0 pb-0">
    <strong class="text-md-bold neutral-1000">{{ __('Drop-Off') }}</strong>
    <div class="input-group mt-2">
        <input class="form-control calendar-date" type="text"  name="rental_end_date" value="{{ $endDate }}">
        <span class="input-group-text">
            <i class="bi bi-calendar3"></i>
        </span>
       
    </div>
</div>
<hr>
