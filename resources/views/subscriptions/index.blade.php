<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Grape-shop Subscription</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="{{ asset('css/bulma.css') }}">
        <link rel="stylesheet" href="{{ asset('css/stripe.css') }}">
    </head>

    <body class="app">
        <div class="container">

            <section class="section is-fullheight">
                <div class="container">
                    <div class="column box is-5 group">

                        <div id="img-column" class="column img-column">
                            <img src="/products/grapes.jpg">
                        </div>

                        <div class="column has-text-centered product-info">
                            <p>
                                Our grape shop subscritption offers great service that enables you to get the maximum enjoyment from your choice fruit.
                            </p>
                        </div>

                        <div id="input-column" class="column has-text-centered">
                            <form action="{{ route('subscription.create') }}" method="POST">
                            {{ csrf_field() }}

                                <input name="stripe_token" type="hidden" type="text"/>

                                <div class="field">
                                    <div class="control has-icons-left">
                                        <input class="input {{ $errors->has('phone') ? ' is-danger' : '' }}" type="phone" name="phone" required autofocus>
                                        <span class="icon is-left">
                                            <i class="fa fa-phone-square"></i>
                                        </span>
                                    </div>
                                </div>

                                <div id="card-element" class="field"></div>

                                <hr>

                                <div id="session-messages" class="column has-text-centered _session-messages">
                                    <div class="error" role="alert"></div>
                                    @include('subscriptions.partials._session-messages')
                                </div>

                                <div class="field">
                                    <button type="submit" id="pay-button" class="button is-primary is-fullwidth">Pay $100/Month</button>
                                </div>

                            </form>
                        </div>

                    </div>
                </div>
            </section>

        </div>

        <script src="https://js.stripe.com/v3/"></script>
        <script src="{{ asset('js/stripe-config.js') }}"></script>
    </body>

</html>
