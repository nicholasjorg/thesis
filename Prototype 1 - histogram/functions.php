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
    $sql = 'select distinct displayDate From allData where displayDate is not null order by displayDate desc';
    $result = queryDB($sql);
    return $result;
}

function getRegions(){
    $sql = 'select distinct region From allData where region is not null AND region NOT like "%needschanging%"';
    $result = queryDB($sql);
    return $result;
}

function getRegClassDisplayOnView(){
    $sql = 'select region, classifications, displayDate, onView from allData WHERE region is not null AND region not like "%needschanging%"';
    $result = queryDB($sql);
    return $result;
}

function getClassifications(){
    $sql = 'select distinct classifications from allData WHERE classifications is not null';
    $result = queryDB($sql);
    return $result;
}

function getMunicipalities(){
    $sql = 'select distinct municipality from allData where municipality is not null';
    $result = queryDB($sql);
    return $result;
}



?>