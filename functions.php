<?php
function dbconnect(){
	$dblink = mysqli_connect("localhost","root","root","SLKSdata") or die ("Connection failed: " . mysqli_connect_error());
	mysqli_set_charset($dblink, "utf8");
    return $dblink;
}

function queryDB($query){
	$result = mysqli_query(dbconnect(), $query) or die( "Forespørgslen kunne ikke udføres: " . mysqli_error($dblink));
	mysqli_close(dbconnect());
	return $result;
}
?>