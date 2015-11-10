<?php 
include "mykey.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <style type="text/css">
      body { background-color: white;}
      #map { width: 1400px; height: 500px; margin-top: 100px; margin-left: 350px; padding: 0;  border:2px inset;}	
	  h1{ font-size: 50px; text-align: center; border:2px outset; color:  green; background-color: #B2D0FE; margin-top: 1px;}
	  .imag:hover {transform: scale(1.2);  -moz-transition: all 0.4s ease-in-out 0s;  -webkit-transition: all 0.4s ease-in-out 0s;  -o-transition: all 0.4s ease-in-out 0s;  -ms-transition: all 0.4s ease-in-out 0s;  transition: all 0.4s ease-in-out 0s;}
    </style>
  </head>
  <body>
     <h1>Where Is It From?</h1> <br>
	 <center><p>Choisissez un élement et trouver son pays d'origine : </p><img class = "imag" id="Img" src="images/google.jpg"  align="center" width=100px height=100px/></center>
	
    <div id="map"></div>
    <script type="text/javascript">
var map;
var markers = [];
var point;
function initMap() {
  var haightAshbury = {lat: 37.775091, lng: -122.418922};

  map = new google.maps.Map(document.getElementById('map'), {
    zoom: 3,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.TERRAIN
  });
	point = new google.maps.LatLng({lat: 39.002673,lng:-122.596810});
  // This event listener will call addMarker() when the map is clicked.
  map.addListener('click', function(event) {
	  deleteMarkers();
    addMarker(event.latLng);
  });
	var triangleCoords = [
    {lat: 39.002673, lng: -122.596810},
    {lat: 37.427623, lng: -123.168233},
    {lat: 37.870482, lng: -121.575689}
  ];

  var bermudaTriangle = new google.maps.Polygon({paths: triangleCoords});

  google.maps.event.addListener(map, 'click', function(e) {
    var resultColor =
        google.maps.geometry.poly.containsLocation(e.latLng, bermudaTriangle) ?
        'green' :
        'red';

    new google.maps.Marker({
      position: e.latLng,
      map: map,
      icon: {
        path: google.maps.SymbolPath.CIRCLE,
        fillColor: resultColor,
        fillOpacity: .3,
        strokeColor: 'white',
        strokeWeight: .10,
        scale: 15
      }
    });
  });
  
}

// Adds a marker to the map and push to the array.
function addMarker(location) {
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
  markers.push(marker);
  
}

// Sets the map on all markers in the array.
function setMapOnAll(map) {
  for (var i = 0; i < markers.length; i++) {
    markers[i].setMap(map);
	distance = google.maps.geometry.spherical.computeDistanceBetween( point, markers[i].getPosition());
	dist = parseInt(distance/1000);
	alert(dist);
  }
  
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
  setMapOnAll(null);
}

// Shows any markers currently in the array.
function showMarkers() {
  setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
  clearMarkers();
  markers = [];
}
    </script>
    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=<?php echo $apiGMap;?>&callback=initMap">
    </script>
  </body>
</html>