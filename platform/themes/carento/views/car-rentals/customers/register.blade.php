@php
Theme::set('breadcrumb_simple', true);
@endphp



{!! $form->renderForm() !!}


<div class="modal fade" id="vehicleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content mb-30 background-card  p-4 rounded-3 mt-lg-0 ">

            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title neutral-1000 mb-2" id="car_title">Select Vechical Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="padding: 0px;">
                <div class="booking-form">
                    <div class="content-booking-form">
                        <div class="mb-3 position-relative">
                            <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                <div class="multi-check-list-wrapper">


                                    @php

                                    $vehicleTypes = \Botble\CarRentals\Models\CustomerCarType::query()
                                    ->wherePublished()
                                    ->pluck('name', 'id')
                                    ->toArray();

                                    @endphp

                                    @foreach($vehicleTypes as $id => $name)

                                    <label class="form-check">
                                        <input type="checkbox" name="vehicle_types[]" class="form-check-input" value="{{ $id }}" data-name="{{ $name }}">

                                        <span class="form-check-label">
                                            {{ $name }}
                                        </span>

                                    </label>
                                    @endforeach

                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="applyVehicle" class="btn btn-primary">
                    Save
                </button>
            </div>

        </div>
    </div>
</div>