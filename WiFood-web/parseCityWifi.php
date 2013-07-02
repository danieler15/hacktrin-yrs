<?php

$run = shouldRun();



if ($run == false) {
	die("Already ran config");
}

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("YRS") or die(mysql_error());

$jsonObject = json_decode(file_get_contents("wifidata.json"), true);
$data = $jsonObject['data'];


$i = 0;
foreach ($data as $place) {
	
	$i++;
	if ($i > 1300) {
		break;
	}
	
	$name = mysql_real_escape_string($place[9]);
	if (!isValidName($name)) {
		continue;
	}
	
	$address = mysql_real_escape_string($place[10]);
	$zip = mysql_real_escape_string($place[15]);


	$latLong = getLatLong($address);
	
	
	if (isValidName($name)) {
		echo $name."<br />";
		mysql_query("INSERT INTO WifiLocations(name, address, latLong, zip) VALUES('$name', '$address', '$latLong', '$zip')");
	}
	
}


function coordsFromAddress() {
	return "10,10";
}

function isValidName($name) {
	$invalid = array("Fedex Kinko\'s", "Columbia University", "My Little Wi-Fi", "Public Telephone", "The UPS Store", "T-Mobile", "Barnes & Noble", "Borders", "TechSpace");
	if (in_array($name, $invalid)) {
		return false;
	}
	if (strpos($name, "Library") !== FALSE) {
		return false;
	}
	if (strpos($name, "Airport") !== FALSE) {
		return false;
	}
	if (strpos($name, "Court") !== FALSE) {
		return false;
	}
	if (strpos($name, "Community Access") !== FALSE) {
		return false;
	}
	if (strpos($name, "Park") !== FALSE) {
		return false;
	}
	if (strpos($name, "Avis") !== FALSE) {
		return false;
	}
	if (strpos($name, "Equinox") !== FALSE) {
		return false;
	}
	if (strpos($name, "Communication") !== FALSE) {
		return false;
	}
	return true;
}

function shouldRun() {
	$file = "wifiConditions.txt";
	$unset = "UNSET\n";
	$set = "SET";
	
	if (file_exists($file) && file_get_contents($file) == $unset) {
		file_put_contents($file, $set);
		return true;
	}
	return false;
}

function getLatLong($address) {

	
	$BASE_URL = "http://maps.googleapis.com/maps/api/geocode/json?address=";
	$add = str_replace(" ", "+", $address);
	$url = $BASE_URL.$add."+New+York,+NY&sensor=false";
	
	$json = json_decode(file_get_contents($url), true);
	$results = $json['results'][0];
	$location = $results['geometry']['location'];
		
	$latLong = $location['lat'].",".$location['lng'];
	
	return $latLong;
	
}




