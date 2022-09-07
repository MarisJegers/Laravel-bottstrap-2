{{-- maps.index skats v.2 ar centralizētu testa layoutu un w3.css--}}

@extends('layouts.test')

@section('title', 'Karte')

@push('styles')
    <!--<link rel="stylesheet" href="/assets/css/style.css"/>-->
    <!--kad te bija css kods, karte nerādās-->
    
@endpush

@section('navbar')
    @parent <!-- Includes parent sidebar -->

@stop

@section('content')
 <style type="text/css">
      /* css code */
      #map {
                width: 100%;
                height: 400px;
                
            }
           

    </style>
    <div class="center" id="map"></div>
    <script type="text/javascript">  
     // .. custom js code
     var mapboxTiles = L.tileLayer('http://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png', {
                attribution: '<a target="_blank" href="http://www.mapbox.com/about/maps/" target="_blank">@ Mapbox</a>'
            });

            var map = L.map('map')
                    .addLayer(mapboxTiles)
                    .setView([58.27, 22.51], 5);

            $.each({!! $locations !!}, function (key, val) {
                
                popup = L.popup({
                    closeOnClick: true,
                    autoClose: true
                }).setContent(val.location);

                L.marker([val.latitude, val.longitude]).addTo(map).bindPopup(popup);
                
            });

            //navigācijas lentas funkcija
            function myNav() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                x.className += " responsive";
              } else {
                x.className = "topnav";
              }
            }
    </script>
    
@stop

@push('scripts')
    {{--<script src="/assets/js/script.js"></script>--}}
    <script type="text/javascript">  
     // .. custom js code
     var mapboxTiles = L.tileLayer('http://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png', {
                attribution: '<a target="_blank" href="http://www.mapbox.com/about/maps/" target="_blank">@ Mapbox</a>'
            });

            var map = L.map('map')
                    .addLayer(mapboxTiles)
                    .setView([58.27, 22.51], 5);

            $.each({!! $locations !!}, function (key, val) {
                
                popup = L.popup({
                    closeOnClick: true,
                    autoClose: true
                }).setContent(val.location);

                L.marker([val.latitude, val.longitude]).addTo(map).bindPopup(popup);
                
            });

            //navigācijas lentas funkcija
            function myNav() {
              var x = document.getElementById("myTopnav");
              if (x.className === "topnav") {
                x.className += " responsive";
              } else {
                x.className = "topnav";
              }
            }
    </script>
@endpush

