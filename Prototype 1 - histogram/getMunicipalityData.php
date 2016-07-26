<?php
include 'limit.php';
?>
<?php 
    $jsonarray = array();
    $sql = 'SELECT municipality, region FROM allData where municipality is not null and region is not null group by region, municipality';
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $tmp = array(municipality=>$row["municipality"], region=>$row["region"]);
        array_push($jsonarray, $tmp);
    }
    $regionMunicipality = json_encode($jsonarray);
?>

<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="Hovedstaden"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"]);

    	array_push($jsonarray, $tmp);
    }
    $hovedstaden = json_encode($jsonarray);
?>

<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="midtjylland"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], primaryMaker=>$row["primaryMaker"]);

    	array_push($jsonarray, $tmp);
    }
    $midtjylland = json_encode($jsonarray);
?>
<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="nordjylland"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], primaryMaker=>$row["primaryMaker"]);

    	array_push($jsonarray, $tmp);
    }
    $nordjylland = json_encode($jsonarray);
?>
<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="sjælland"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], primaryMaker=>$row["primaryMaker"]);

    	array_push($jsonarray, $tmp);
    }
    $sjælland = json_encode($jsonarray);
?>
<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="syddanmark"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], primaryMaker=>$row["primaryMaker"]);

    	array_push($jsonarray, $tmp);
    }
    $syddanmark = json_encode($jsonarray);
?>
<?php
	$jsonarray = array();
	$sql = 'SELECT * from allData WHERE region="udenfordanmark"'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], primaryMaker=>$row["primaryMaker"]);

    	array_push($jsonarray, $tmp);
    }
    $udenfordanmark = json_encode($jsonarray);
?>
<?php

    $jsonarray = array();
    $sql = 'SELECT region, municipality from allData WHERE region is not null AND municipality is not null GROUP by region, municipality'. $local;
    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
        $tmp = array(region=>$row["region"], municipality=>$row["municipality"]);

        array_push($jsonarray, $tmp);
    }
    $municipalities = json_encode($jsonarray);

?>