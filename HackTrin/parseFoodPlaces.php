<?php
$name="chipotle";

$zipcode;
$location;
$status;
$url="https://maps.googleapis.com/maps/api/place/textsearch/json?key=AIzaSyDxQyIwXug-O2Ha9hVRWIL3kuSdOY7PPD4&query="."$name"."+new+york&sensor=true&types=restaurant";
    $json = file_get_contents($url);
    echo $json;
    $data = json_decode($json, TRUE);
    $status=$data["status"];
    echo $status;
    /*if($status=="OK"){
    	getInfo($data)
    }
    function getInfo($data){
    	echo $json;
    }*/
    
//	echo $data;
//	var_dump($data);
?>

