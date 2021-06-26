
      var map;
      // Create a new blank array for all the listing markers.
      // (if we use multiple)

      var markers = [];

      // Make these global so we can access them when we load the map modal.
      var directionsDisplay;
      var directionsService;

      // Call the init map function.
      function initMap() {
        // LOAD DIRECTIONS API SERVICE
        directionsDisplay = new google.maps.DirectionsRenderer;
        directionsService = new google.maps.DirectionsService;
        // Constructor creates a new map - only center and zoom are required.
        map = new google.maps.Map(document.getElementById('map'), {
          // DUBLINS LAT LNG AS DEFAULT
          center: {lat: 53.3498, lng: 6.2603},
          zoom: 12,
        });
        directionsDisplay.setMap(map);
      }
      // END OF INIT MAP.

      function loadDirections(currentLocation, moduleLocation) {
        console.log(currentLocation);
        console.log(moduleLocation);
        calculateAndDisplayRoute(directionsService, directionsDisplay);
        document.getElementById('mode').addEventListener('change', function() {
          calculateAndDisplayRoute(directionsService, directionsDisplay);
        });

      function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var selectedMode = document.getElementById('mode').value;
        directionsService.route({
          // FILL IN MODULES LOCATION VS YOUR CURRENT LOCATION.
          origin: currentLocation,
          destination: moduleLocation,

          travelMode: google.maps.TravelMode[selectedMode]
        }, function(response, status) {
          if (status == 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }

    }


      // This function will loop through the listings and hide them all.
      function hideMarkers(markers) {
        for (var i = 0; i < markers.length; i++) {
          markers[i].setMap(null);
        }
      }

      // This function takes in a COLOR, and then creates a new marker
      // icon of that color. The icon will be 21 px wide by 34 high, have an origin
      // of 0, 0 and be anchored at 10, 34).
      function makeMarkerIcon(markerColor) {
        var markerImage = new google.maps.MarkerImage(
          'http://chart.googleapis.com/chart?chst=d_map_spin&chld=1.15|0|'+ markerColor +
          '|40|_|%E2%80%A2',
          new google.maps.Size(21, 34),
          new google.maps.Point(0, 0),
          new google.maps.Point(10, 34),
          new google.maps.Size(21,34));
        return markerImage;
      }

      function createModuleMarker(module) {
        // Make sure only one marker is showing at anytime.
        hideMarkers(markers);
        markers = [];
        // Create a new bounds for the maps
        var bounds = new google.maps.LatLngBounds();
        var position = {
          lat: Number(module.lat),
          lng: Number(module.long)
        };

        var marker = new google.maps.Marker({
          position: position,
          map: map
        });
        // Sets the location of the map to the current marker.
        map.setZoom(18);
        map.panTo(position);

        // Push it to an array so we can hide it later on.
        markers.push(marker);
      }



