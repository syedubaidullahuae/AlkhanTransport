@php
    $servicesChunks = $services->chunk(ceil($services->count() / 2));

  
@endphp
<section {!! $shortcode->htmlAttributes() !!} class="shortcode-cars car-style-popular section-box box-flights background-body">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-6 mb-30 text-center text-lg-start">
                @if(empty($title) === false)
                <h2 class="shortcode-title">{!! BaseHelper::clean($title) !!}</h2>
                @endif
                @if(empty($subtitle) === false)
                <p class="text-xl-medium shortcode-subtitle">{!! BaseHelper::clean($subtitle) !!}</p>
                @endif
            </div>

        </div>
        <div id="content-popular-vehicles">
            <div class="block-flights wow fadeInUp">
                <div class="box-swiper mt-30">
                    @if($services->isNotEmpty())
                    <div class="swiper-container swiper-group-2 swiper-group-journey">
                        <div class="swiper-wrapper">
                            @foreach($servicesChunks as $servicesChunk)

                           
                            <div class="swiper-slide">
                                 @foreach($servicesChunk as $service)

                                    @php
                                        $keyword = trim($shortcode->keyword ?? '');

                                        if ($keyword !== '') {
                                            $serviceName = $keyword . ' IN ' . $service->name ;
                                        } else {
                                            $serviceName = $service->name;
                                        }
                                    @endphp


                                <div class="card-journey-small card-journey-small-listing-3 background-0 d-flex flex-md-row flex-column align-items-center mw-100 position-relative">
                                    <div class="card-image w-100">
                                        <a href="{{ $service->url }}">
                                            {!! RvMedia::image($service->image, $service->name, 'small-rectangle') !!}
                                        </a>
                                    </div>
                                    <div class="card-info p-4 mt-0 position-relative end-0  w-lg-55 rounded-12">
                                        <div class="card-rating position-relative start-0 top-0 pt-2">
                                            <div class="card-right">

                                            </div>
                                        </div>
                                        <div class="card-title pb-1"><a class="heading-6 neutral-1000 text-ellipsis-2-lines" href="{{ $service->url }}" title="{{ $serviceName }}">{{ $serviceName }}</a></div>
                                        <div class="card-program">
                                            <div class="card-facilities border-0 pb-1">
                                                @if ($description = $service->description)
                                                @php
                                                $description = str_replace('[company_name]', setting('car_rentals_app_name'), $service->description);
                                                @endphp
                                                <p class="text-md-medium neutral-500 mt-2 truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                                                @endif
                                            </div>


                                            <div class="endtime border-top pt-2 pb-2">
                                                
                                                @include(Theme::getThemeNamespace('views.car-rentals.book-now-button'), ['service' => $service])
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <p class="text-xl-medium neutral-500">{{ __('No matching vehicle information found') }}</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</section>