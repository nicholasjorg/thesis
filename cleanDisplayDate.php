<?php require("functions.php"); ?>

<?php
    $sql = "select id,displayDate from allData where length(displayDate) > 4";
    $result = queryDB($sql);
    $idArray = array();
    $dateArray = array();

    while ($row = mysqli_fetch_array($result)) {
        array_push($idArray,$row["id"]);
        array_push($dateArray,$row["displayDate"]);
    }

    for ($i = 0;$i < sizeof($idArray);$i++){
        $changeTo = substr($dateArray[$i],0,4);
        //echo '<p>' . $changeTo .'</p>';
        $currentId = $idArray[$i];
        $sqlClean = "UPDATE allData SET displayDate='" . $changeTo ."'"." Where id ='".$currentId."'";
        queryDB($sqlClean);
    }
    echo "Done";

?>