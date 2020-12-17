<!DOCTYPE html>
<html>
  <head>
    <title>Reverse Geocoding</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD-2mhVoLX7oIOgRQ-6bxlJt4TF5k0xhWc&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }

      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: "Roboto", "sans-serif";
        line-height: 30px;
        padding-left: 10px;
      }

      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }

      #latlng {
        width: 225px;
      }
    </style>

<script src="{{asset('assets/libs/jquery-1.12.4.js')}}"></script>
    <script>

        function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(initMap);
        } else {
            console.log( "Geolocation is not supported by this browser.");
        }
        }

        function showPosition(position) {
        console.log( "Latitude: " + position.coords.latitude );
        console.log( "longitude: " + position.coords.longitude );
            var user_lat = position.coords.latitude;
            var user_long = position.coords.longitude;

        }
      function initMap(position) {
        // console.log( "Latitude: " + position.coords.latitude );
        // console.log( "longitude: " + position.coords.longitude );


        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 8,
          center: { lat: 40.731, lng: -73.997 },
        });
        const geocoder = new google.maps.Geocoder();
        const infowindow = new google.maps.InfoWindow();
        document.getElementById("submit").addEventListener("click", () => {
          geocodeLatLng(geocoder, map, infowindow);
        });
      }

      function geocodeLatLng(geocoder, map, infowindow) {
        const input = document.getElementById("latlng").value;
        const latlngStr = input.split(",", 2);
        const latlng = {

          lat: parseFloat(latlngStr[0]),
          lng: parseFloat(latlngStr[1]),
        };
        geocoder.geocode({ location: latlng }, (results, status) => {
          if (status === "OK") {
            if (results[0]) {
              map.setZoom(11);
              const marker = new google.maps.Marker({
                position: latlng,
                map: map,
              });
              console.log(results[1]);
              infowindow.setContent(results[0].political);
              infowindow.open(map, marker);
            } else {
              window.alert("No results found");
            }
          } else {
            window.alert("Geocoder failed due to: " + status);
          }
        });
      }
    </script>
  </head>
  <body onload="getLocation()">
    <div id="floating-panel">

        <button onclick="getLocation()">Try It</button>
      <input id="latlng" type="text" value="40.714224,-73.961452" />
      {{-- <input id="lat" type="text" value="" />
      <input id="lng" type="text" value="" /> --}}
      <input id="submit" type="button" value="Reverse Geocode" />
    </div>
    <div id="map"></div>
  </body>
</html>
