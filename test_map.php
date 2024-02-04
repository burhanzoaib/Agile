<!DOCTYPE html>
<html>
  <head>
    <title>Google Maps API Test</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1Jejwru9o7rguJyDQcGl-mWUyBuNZst4&callback=initMap"
      async defer></script>
    <style>
      /* Set the size of the map */
      #map {
        height: 400px;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
      function initMap() {
        // Create a map centered at a specific location
        var map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: 40.7128, lng: -74.0060 }, // Change these coordinates
          zoom: 10, // Adjust the zoom level
        });
      }
    </script>
  </body>
</html>
