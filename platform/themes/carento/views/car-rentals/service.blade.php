@php
    Theme::set('breadcrumbs', false);
    Theme::layout('full-width');
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

<div class="page-header pt-30 background-body service-detail-page">
    <div class="custom-container position-relative mx-auto">
        <div class="bg-overlay rounded-12 overflow-hidden">
            {{ RvMedia::image($service->image, $service->name, 'large-rectangle', attributes: ['class' => 'w-100 h-100 rounded-12 img-banner']) }}
        </div>
        <div class="background-body position-absolute z-1 top-100 start-50 translate-middle px-3 py-2 rounded-12 border gap-3 d-none d-md-flex w-md-75">
            @foreach (Theme::breadcrumb()->getCrumbs() as $crumb)
                @if (! $loop->last)

                    <a href="{{ $crumb['url'] }}" title="{{ $crumb['label'] }}" class="neutral-700 text-md-medium">{{ $crumb['label'] }}</a>
                    <span>
                    <img src="{{ Theme::asset()->url('images/icons/arrow-right.svg') }}" alt="Icon" />
                </span>
                @else
                    <a href="#" class="neutral-1000 text-md-bold">{{ $crumb['label'] }}</a>
                @endif
            @endforeach
        </div>
    </div>
</div>



<section class="box-section background-body">
    <div class="container">
        <div class="section-box background-body py-96 post-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                         {!! $service->content !!}
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
