<?php

$run = shouldRun();

if ($run == false) {
	die("Already ran config");
}



$API_KEY = "AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4";
$BASE_URL = "https://maps.googleapis.com/maps/api/place/textsearch/json?";

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("YRS") or die(mysql_error());

$query = mysql_query("SELECT * FROM WifiLocations") or die(mysql_error());
$rows = mysql_fetch_array($query) or die(mysql_error());

foreach ($rows as $place) {
	$name = $place['name'];
	$zip = $place['zip'];
	$address = $place['address'];
	$id = $place['id'];
	
	$searchURL = $BASE_URL."key=".$API_KEY."&query=".str_replace(' ', '+', $name)."+".$zip."+new+york&sensor=false&types=restaurant";
	//$res = file_get_contents($searchURL);
	$json = json_decode($res, true);
	
	$status = $json['status'];
	if ($status == "OK") {
		$newData = getLocationData($place, $json);
		
		$latLong = $newData['location'];
		$rating = $newData['rating'];
		$priceNum = $newData['priceNum'];
		$score = strval(5 - intval($priceNum) + intval($rating));
		mysql_query("UPDATE WifiLocations SET latLong='$latLong' rating='$rating' priceNum='$priceNum' score='$score' WHERE id=$id") or die(mysql_error());
		
	}
	else {
		//Delete
		mysql_query("DELETE FROM WifiLocations WHERE zip='$zip' AND name='$name' AND address='$address'") or die(mysql_error());
	}
	
}

function getLocationData($place, $json) {
	$results = $json['results'];
	
	foreach ($results as $res) {
		$name = $res['name'];
		$fullAdd = $res['formattedAddress'];
		$streetAdd = explode(",", $fullAdd);
		
		if ($name == $place['name'] && $streetAdd == $place['address']) {
			
			$location = $res['geometry']['location'];
			$latLong = $location['lat'].','.$location['lng'];
			$rating = $res['rating'];
			$priceNum = $res['price'];
			
			$newData = array("location" => $location, "rating" => $rating, "priceNum" => $priceNum);
			return $newData;
		}
	
		
	}
	return false;
	
}

function shouldRun() {
	$file = "foodConditions.txt";
	$unset = "UNSET\n";
	$set = "SET";
	
	if (file_exists($file) && file_get_contents($file) == $unset) {
		file_put_contents($file, $set);
		return true;
	}
	return false;
}

