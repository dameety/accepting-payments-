<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Grape-shop Subscription</title>
        <link rel="stylesheet" href="{{ asset('vendor/swiftpay/css/bulma.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/swiftpay/css/checkout.css') }}">

    </head>

    <body class="app">

        <div class="app-body">

            <!-- @yield('content') -->

        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('vendor/swiftpay/js/stripe-config.js') }}"></script>
    </body>

</html>
