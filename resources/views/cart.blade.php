<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pirkumu grozs</title>

        <!-- Fonts -->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
        <style>
            .StripeElement {
                box-sizing: border-box;
                height: 40px;
                padding: 10px 12px;
                border: 1px solid transparent;
                border-radius: 4px;
                background-color: white;
                box-shadow: 0 1px 3px 0 #e6ebf1;
                -webkit-transition: box-shadow 150ms ease;
                transition: box-shadow 150ms ease;
            }
            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }
            .StripeElement--invalid {
                border-color: #fa755a;
            }
            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }
        </style>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        
    </head>
    <body class="antialiased bg-gray-200">
       <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-md py-2 bg-white relative flex items-center w-full justify-between">
    <div class="px-6 w-full flex flex-wrap items-center justify-between">
      <div class="flex items-center">
        <button
          class="navbar-toggler border-0 py-3 lg:hidden leading-none text-xl bg-transparent text-gray-600 hover:text-gray-700 focus:text-gray-700 transition-shadow duration-150 ease-in-out mr-2"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContentY"
          aria-controls="navbarSupportedContentY"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <svg
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            class="w-5"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 448 512"
          >
            <path
              fill="currentColor"
              d="M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z"
            ></path>
          </svg>
        </button>
      </div>
      <div class="navbar-collapse collapse grow items-center" id="navbarSupportedContentY">
        <ul class="navbar-nav mr-auto lg:flex lg:flex-row">
          <li class="nav-item">
            <span class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out">{{ auth()->user()->name }}<span>
          </li>
          <li class="nav-item">
            <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('products') }}">Produkti</a>
          </li>
          
          <li class="nav-item mb-2 lg:mb-0">
            <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('cart') }}">Grozs</a>
          </li>
          
          <li>
           @auth
                <a class="dnav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Izrakstīties') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @endauth
          </li>
        </ul>
      </div>
    </div>
  </nav>
@include('flash-messages')
            <div class="grid place-items-center mt-10">
            <div class="bg-white p-2 rounded shadow-xl">
                <h1>Pirkumu grozs</h1>
                @foreach($cart as $item)
                <div style="border: 1px solid black; padding: 5px;">
                    <div>{{ $item->name }}</div>
                    <div>{{ "EUR ".number_format($item->price/100, 2) }}</div>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        <button class="inline-block px-6 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-gray-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Noņemt</button>
                    </form>
                </div>
                @endforeach
                <div style="text-align: right; padding: 5px;">Kopā apmaksai:
                    <span>
                        <div>{{ "EUR ".number_format($total/100, 2) }}</div>
                    </span>
                </div>
                <form action="{{ route('cart.purchase') }}" 
                            method="POST" id="payment-form" 
                            class="require-validation"
                            data-cc-on-file="false"
                            data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                    @csrf


                    <input type="hidden" name="payment_method" class="payment-method">
                    <input class="StripeElement mb-3" name="card_holder_name" placeholder="Card holder name" required>
                    <div class="col-lg-4 col-md-6">
                        <div id="card-element"></div>
                    </div>
                    <div id="card-errors" role="alert"></div>
                    <span>
                        <small>Maksātājs:</small>
                    </span>
                    <input id="card-holder-name" type="text" value="{{ auth()->user()->name }}" disabled>
                    <input type="hidden" name="total" value="{{ $total }}">
                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" style="display: flex; flex-direction:column; width:400px"></div>
                    
                    <button type="submit" id="card-button" class="pay inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
                        Apstiprināt un maksāt
                    </button>

                   



                    
                </div>
            </div>
        </div>
        </div>

        

        
    </body>
<script src="https://js.stripe.com/v3/"></script>
            <script>
                let stripe = Stripe("{{ env('STRIPE_KEY') }}")
                let elements = stripe.elements()
                let style = {
                    base: {
                        color: '#32325d',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                }
                let card = elements.create('card', {style: style})
                card.mount('#card-element')
                let paymentMethod = null
                $('.card-form').on('submit', function (e) {
                    $('button.pay').attr('disabled', true)
                    if (paymentMethod) {
                        return true
                    }
                    stripe.confirmCardSetup(
                        "{{ $intent->client_secret }}",
                        {
                            payment_method: {
                                card: card,
                                billing_details: {name: $('.card_holder_name').val()}
                            }
                        }
                    ).then(function (result) {
                        if (result.error) {
                            $('#card-errors').text(result.error.message)
                            $('button.pay').removeAttr('disabled')
                        } else {
                            paymentMethod = result.setupIntent.payment_method
                            $('.payment-method').val(paymentMethod)
                            $('.card-form').submit()
                        }
                    })
                    return false
                })
            </script>
</html>
