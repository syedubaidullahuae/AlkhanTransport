@if(!empty($categories))
<div class="vehicle-wrapper">

    <div class="container">

        <h2 class="text-center fw-bold mb-3">{{ $title }}</h2>
        <p class="text-center text-muted mb-4">{{ $description }}</p>

        <div class="row">

            @foreach($categories as $category)

            <div class="col-lg-4 col-md-6">
                <div class="card-news background-card hover-up mb-24">
                    <div class="card-image">
                        {!! RvMedia::image($category->image, $category->name, 'medium-rectangle') !!}
                    </div>
                    <div class="card-info">
                        <div class="card-title mb-3">
                            <a class="text-xl-bold neutral-1000" href="{{ route('car-rentals.category', $category->slug) }}">{{ $category->name }}</a>

                            @if ($description = $category->description)
                            <p class="text-md-medium neutral-500 mt-2 truncate-3-custom">{!! BaseHelper::clean($description) !!}</p>
                            @endif
                        </div>
                        <div class="card-program">
                            <div class="endtime">
                                <div class="card-button"><a class="btn btn-primary2" href="{{ route('car-rentals.category', $category->slug) }}">{{ __('View Details') }}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

        </div>

    </div>

</div>
@endif
