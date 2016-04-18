<?php
    require(functions.php);
    $var1 = "region";
    $var2 = "count(*)";
    $sql = 'select distinct displayDate From allData where displayDate is not null order by displayDate asc';
    $result = queryDB($sql);
?>