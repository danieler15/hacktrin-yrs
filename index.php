<!DOCTYPE html>
<html>
  <head>
  	<script>
  		var allPlaces = new Array();
  	</script>
  	<title>WiFi Enabled Resturaunts</title>
    <!--<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />-->
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&sensor=true">
    </script>
    <script type="text/javascript">
	function initialize() {
    	var mapOptions = {
    		center: new google.maps.LatLng(-34.397, 150.644),
    		zoom: 7,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
    	};
    	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    
    	var pinColor = "FE7569";
    	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
    		new google.maps.Size(21, 34),
    		new google.maps.Point(0,0),
    		new google.maps.Point(10, 34));
    	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    		new google.maps.Size(40, 37),
    		new google.maps.Point(0, 0),
    		new google.maps.Point(12, 35));
    
    	var markers = new Array();
    	var pinImages = new Array();
    	var pinShadows = new Array();
    	for(var i = 0; i < hotResturaunts.length; i++){
    		markers.push(new google.maps.Marker({
    			position: new google.maps.LatLng(hotResturaunts[i].lat, hotResturaunts.lng),
    			map: map,
    			title: hotResturaunts.name,
    			icon: pinImage,
    			shadow: pinShadow
    			}))
    	}
    }
    google.maps.event.addDomListener(window, 'load', initialize);
    function rgbToHex(R,G,B) {return toHex(R)+toHex(G)+toHex(B)}
    function toHex(n) {
    	n = parseInt(n,10);
    	if (isNaN(n)) return "00";
    	n = Math.max(0,Math.min(n,255));
    	return "0123456789ABCDEF".charAt((n-n%16)/16)
    		+ "0123456789ABCDEF".charAt(n%16);
    }
   /*function getHex(r, g, b){
      	var rHex = Math.floor(r/16)+r%16
      }*/
    </script>
  </head>
  <body>
  	<!--<?php
  		mysql_connect("localhost", "root", "") or die(mysql_error());
  		mysql_select_db("YRS") or die(mysql_error());
  		
  		$query = mysql_query("SELECT * FROM WifiLocations");
  		
  	?>-->
    <div id="map-canvas" style="width:100%;height:1000px;"/>
  </body>
</html>