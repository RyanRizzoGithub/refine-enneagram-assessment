<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <link rel="icon" sizes="192x192" href="favicon.png">

        {{-- Fonts --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@700&family=Open+Sans:ital@0;1&family=Nunito+Sans:wght@900&family=Nunito+Sans:wght@600;900&display=swap" rel="stylesheet">

        {{-- Styles --}}
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        {{-- Scripts --}}
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            var stripeCustom = {
                "key": "{{ env('STRIPE_LIVE') ? env('STRIPE_KEY_LIVE') : env('STRIPE_KEY')}}",
                "price": "{{ env('STRIPE_CHARGE_AMOUNT') / 100 }}",
            };
        </script>
    </head>
    <body>
        <noscript>
            <strong>We're sorry but {{ config('app.name') }} doesn't work properly without JavaScript enabled. Please enable it to continue.</strong>
        </noscript>
        <div id="app"></div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
