<form method="POST" action="{{ $form->getUrl() }}" class="booking-form">
    @csrf

    {{-- Hidden --}}
    {!! $form->renderField('car_id') !!}

    <div class="row">

        {{-- Rent Type --}}
        <div class="col-md-6">
            {!! $form->renderField('rent_type') !!}
        </div>

        {{-- Months --}}
        <div class="col-md-6">
            {!! $form->renderField('no_of_months') !!}
        </div>

        {{-- Dates --}}
        <div class="col-md-6">
            {!! $form->renderField('rental_start_date') !!}
        </div>

        <div class="col-md-6">
            {!! $form->renderField('rental_end_date') !!}
        </div>

        {{-- Customer Info --}}
        <div class="col-md-6">
            {!! $form->renderField('customer_name') !!}
        </div>

        <div class="col-md-6">
            {!! $form->renderField('customer_email') !!}
        </div>

        <div class="col-md-6">
            {!! $form->renderField('customer_phone') !!}
        </div>

        {{-- Services --}}
        <div class="col-md-12">
            {!! $form->renderField('service_ids[]') !!}
        </div>

        {{-- Estimate --}}
        <div class="col-md-12">
            {!! $form->renderField('total_estimate') !!}
        </div>

    </div>

    <div class="mt-3 text-end">
        {!! $form->renderField('submit') !!}
    </div>

</form>