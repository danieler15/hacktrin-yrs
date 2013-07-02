<?php
$run = shouldRun();

if ($run == false) {
	//die("Already ran config");
}



$API_KEY = "AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4";
$BASE_URL = "https://maps.googleapis.com/maps/api/place/nearbysearch/json?";

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("YRS") or die(mysql_error());

$query = mysql_query("SELECT * FROM WifiLocations LIMIT 800,100") or die(mysql_error());

$i = -1;
while ($place = mysql_fetch_array($query)) {
	$i++;
	
	if ($place['hasData'] == true) {
		continue;
	}
	
	$name = $place['name'];
	$zip = $place['zip'];
	$address = $place['address'];
	
	$latLng = $place['latLong'];

	$id = $place['id'];
	
	if ($i > 60) {
		$BASE_URL ="akldf";
		break;
	}
	//echo $name." ".$zip." ".$address." ".$id."<br /><br />";
	echo $name."<br />";
	
	$searchURL = $BASE_URL."location=".$latLng."&sensor=false&radius=50&types=food&key=".$API_KEY;
	//echo $searchURL;
	$res = file_get_contents($searchURL);
	//echo $res."<br /><br />";
	$json = json_decode($res, true);

	//echo json_encode($json);
	//var_dump($json);
	
	$status = $json['status'];
	echo $status."<br />";
	if ($status == "OK") {
		$newData = getLocationData($place, $json);
		
		if ($newData == nil) {
			continue;
		}
		
		$rating = $newData['rating'];
		$priceNum = $newData['priceNum'];
		$score = strval(5 - intval($priceNum) + intval($rating));
		
		$q = "UPDATE WifiLocations SET rating='$rating', priceNum='$priceNum', score='$score', hasData=1 WHERE id=$id";
		mysql_query($q) or die(mysql_error());
		
	}
	else {
		//Delete
		//mysql_query("DELETE FROM WifiLocations WHERE zip='$zip' AND name='$name' AND address='$address'") or die(mysql_error());
	}
	
}

function getLocationData($place, $json) {
	$results = $json['results'];
	
	if (count($results) == 0) {
		return nil;
	}	
	foreach ($results as $res) {
		$name = $res['name'];
		$fullAdd = $res['formattedAddress'];
		$streetAdd = explode(",", $fullAdd);
		
		if ($name == $place['name'] || $streetAdd == $place['address']) {
			
			$location = $res['geometry']['location'];
			$rating = $res['rating'];
			$priceNum = $res['price_level'];
			
			$newData = array("rating" => $rating, "priceNum" => $priceNum);
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

