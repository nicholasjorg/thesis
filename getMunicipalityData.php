<?php 
    $local = "";
    include 'limit.php';
	$jsonarray = array();
	//$region = "region";
	//$class = "classifications";
	//$displayDate = "displayDate";
	//$onView = "onView";
	$sql = 'select region, municipality, classifications, displayDate, onView, count(*) as antal from allData where region is not null AND municipality is not null group by region, municipality, classifications, displayDate, onView' . $local;

    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"], displayDate=>$row["displayDate"], onView=>$row["onView"], antal=>$row["antal"]);
    	array_push($jsonarray, $tmp);
    }
    $dataset = json_encode($jsonarray);
?>