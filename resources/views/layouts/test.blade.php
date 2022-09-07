{{-- layouts testa uzdevumiem ar tailwind.css --}}
<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <!--<link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />-->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
  <script src="https://cdn.tailwindcss.com"></script>
  <!--<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>-->
  <script src="https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
          integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
          crossorigin="">
  </script>
  <style type="text/css">

/*css aktīvās, noklikšķinātās navigācijas saites stila mainīšanai*/
  .nav-link {
              color: yellow;
          }
   
          .nav-item>a:hover {
              color: green;
          }
   
          /*code to change background color
      Selects all a elements where the parent is active element
      un tos vēl select arī navbar-nav*/
          .navbar-nav>.active>a {
              background-color: white;
              color: red;
          }

          .active{
            background-color: yellow;
              color: red;
          }

  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script><!-- šis lai strādātu jquery kods aktīvās saites stila mainai-->
  <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script><!-- šis arī lai strādātu jquery kods aktīvās saites stila mainai-->
  <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script><!-- šis lai strādātu navigācijas lenta-->
  <script>
   $(document).ready(function () {
 
            $('ul.navbar-nav > li')
                    .click(function (e) {
                $('ul.navbar-nav > li')
                    .removeClass('active');
                $(this).addClass('active');
            });
        });
  
  </script>

</head>
<body style="background-color:darkslategrey; font-family: Dosis, sans-serif;">
  
  @section('navbar')
  <header>

      <!-- responsive nav Start -->
    
      <nav class="border-gray-200 px-2 sm:px-4 py-2.5 rounded dark:bg-gray-900">
          <div class="container flex flex-wrap justify-left items-center mx-auto">
            
            <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" id="menu-button"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
            </button>
            
            <div class="hidden w-full md:block md:w-auto" id="menu">
              <ul class="flex flex-col p-4 mt-4 bg-gray-50 rounded-lg border border-gray-100 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700 navbar-nav">
                {{--<li class="nav-item">
                  <a href="{{ url('/login') }}" class="nav-link show block py-2 pr-4 pl-3 bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white" aria-current="page">Pieteikties</a>
                </li>--}}
                <li class="nav-item {{ (request()->is('maps/index')) ? 'active' : '' }}">
                  <a href="{{ route('maps.index') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Karte</a>
                </li>
                <li class="nav-item {{ (request()->is('maps/create')) ? 'active' : '' }}">
                  <a href="{{ route('maps.create') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Adreses</a>
                </li>
                <li class="nav-item {{ (request()->is('tests/index')) ? 'active' : '' }}">
                  <a href="{{ route('tests.index') }}" class="nav-link show block py-2 pr-4 pl-3 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Forma</a>
                </li>
              </ul>

            </div>
            
    
            <div class="ml-auto inline-block align-middle">
              <div class="nav-item">
                  <a href="{{ url('/login') }}" class="nav-link show block bg-blue-100 rounded md:bg-transparent md:text-blue-100 md:p-0 dark:text-white">PIETEIKTIES</a>
                </div>
            </div>
          </div>
      </nav>
       <!-- responsive nav end -->
  </header>
  @show
    
  <div class="main">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>

  <!-- skripts hamburgerpogai -->
  <script type="text/javascript">
    
    const button = document.querySelector('#menu-button'); // Hamburger Icon
    const menu = document.querySelector('#menu'); // Menu

      button.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>
  
</body>
</html>