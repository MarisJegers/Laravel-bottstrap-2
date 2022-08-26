<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Kartes piemērs</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
   integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
   crossorigin=""/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
        
        <script src="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
        <script src="https://api.tiles.mapbox.com/mapbox.js/v1.6.4/mapbox.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.js"></script>
        <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
   integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
   crossorigin=""></script>
        <style type="text/css">
            #map {
                width: 900px;
                height: 600px;
                border-style: solid;
            }
            .center {
                margin: auto;
                width: 60%;
                border: 5px solid #FFFF00;
                margin-top: 20px;
            }

            .topnav {
              overflow: hidden;
              background-color: #333;
            }

            .topnav a {
              float: left;
              display: block;
              color: #f2f2f2;
              text-align: center;
              padding: 14px 16px;
              text-decoration: none;
              font-size: 17px;
            }

            .topnav a:hover {
              background-color: #ddd;
              color: black;
            }

            .topnav a.active {
              background-color: darkblue;
              color: white;
            }

            .topnav .icon {
              display: none;
            }

            @media screen and (max-width: 600px) {
              .topnav a:not(:first-child) {display: none;}
              .topnav a.icon {
                float: right;
                display: block;
              }
            }

            @media screen and (max-width: 600px) {
              .topnav.responsive {position: relative;}
              .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
              }
              .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
              }
            }


        </style>
    </head>

    <body style="background-color:darkslategrey;">
        
        <div class="topnav" id="myTopnav">
          <a href="{{url('/') }}" class="active">Sākums</a>
          <a href="{{ route('maps.index') }}">Karte</a>
          <a href="{{ route('maps.create') }}">Adreses</a>
          <a href="{{ route('tests.index') }}">Forma</a>
          <a href="javascript:void(0);" class="icon" onclick="myNav()">
            <i class="fa fa-bars"></i>
          </a>
        </div>

        <div class="center" id="map"></div>
        {{--@include('maps.create')--}}

        <script type="text/javascript">
            
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
    </body>
</html>