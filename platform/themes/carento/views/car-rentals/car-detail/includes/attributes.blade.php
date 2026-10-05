<div class="box-feature-car">
    <div class="list-feature-car">
     

        @if($horsepower = $car->horsepower)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        <x-core::icon name="ti ti-engine" class="icon-horsepower" />
                    </div>
                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{{ __(':number HP', ['number' => $horsepower]) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($fuel = $car->fuel)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        {!! BaseHelper::renderIcon($car->fuel_icon, attributes: ['class' => 'icon-fuel']) !!}
                    </div>

                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{!! BaseHelper::clean($fuel->name) !!}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($transmission = $car->transmission)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        {!! BaseHelper::renderIcon($car->transmission_icon, attributes: ['class' => 'icon-transmission']) !!}
                    </div>

                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{!! BaseHelper::clean($transmission->name) !!}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($numberSeats = $car->number_of_seats)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        {!! BaseHelper::renderIcon($car->seats_icon, attributes: ['class' => 'icon-seats']) !!}
                    </div>
                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{{ __(':number Seats', ['number' => $numberSeats]) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if($type = $car->type)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    @if($iconType = $type->icon)
                        <div class="feature-image">
                            {!! BaseHelper::renderIcon($iconType) !!}
                        </div>
                    @endif

                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{!! BaseHelper::clean($type->name) !!}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($numberDoors = $car->number_of_doors)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        <x-core::icon name="ti ti-door" class="icon-doors" />
                    </div>

                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{{ __(':number Doors', ['number' => $numberDoors]) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if ($luggage_capacity = $car->luggage_capacity)
            <div class="item-feature-car w-md-25">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        <x-core::icon name="ti ti-luggage" class="icon-luggage" />
                    </div>

                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{{ __(':number Luggage', ['number' => $luggage_capacity]) }}</p>
                    </div>
                </div>
            </div>
        @endif

        @php
            $camperSpecifications = array_values(array_filter([
                [
                    'label' => __('Passenger capacity'),
                    'value' => ($car->adult_passenger_capacity || $car->child_passenger_capacity)
                        ? __(':adults adults + :children children', ['adults' => $car->adult_passenger_capacity ?? 0, 'children' => $car->child_passenger_capacity ?? 0])
                        : null,
                    'icon' => 'ti ti-users-group',
                ],
                [
                    'label' => __('Fresh water tank'),
                    'value' => $car->fresh_water_tank_capacity ? __(':capacity liters', ['capacity' => $car->fresh_water_tank_capacity]) : null,
                    'icon' => 'ti ti-droplet',
                ],
                ['label' => __('Private shower & toilet'), 'value' => $car->has_private_shower_toilet ? __('Included') : null, 'icon' => 'ti ti-bath'],
                ['label' => __('Water heater'), 'value' => $car->has_water_heater ? __('Included') : null, 'icon' => 'ti ti-temperature'],
                ['label' => __('Kitchen utensils set'), 'value' => $car->has_kitchen_utensils ? __('Included') : null, 'icon' => 'ti ti-tools-kitchen-2'],
                [
                    'label' => __('Fully equipped kitchen'),
                    'value' => implode(', ', array_filter([
                    $car->has_stove ? __('stove') : null,
                    $car->has_fridge ? __('fridge') : null,
                    $car->has_sink ? __('sink') : null,
                    ])) ?: null,
                    'icon' => 'ti ti-tools-kitchen-2',
                ],
                ['label' => __('Seatbelts for kids'), 'value' => $car->has_child_seatbelts ? __('Included') : null, 'icon' => 'ti ti-baby-carriage'],
                ['label' => __('1 double bed'), 'value' => $car->double_bed_dimensions ? __(':dimensions mm', ['dimensions' => $car->double_bed_dimensions]) : null, 'icon' => 'ti ti-bed'],
                ['label' => __('1 single convertible sofa bed'), 'value' => $car->single_convertible_sofa_bed_dimensions ? __(':dimensions mm', ['dimensions' => $car->single_convertible_sofa_bed_dimensions]) : null, 'icon' => 'ti ti-armchair'],
            ], fn ($specification) => $specification['value'] !== null));
        @endphp

        @foreach ($camperSpecifications as $specification)
            <div class="item-feature-car">
                <div class="item-feature-car-inner">
                    <div class="feature-image">
                        <x-core::icon :name="$specification['icon']" />
                    </div>
                    <div class="feature-info">
                        <p class="text-md-medium neutral-1000">{{ $specification['label'] }} <span class="text-sm neutral-700"> {{ $specification['value'] }} </span> </p>
                        
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

