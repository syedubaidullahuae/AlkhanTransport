@php
    $alphabets = [];

   

     $clients = $clients->filter(fn ($item) => !empty(data_get($item, 'name')))
    ->sortBy(fn ($item) => strtolower(data_get($item, 'name')))
    ->values();

    foreach ($clients as $client) {
        $alphabets[] = substr($client['name'], 0, 1);
    }

    $alphabets = array_unique($alphabets);

    sort($alphabets);
@endphp

<div {!! $shortcode->htmlAttributes() !!} class="shortcode-brands brand-style-3 pb-70 pt-1">
    <div class="container filter-brands-by-alphabet">
        <div class="alphabet-grid mb-3 text-center">
            @if ($title)
                <h2 class="heading-3 mb-3 shortcode-title wow fadeInUp">{!! BaseHelper::clean($title) !!}</h2>
            @endif

            <div class="d-flex flex-wrap justify-content-center">
                @foreach($alphabets as $alphabet)
                    <button data-bb-toggle="filter-brands" data-bb-value="{{ $alphabet }}" class="letter-btn">{{ $alphabet }}</button>
                @endforeach
            </div>
        </div>

        <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-4 row-cols-xl-6 g-3">
            @foreach($clients as $client)
                <div class="col" data-bb-toggle="brand-item" data-bb-value="{{ substr($client['name'], 0, 1) }}">
                    <div class="brand-item text-center">
                        <a href="{{ $client['url'] }}">
                            <span title="{{ $client['name'] }}">
                            {{ RvMedia::image($client['logo'], $client['name'], attributes: ['class' => 'light-mode']) }}
                                {{ RvMedia::image($client['logo_dark'] ?? $client['logo'], $client['name'], attributes: ['class' => 'dark-mode']) }}
                        </span>
                        </a>
                    </div>
                    <h6 class="mt-3 text-center">
                        <a href="{{ $client['url'] }}"><span title="{{ $client['name'] }}">{!! BaseHelper::clean($client['name']) !!}</span></a>
                    </h6>
                </div>
            @endforeach
        </div>
    </div>
</div>
