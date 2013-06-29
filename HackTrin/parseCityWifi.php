<?php

$run = shouldRun();

if ($run == false) {
	die("Already ran config");
}

mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("YRS") or die(mysql_error());

$jsonObject = json_decode(file_get_contents("wifidata.json"), true);
$data = $jsonObject['data'];

foreach ($data as $place) {
	$name = mysql_real_escape_string($place[9]);
	if (!isValidName($name)) {
		continue;
	}
	
	$address = mysql_real_escape_string($place[10]);
	$zip = mysql_real_escape_string($place[15]);
	
	
	$latLong = coordsFromAddress($address);
	echo $name.": ".$address." ".$zip." ".$latLong."<br />";
	
	if (isValidName($name)) {
		mysql_query("INSERT INTO WifiLocations(name, address, latLong, zip) VALUES('$name', '$address', '$latLong', '$zip')") or die(mysql_error());
	}
	
}


function coordsFromAddress() {
	return "10,10";
}

function isValidName($name) {
	$invalid = array("Fedex Kinko\'s", "Public Telephone", "T-Mobile", "Barnes & Noble", "Borders", "TechSpace");
	if (in_array($name, $invalid)) {
		return false;
	}
	if (strpos($name, "Library") !== FALSE) {
		return false;
	}
	if (strpos($name, "Airport") !== FALSE) {
		return false;
	}
	return true;
}

function shouldRun() {
	$file = "conditionsCheck.txt";
	$unset = "UNSET\n";
	$set = "SET";
	
	if (file_exists($file) && file_get_contents($file) == $unset) {
		file_put_contents($file, $set);
		return true;
	}
	return false;
}



