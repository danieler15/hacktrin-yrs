<?php

$url="https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&query=restaurants+near+10022&sensor=true";

    $json = file_get_contents($url);
    $data = json_decode($json, TRUE);
	var_dump($data);
?>

