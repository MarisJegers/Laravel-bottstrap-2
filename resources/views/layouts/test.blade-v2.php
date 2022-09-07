{{-- layouts testa uzdevumiem ar W3.css --}}
<!DOCTYPE html>
<html lang="lv">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>@yield('title')</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Dosis">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""/>
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">-->
  
  <!--<script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>-->
  <script src="https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
  <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
          integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
          crossorigin="">
  </script>

</head>
<body style="background-color:darkslategrey; font-family: Dosis, sans-serif;">
  
  @section('navbar')
  <header>
      <div class="w3-bar w3-black">
        <a href="{{ url('/') }}" class="w3-bar-item w3-button w3-mobile">Sākums</a>
        <a href="{{ route('maps.index') }}" class="w3-bar-item w3-button w3-mobile">Karte</a>
        <a href="{{ route('maps.create') }}" class="w3-bar-item w3-button w3-mobile">Adreses</a>
        <a href="{{ route('tests.index') }}" class="w3-bar-item w3-button w3-mobile">Formas</a>
      </div>
  </header>
  @show
    
  <div class="main">
    @yield('content')
  </div>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  
</body>
</html>