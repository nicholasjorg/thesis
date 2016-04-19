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

function testDbconnect(){
    $dblink = mysqli_connect("localhost","root","root","SLKSCopy") or die ("Connection failed: " . mysqli_connect_error());
    mysqli_set_charset($dblink, "utf8");
    return $dblink;
}

function queryTestDB($query){
    $result = mysqli_query(testDbconnect(), $query) or die( "Forespørgslen kunne ikke udføres: " . mysqli_error($dblink));
    mysqli_close(testDbconnect());
    return $result;
}

function getDisplayDateYears(){
    $sql = 'select distinct displayDate From allData where displayDate is not null order by displayDate asc';
    $result = queryDB($sql);
    return $result;
}

?>