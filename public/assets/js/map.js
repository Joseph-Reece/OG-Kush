/**
 * Google map
 */
(function ($) {
    "use strict";


    let place_lat = parseFloat($('#place_lat').val()) ||  40.7127753;
    let place_lng = parseFloat($('#place_lng').val()) || -74.0059728;






    let map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: place_lat, lng: place_lng},
        zoom: 16,
        mapTypeId: 'roadmap',
        mapTypeControl: false,
        fullscreenControl: true,
        streetViewControl: false,
        disableDefaultUI: false,
    });

    // Create marker by lat,lng
    let latLng = new google.maps.LatLng(place_lat, place_lng);
    new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: true
    });

    // Create the search box and link it to the UI element.
    let input = document.getElementById('pac-input');
    let searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function () {
        searchBox.setBounds(map.getBounds());
    });

    let markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function () {
        let places = searchBox.getPlaces();

        if (places.length === 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function (marker) {
            marker.setMap(null);
        });
        markers = [];


//   var latlon = position.coords.latitude + "," + position.coords.longitude;

        // For each place, get the icon, name and location.
        let bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                title: place.name,
                position: place.geometry.location
            }));

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            $('#place_address').val(place.formatted_address);
            $('#place_lat').val(place.geometry.location.lat());
            $('#place_lng').val(place.geometry.location.lng());

        });
        map.fitBounds(bounds);
    });


    })(jQuery);
