<?php

header('Content-Type: application/json');
mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("YRS") or die(mysql_error());


$zip = $_GET['q'];
$query = "SELECT * FROM WifiLocations WHERE hasData=1"; 

if ($zip != "") {
	$query = $query." WHERE zip='$zip'";
}

$result = mysql_query($query) or die(mysql_error());

$arr = array();

$i = 0;
while ($row = mysql_fetch_array($result)) {
	$arr[$i] = $row;
	$i++;
}
$data = array("data" => $arr);

/*
echo "[";

$first = true;
while($row = mysql_fetch_array($result)){
	if (!$first) {
		echo ",";
	}
	
	echo"{";
	echo "name:".$row['name'].",";
	echo "address".$row['address'].",";
	echo "latLong".$row['latLong'].",";
	echo "zip".$row['zip'].",";
	echo "priceNum".$row['priceNum'].",";
	echo "rating".$row['rating'].",";
	echo "phone".$row['phone'].",";
	echo "website".$row['website'];
	echo "}";
	$first = false;


}	
echo "]";
echo "<br />";*/

echo json_encode($data);

?>