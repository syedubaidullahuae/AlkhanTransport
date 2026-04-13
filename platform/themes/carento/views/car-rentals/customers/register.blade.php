@php
Theme::set('breadcrumb_simple', true);
@endphp

{!! $form->renderForm() !!}

<div class="modal fade" id="addCarModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add Car</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" style="max-height: 400px; overflow-y: auto; padding:0px">
                <div class="booking-form"  style="margin-bottom: 0px;">

                    <div class="content-booking-form">



                        <div class="mb-3 position-relative">
                            <fieldset class="form-fieldset fieldset-for-multi-check-list">
                                <div class="multi-check-list-wrapper">
                                    <div class="row">
                                        <div class="col-12">
                                            <label class="form-check">
                                                <input type="checkbox" id="service-ids-item-1" class="form-check-input" name="vendor_car[]"  value="bus" >

                                                <span class="form-check-label">
                                                    Bus
                                                </span>

                                            </label>

                                        </div>

                                        <div class="col-12">
                                            <label class="form-check">
                                                <input type="checkbox" id="service-ids-item-1" class="form-check-input" name="vendor_car[]"  value="school-bus" >

                                                <span class="form-check-label">
                                                    School Bus
                                                </span>

                                            </label>

                                        </div>


                                        <div class="col-12">
                                            <label class="form-check">
                                                <input type="checkbox" id="service-ids-item-1" class="form-check-input" name="vendor_car[]"  value="luxury-bus" >

                                                <span class="form-check-label">
                                                    Luxury Bus
                                                </span>

                                            </label>

                                        </div>
                                    </div>



                                </div>
                            </fieldset>
                        </div>
                    </div>

                </div>

                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="saveCarBtn">Save</button>
            </div>

        </div>

    </div>
</div>