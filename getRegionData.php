<<<<<<< HEAD
	<?php
	//Henter data omkring regioner / antal værker
	$jsonarray = array();
	//Bygger SQL statement
	$var1 = "region";
	$var2 = "count(*)";
	$sql = 'SELECT '.$var1.', '.$var2.' FROM allData group by region';
	$result = queryDB($sql);

	while ($row = mysqli_fetch_array($result)) {
		//Indsæt de forskellige variable, ændre count(*), da det ellers fucker op i JS
		$tmparr = array($var1=>$row[$var1], antal=>$row[$var2]);
		array_push($jsonarray,$tmparr);
	}
	$jsonobj = json_encode($jsonarray);

	//Henter data omkring regioner / antal værker fordelt over enkelte år.
	$jsonarray = array();
	//Bygger SQL statement
	$var1 = "region";
	$var2 = "displayDate";
	$var3 = "count(*)";
	$sql = 'SELECT '.$var1.', '.$var2.', '.$var3.' FROM allData WHERE '.$var1.' is not null AND '.$var2.' is not null GROUP BY '.$var1.', '.$var2;
	$result = queryDB($sql);
	while ($row = mysqli_fetch_array($result)) {
	//Indsæt de forskellige variable, ændre count(*), da det ellers fucker op i JS
		$tmparr = array($var1=>$row[$var1], $var2=>$row[$var2], antal=>$row[$var3]);
		array_push($jsonarray,$tmparr);
	}
	$regionSingleYear = json_encode($jsonarray);

	$jsonarray = array();
	$region = "region";
	$class = "classifications";
	$displayDate = "displayDate";
	$onView = "onView";
	$sql = 'select '.$region.', '.$class.', '.$displayDate.', '.$onView.' from allData WHERE region is not null AND region not like "%needschanging%"';
    $result = queryDB($sql);
    while ($row = mysqli_fetch_array($result)) {
    	$tmp = array($region=>$row[$region], $class=>$row[$class], $displayDate=>$row[$displayDate], $onView=>$row[$onView]);
    	array_push($jsonarray, $tmparr);
    }
    $regionClassDisplayOnView = json_encode($jsonarray);

    $sql1 = 'select region, classifications, displayDate, onView, available from allData WHERE region is not null AND region not like "%needschanging%"';
    $result1 = queryDB($sql);

	$bid = array();
	while ($row = mysqli_fetch_array($result1)) {
    	$tmpar = array(region=>$row["region"], classifications=>$row["classifications"],
    		displayDate=>$row["displayDate"], onView=>$row["onView"], available=>$row["available"]);
=======
	<?php  
    $sql = 'select region, classifications, displayDate, onView from allData WHERE region is not null AND region not like "%needschanging%"';
    $result = queryDB($sql);

	$objectsarr = array();
	
	while ($row = mysqli_fetch_array($result)) {
    	$tmpar = array(region=>$row["region"], classifications=>$row["classifications"], 
    		displayDate=>$row["displayDate"], onView=>$row["onView"]);    	
>>>>>>> 4eb5fa259e39b6a3570dc378cd6a4150cc8d45f1
    	array_push($bid, $tmpar);
    }
    $dataset = json_encode($bid);

<<<<<<< HEAD
	//Henter data omkring classifications
	$classarray = array();

	$sql = 'select distinct classifications from allData WHERE classifications is not null';
	$result = queryDB($sql);

	while ($row = mysqli_fetch_array($result)) {
		$tmparr = array(classification=>$row["classifications"], display=>true);
		array_push($classarray,$tmparr);
	}
	$classifications = json_encode($classarray);
	?>
=======
	
>>>>>>> 4eb5fa259e39b6a3570dc378cd6a4150cc8d45f1











