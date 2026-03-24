@if(!empty($categories))
<div class="vehicle-wrapper">

    <div class="container">

        <h2 class="text-center fw-bold mb-3">{{ $title }}</h2>
        <p class="text-center text-muted mb-4">{{ $description }}</p>

        <div class="row">

            @foreach($categories->chunk(ceil($categories->count() / 3)) as $chunk)
                <div class="col-md-4">

                    <ul class="vehicle-list">
                        @foreach($chunk as $category)
                            <li>
                                <a href="{{ route('car-rentals.category', $category->slug) }}">
                                    <span class="dot"></span>
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
            @endforeach

        </div>

    </div>

</div>
@endif
<style>
    .vehicle-wrapper {
    background: #f8f9fa;
    padding: 40px 20px;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
}

.vehicle-list {
    list-style: none !important;
    padding: 0;
    margin: 0;
}

.vehicle-list li {
    padding: 20px 0;
    font-size: 18px;
    border-bottom: 1px solid #e5e5e5;
}

.vehicle-list li:last-child {
    border-bottom: none;
}

.vehicle-list a {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: #0d3b66;
    font-weight: 500;
    transition: all 0.3s ease;
}

.vehicle-list a:hover {
    color: #007bff;
    padding-left: 5px;
}

.dot {
    width: 8px;
    height: 8px;
    background: green;
    display: inline-block;
    border-radius: 2px;
}
</style>