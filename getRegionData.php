	<?php  
    $sql = 'select region, classifications, displayDate, onView from allData WHERE region is not null AND region not like "%needschanging%"';
    $result = queryDB($sql);

	$objectsarr = array();
	
	while ($row = mysqli_fetch_array($result)) {
    	$tmpar = array(region=>$row["region"], classifications=>$row["classifications"], 
    		displayDate=>$row["displayDate"], onView=>$row["onView"]);    	
    	array_push($bid, $tmpar);
    }
    $dataset = json_encode($bid);
	?>

	











