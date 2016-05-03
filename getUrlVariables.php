<?php
if (isset($_GET['region'])){
    $region = '"'.$_GET['region'].'";';
}
if (isset($_GET['year'])){
    $year = $_GET['year']. ";";
}
if (isset($_GET['startYear'])){
    $startYear = $_GET['startYear']. ";";
}
if (isset($_GET['endYear'])){
    $endYear = $_GET['endYear']. ";";
}
if (isset($_GET['typer'])){
    $typer = $_GET['typer'] . ";";
}
if (isset($_GET['onView'])){
    $onView = $_GET['onView'] . ";";
}
?>