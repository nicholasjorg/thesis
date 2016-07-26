	<?php
    $local = "";
    include 'limit.php';
	$jsonarray = array();
	$sql = 'select region, municipality, classifications, displayDate, institutionCode, count(*) as antal from allData WHERE region is not null AND municipality is not null AND region not like "%needschanging%" group by region, municipality, classifications, displayDate, institutionCode';

    $result = queryDB($sql);
    while ($row = mysqli_fetch_assoc($result)) {
    	$tmp = array(region=>$row["region"], municipality=>$row["municipality"], classifications=>$row["classifications"], displayDate=>$row["displayDate"], institutionCode=>$row["institutionCode"], antal=>$row["antal"]);
    	array_push($jsonarray, $tmp);
    }
    $dataset = json_encode($jsonarray);
	?>









