@php
    $formId = $formId ?? 'cars-filter-form';
@endphp

{!! Form::open(['url' => route('public.ajax.cars'), 'method' => 'GET', 'id' => $formId, 'class' => 'sidebar-filter-mobile__content']) !!}
    <input type="hidden" name="page" value="{{ $cars->currentPage() ?: 1 }}" data-value="{{ $cars->currentPage() ?: 1 }}" />
    <input type="hidden" name="per_page" value="{{ BaseHelper::stringify(request()->query('per_page', $cars->perPage())) }}" />
    <input type="hidden" name="layout" value="{{ $layout }}" />
    <input type="hidden" name="layout_col" value="{{ $col }}" />
    <input type="hidden" name="filter" value="{{ $enableFilter }}" />
    <input type="hidden" name="sort_by" value="{{ BaseHelper::stringify(request()->query('sort_by')) }}" />
    <input type="hidden" name="start_date" value="{{ BaseHelper::stringify(request()->query('start_date')) }}" />
    <input type="hidden" name="end_date" value="{{ BaseHelper::stringify(request()->query('end_date')) }}" />
    <input type="hidden" name="country_id" value="{{ $locationFilters['country_id'] ?? request()->input('country_id', 0) }}" />
    <input type="hidden" name="state_id" value="{{ $locationFilters['state_id'] ?? request()->input('state_id', 0) }}" />
    <input type="hidden" name="city_id" value="{{ $locationFilters['city_id'] ?? request()->input('city_id', 0) }}" />
    <input type="hidden" name="car_list_shortcode_location_filter" value="{{ (int) ($locationFilters['car_list_shortcode_location_filter'] ?? request()->input('car_list_shortcode_location_filter', false)) }}" />

    @include(Theme::getThemeNamespace('views.car-rentals.car-list.partials.filter-content'), ['formId' => $formId])
{!! Form::close() !!}
