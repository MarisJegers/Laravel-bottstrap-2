<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Produkti</title>

        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="antialiased bg-blue-100">

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
                @if (Auth::check())
                    <span class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out">{{ auth()->user()->name }}<span>

                @else
                    <span class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-gray-700 focus:text-gray-700 transition duration-150 ease-in-out"> Viesis <span>
                @endif
                
              </li>
              <li class="nav-item">
                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('products') }}">Produkti</a>
              </li>
              <li class="nav-item mb-2 lg:mb-0">
                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('cart') }}">Grozs</a>
              </li>
              <li class="nav-item">
                <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out" href="{{ route('login') }}">Pieteikties</a>
              </li>
              
              <li>
                @if (Route::has('register'))
                    <a class="nav-link block pr-2 lg:px-2 py-2 text-gray-600 hover:text-blue-700 focus:text-gray-700 transition duration-150 ease-in-out"  data-mdb-ripple="true" data-mdb-ripple-color="light" href="{{ route('register') }}">Reģistrēties</a>
                @endif
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
      <!--end navigācija-->
@include('flash-messages')
           <!--<div class="grid h-screen place-items-center">-->
    <h1 class="font-medium leading-tight text-4xl text-center mt-2 mb-2 text-blue-600">Improvizēta produktu liste</h1>
    <p class="text-center mt-2 mb-2 text-blue-600">Doma šāda: ir produktu saraksts, kurš pieejams gan autorizētiem, gan neautorizētiem lietotājiem. Lai nopirktu preci, tā jāpievieno pirkuma grozam. Pievienošanu var veikt vienīgi autorizētie lietotāji. OK, pēc autorizēšanās un preces pievienošanas grozam, sāspiž uz navigācijas lentas saites "Grozs", tas atvērs /cart skatu, kurā iekļauts Laravel Cashier un stripe.com. <br>Pēc autorizēšanās neērti ir tas, ka tiek atvērts /home skats, nevis tas pats produktu skats. </p>
    <div class="p-10 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
        @foreach($products as $product)
        <div class="border p-6 block rounded-lg shadow-lg bg-white max-w-sm mb-4">
            <form action="{{ route('products.add') }}" method="POST" style="border: 1px solid black; padding: 10px; margin-bottom: 15px;">
                @csrf
                <h5 class="text-gray-900 text-xl leading-tight font-medium mb-2 p-2">{{ $product->name }}</h5>
                <p class="text-gray-700 text-base mb-4">{{ $product->description }}</p>
                <p class="text-gray-700 text-base mb-4">{{ "EUR ".number_format($product->price/100, 2) }}</p>
                <input type="hidden" name="id" value="{{ $product->id }}">
                @auth
                    <button type="submit" class="inline-block px-3 py-2.5 bg-gray-800 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-900 hover:shadow-lg focus:bg-gray-900 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-900 active:shadow-lg transition duration-150 ease-in-out">Pievienot grozam</button>

                @else
                    <small>Lai preci pievienotu grozam, <a href="{{ route('login') }}" class="text-blue-900 hover:uppercase">autorizējies</a></small>
                @endauth


            </form>
        </div>
        @endforeach
    </div>
</div>
 


    </body>
</html>
