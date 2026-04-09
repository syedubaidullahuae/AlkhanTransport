@php
Theme::layout('homepage');
@endphp
<style>
    .booking-sidebar {
    top: 100px;
        z-index: revert-layer;
}

@media (max-width: 991px) {
    .booking-sidebar {
        position: static !important;
    }
}
</style>



<section class="box-section background-body">
    <div class="container">
        <div class="section-box background-body py-96 post-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        {!! apply_filters('ads_render', null, 'car_list_before', ['class' => 'mb-2']) !!}

                        @php
                            request()->merge([
                            'car_categories' => [$category->id]
                            ]);
                        @endphp
                        {!! do_shortcode('[car-list enable_filter="no" default_layout="grid"][/car-list]') !!}
                        {!! apply_filters('ads_render', null, 'car_list_after', ['class' => 'mt-2']) !!}

                        {!! $category->content  !!}
                    </div>
                    <div class="col-lg-4">
                        <div class="booking-sidebar sticky-top">

                            {!! do_shortcode('[booking-form-style-2]') !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>