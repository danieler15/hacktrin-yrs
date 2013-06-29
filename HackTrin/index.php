<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-8"/>
  	<script>
  		/*var allPlaces = new Array();
  		function place(pl, nm, ad, ltLn, zp, pN, rt, wb, ph, sc){
  			this.place = pl;
  			this.name = nm;
  			this.address = ad;
  			this.latLong = ltLn;
  			this.coords = latLong.split(",");
  			this.lat = coords[0];
  			this.lng = coords[1];
  			this.zip = zp;
  			this.priceNum = pN;
  			this.rating = rt;
  			this.website = wb;
  			this.phone = ph;
  			this.score = sc;
  		}*/
  	</script>
  	<title>WiFi Enabled Resturaunts</title>
    <!--<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />-->
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&sensor=true">
    </script>
    <!--<script type="text/javascript">
	function initialize() {
    	var mapOptions = {
    		center: new google.maps.LatLng(-34.397, 150.644),
    		zoom: 7,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
    	};
    	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    
    	/*var pinColor = "FE7569";
    	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
    		new google.maps.Size(21, 34),
    		new google.maps.Point(0,0),
    		new google.maps.Point(10, 34));
    	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    		new google.maps.Size(40, 37),
    		new google.maps.Point(0, 0),
    		new google.maps.Point(12, 35));
    		*/
    	var pinColors = new Array();
    	for(var q = 0; q < allPlaces.length; q++){
    		pinColors.push(rgbToHex(allPlaces[q].red, allPlaces[q].green, allPlaces[q].blue));
    	}
    	
    	var pinImages = new Array();
    	var pinShadows = new Array();
    	for(var w = 0; w < allPlaces.length; w++){
    		pinImages.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColors[w],
    			new google.maps.Size(21, 34),
    			new google.maps.Point(0,0),
    			new google.maps.Point(10, 34)));
    		pinShadows.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    			new google.maps.Size(40, 37),
    			new google.maps.Point(0, 0),
    			new google.maps.Point(12, 35)));
    	}
    
    	var markers = new Array();
    	for(var i = 0; i < allPlaces.length; i++){
    		markers.push(new google.maps.Marker({
    			position: new google.maps.LatLng(allPlaces[i].lat, allPlaces[i].lng),
    			map: map,
    			title: allPlaces[i].name,
    			icon: pinImages[i],
    			shadow: pinShadows[i]
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
   </script>-->
  </head>
  <body>
  	<script>
  		var allPlaces = new Array();
  		function place(nm, ad, ltLn, zp, pN, rt, wb, ph, sc){
  			this.name = nm;
  			this.address = ad;
  			this.latLong = ltLn;
  			this.coords = this.latLong.split(",");
  			this.lat = this.coords[0];
  			this.lng = this.coords[1];
  			this.zip = zp;
  			this.priceNum = pN;
  			this.rating = rt;
  			this.website = wb;
  			this.phone = ph;
  			this.score = sc;
  			//alert("end Place"+this.name+" "+this.address+" "+this.latLong+" "+this.lat+" "+this.lng+" "+this.zip+" "+this.priceNum+" "+this.rating+" "+this.website+" "+this.phone+" "+this.score);
  		};
  	</script>
  <!--	<?php
  		mysql_connect("localhost", "root", "") or die(mysql_error());
  		mysql_select_db("YRS") or die(mysql_error());
  		
  		$query = mysql_query("SELECT * FROM WifiLocations") or die(mysql_error());
  		while ($row = mysql_fetch_array($query)) {
  			$name = $row['name'];
  			$address = $row['address'];
  			$latLong = $row['latLong'];
  			$zip = $row['zip'];
  			$priceNum = $row['priceNum'];
  			$rating = $row['rating'];
  			$website = $row['website'];
  			$phone = $row['phone'];
  			$score = $row['score'];
  			
  			echo "<script type='text/javascript'>";
  			echo "allPlaces.push(".$name.",".$address.",".$latLong",".$zip.",".$priceNum.",".$rating.",".$website.",".$phone.",".$score.");"
  			
  			echo "var place = new Object()";
  			echo "place.name = ".$name.";";
  			echo "place.address = ".$address.";";
  			echo "place.latLong = ".$latLong.";";
  			echo "place.zip = ".$zip.";";
  			echo "place.priceNum = ".$priceNum.";";
  			echo "place.rating = ".$rating.";";
  			echo "place.website = ".$website.";";
  			echo "place.phone = ".$phone.";";
  			echo "place.score = ".$score.";";
  			
  			echo "</script>";
  		}
  		
  		
  	?>-->
  	<script type="text/javascript">
  	alert("Start Main Script");
  	for(var g = 0; g < 10; g++){
  		//alert("In Loop");
  		//allPlaces.push(new place("Michael", "545 WEA", "30,145", "10024", "3", "29", "MEMEME.com", "777-777-7777", "10"));
  		allPlaces.push(new place("Michael", "545 WEA", (g+30)+","+(g+145), "10024", (g%5), "29", "MEMEME.com", "777-777-7777", g));
  	}
  	alert("Array Made");
	function initialize() {
    	var mapOptions = {
    		center: new google.maps.LatLng(-34.397, 150.644),
    		zoom: 7,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
    	};
    	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    
    	/*var pinColor = "FE7569";
    	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
    		new google.maps.Size(21, 34),
    		new google.maps.Point(0,0),
    		new google.maps.Point(10, 34));
    	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    		new google.maps.Size(40, 37),
    		new google.maps.Point(0, 0),
    		new google.maps.Point(12, 35));
    		*/
    	var pinColors = new Array();
    	for(var q = 0; q < allPlaces.length; q++){
    		pinColors.push(rgbToHex(allPlaces[q].red, allPlaces[q].green, allPlaces[q].blue));
    	}
    	
    	var pinImages = new Array();
    	var pinShadows = new Array();
    	for(var w = 0; w < allPlaces.length; w++){
    		pinImages.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColors[w],
    			new google.maps.Size(21, 34),
    			new google.maps.Point(0,0),
    			new google.maps.Point(10, 34)));
    		pinShadows.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    			new google.maps.Size(40, 37),
    			new google.maps.Point(0, 0),
    			new google.maps.Point(12, 35)));
    	}
    
    	var markers = new Array();
    	for(var i = 0; i < allPlaces.length; i++){
    		markers.push(new google.maps.Marker({
    			position: new google.maps.LatLng(allPlaces[i].lat, allPlaces[i].lng),
    			map: map,
    			title: allPlaces[i].name,
    			icon: pinImages[i],
    			shadow: pinShadows[i]
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
    </script>
    <div id="map-canvas" style="width:100%;height:1000px;"/>
  </body>
</html>
https://maps.googleapis.com/maps/api/js?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&sensor=true
maps.googleapis.com
<!DOCTYPE html>
<html>
  <head>
  	<meta charset="UTF-8"/>
  	<title>WiFi Enabled Resturaunts</title>
    <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&sensor=true">
    </script>
  </head>
  <body>
  	<script>
  		var allPlaces = new Array();
  		function place(nm, ad, ltLn, zp, pN, rt, wb, ph, sc){
  			this.name = nm;
  			this.address = ad;
  			this.latLong = ltLn;
  			this.coords = this.latLong.split(",");
  			this.lat = this.coords[0];
  			this.lng = this.coords[1];
  			this.zip = zp;
  			this.priceNum = pN;
  			this.rating = rt;
  			this.website = wb;
  			this.phone = ph;
  			this.score = sc;
  			//alert("end Place"+this.name+" "+this.address+" "+this.latLong+" "+this.lat+" "+this.lng+" "+this.zip+" "+this.priceNum+" "+this.rating+" "+this.website+" "+this.phone+" "+this.score);
  		};
  	</script>
  <!--	<?php
  		mysql_connect("localhost", "root", "") or die(mysql_error());
  		mysql_select_db("YRS") or die(mysql_error());
  		
  		$query = mysql_query("SELECT * FROM WifiLocations") or die(mysql_error());
  		while ($row = mysql_fetch_array($query)) {
  			$name = $row['name'];
  			$address = $row['address'];
  			$latLong = $row['latLong'];
  			$zip = $row['zip'];
  			$priceNum = $row['priceNum'];
  			$rating = $row['rating'];
  			$website = $row['website'];
  			$phone = $row['phone'];
  			$score = $row['score'];
  			
  			echo "<script type='text/javascript'>";
  			echo "allPlaces.push(".$name.",".$address.",".$latLong",".$zip.",".$priceNum.",".$rating.",".$website.",".$phone.",".$score.");"
  			
  			echo "var place = new Object()";
  			echo "place.name = ".$name.";";
  			echo "place.address = ".$address.";";
  			echo "place.latLong = ".$latLong.";";
  			echo "place.zip = ".$zip.";";
  			echo "place.priceNum = ".$priceNum.";";
  			echo "place.rating = ".$rating.";";
  			echo "place.website = ".$website.";";
  			echo "place.phone = ".$phone.";";
  			echo "place.score = ".$score.";";
  			
  			echo "</script>";
  		}
  		
  		
  	?>-->
  	<script type="text/javascript">
  	alert("Start Main Script");
  	for(var g = 0; g < 10; g++){
  		//alert("In Loop");
  		//allPlaces.push(new place("Michael", "545 WEA", "30,145", "10024", "3", "29", "MEMEME.com", "777-777-7777", "10"));
  		allPlaces.push(new place("Michael", "545 WEA", (g+30)+","+(g+145), "10024", (g%5), "29", "MEMEME.com", "777-777-7777", g));
  	}
  	alert("Array Made");
	function initialize() {
    	var mapOptions = {
    		center: new google.maps.LatLng(-34.397, 150.644),
    		zoom: 7,
    		mapTypeId: google.maps.MapTypeId.ROADMAP
    	};
    	var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
    
    	/*var pinColor = "FE7569";
    	var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColor,
    		new google.maps.Size(21, 34),
    		new google.maps.Point(0,0),
    		new google.maps.Point(10, 34));
    	var pinShadow = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    		new google.maps.Size(40, 37),
    		new google.maps.Point(0, 0),
    		new google.maps.Point(12, 35));
    		*/
    	var pinColors = new Array();
    	for(var q = 0; q < allPlaces.length; q++){
    		pinColors.push(rgbToHex(allPlaces[q].red, allPlaces[q].green, allPlaces[q].blue));
    	}
    	
    	var pinImages = new Array();
    	var pinShadows = new Array();
    	for(var w = 0; w < allPlaces.length; w++){
    		pinImages.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + pinColors[w],
    			new google.maps.Size(21, 34),
    			new google.maps.Point(0,0),
    			new google.maps.Point(10, 34)));
    		pinShadows.push(new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_shadow",
    			new google.maps.Size(40, 37),
    			new google.maps.Point(0, 0),
    			new google.maps.Point(12, 35)));
    	}
    
    	var markers = new Array();
    	for(var i = 0; i < allPlaces.length; i++){
    		markers.push(new google.maps.Marker({
    			position: new google.maps.LatLng(allPlaces[i].lat, allPlaces[i].lng),
    			map: map,
    			title: allPlaces[i].name,
    			icon: pinImages[i],
    			shadow: pinShadows[i]
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
    </script>
    <div id="map-canvas" style="width:100%;height:1000px;"/>
  </body>
</html>