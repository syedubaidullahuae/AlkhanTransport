<!doctype html>
<html {!! Theme::htmlAttributes() !!} data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=5, user-scalable=1" name="viewport" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! Theme::partial('css-variable-declare') !!}
     

    {!! Theme::header() !!}
    <style>
        .post-content h1{
            font-size: 32px !important;
            
        }
            .post-content h2{
        font-size: 24px !important;
        }
        .btn-whatsapp{
            background-color: #25D366;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
        }
    </style>
   
</head>

<body {!! Theme::bodyAttributes() !!} >

{!! apply_filters(THEME_FRONT_BODY, null) !!}

{!! Theme::partial('header') !!}

<main>
    @yield('content')
</main>


<div class="modal fade" id="bookingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content mb-30 background-card  p-4 rounded-3 mt-lg-0 ">

            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title neutral-1000 mb-2">{{ __('Book This Car') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="bookingModalBody">

            </div>

        </div>
    </div>
</div>

<script>
    'use strict';

    window.siteConfig = {
        locale: @json(app()->getLocale()),
        dateRangeSeparator: @json(' ' . __('to') . ' ')
    };
</script>

{!! Theme::partial('footer') !!}

{!! Theme::footer() !!}

<script>
$(document).ready(function () {

    var modal = new bootstrap.Modal(document.getElementById('bookingModal'));
    var modalBody = $('#bookingModalBody');

    $('.book-now-btn').on('click', function (e) {
        e.preventDefault();

        var carSlug = $(this).data('slug');
        console.log(carSlug);
        // Show loading
        modalBody.html('<div class="text-center p-4">Loading...</div>');

        // Open modal
        modal.show();

        // AJAX request
        $.ajax({
            url: '/rental-form/' + carSlug,
            type: 'GET',
            success: function (response) {
                modalBody.html(response.data);
            },
            error: function () {
                modalBody.html('<div class="text-danger">Failed to load form</div>');
            }
        });

    });

});
</script>
</body>
</html>
