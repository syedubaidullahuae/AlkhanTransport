@extends(Theme::getThemeNamespace('layouts.base'))

@section('content')
@if(Theme::get('breadcrumbs', true))
{!! Theme::partial('breadcrumbs') !!}
@endif

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

{!! Theme::get('beforeContent') !!}

<section class="box-section background-body">
    <div class="container">
        <div class="section-box background-body py-96 post-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        {!! Theme::content() !!}
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
@endsection