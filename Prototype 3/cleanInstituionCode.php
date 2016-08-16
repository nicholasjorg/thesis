<?php
include 'functions.php';

    dbconnect();
    $counter = 0;
    $unknown = 0;
    $commas = 0;
    $length = 0;
    $afterString = "";

    //Hent listen af entiteter, der skal ændres.
    $sql = 'SELECT id, institution, institutionCode FROM alldata where institutionCode is null and municipality is not null';

    //Hent en entitet for test

    //$sql = 'SELECT id, institution, institutionCode FROM alldata where institution = "UNI-C, tidligere Danmarks Edb-Center"';

    $result = queryDB($sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $tmp = array(id=>$row["id"], institution=>$row["institution"], institutionCode=>$row["institutionCode"]);
        $tmpString = $tmp['institution'];
        $currentId = $tmp[id];

        if (strpos($tmpString, ',')){
            $afterString = substr($tmpString, 0, strpos($tmpString, ","));
            $commas++;
            //$updateSql = "UPDATE alldata SET institution = '" . $afterString . "' WHERE id=" . $currentId;
            //echo $updateSql . "<br>";
            //queryDB($updateSql);
            //echo "updated " , $tmpString , " to " , $afterString , " id = " , $currentId , "<br>" ;
            //echo $tmpString . "<br>";
        }

        elseif (strlen($tmpString) > 44){
            /*$currentInstitution = $tmpString;
            $sqlGetLength = "SELECT DisplayName FROM InstitionsKoder WHERE DisplayName LIKE '" . $currentInstitution."%' LIMIT 1";
            //echo $sqlGetLength . "<br>";

            $newResult = queryDB($sqlGetLength);

            while ($thisRow = mysqli_fetch_assoc($newResult)) {
                $newArray = array(DisplayName=>$thisRow["DisplayName"]);
            }
            $correctInstitution = $newArray['DisplayName'];

            echo "I want to change this " . $tmpString . " to this " . $correctInstitution . "<br>";

            $updateSQL = "UPDATE alldata SET institution = '" . $correctInstitution . "' WHERE id = " . $currentId;

            queryDB($updateSQL);
            */
            $length++;
        }

        else {
            $afterString = $tmpString;
            $unknown++;
            echo $tmpString , $currentId , "<br>";
        }
        $counter++;
    }
    echo "_________________________________", "<br> <br>";
    echo "total is " , $counter , "<br> <br>";
    echo "Length " , $length, "<br> <br>";
    echo "Commas " , $commas, "<br> <br>";
    echo "unknown " , $unknown, "<br> <br>";

    echo $unknown , " + " , $commas , " + " , $length , " = " , $unknown + $commas + $length;
?>

