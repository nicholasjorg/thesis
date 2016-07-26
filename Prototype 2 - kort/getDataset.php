	<?php
    $local = "";
    include 'limit.php';
	$jsonarray = array();
	$sql = 'select region, municipality, classifications, displayDate, count(*) as antal from allData WHERE region is not null AND municipality is not null AND region not like "%needschanging%" group by region, municipality, classifications, displayDate';

    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"], displayDate=>$row["displayDate"], antal=>$row["antal"]);
    	array_push($jsonarray, $tmp);
    }
    $dataset = json_encode($jsonarray);
	?>









