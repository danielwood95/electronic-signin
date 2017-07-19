<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
$tg = $_GET["TourGuide"];
$toUndo = $_GET["Did"];
$sql = "UPDATE SignedIn SET Here='false' WHERE Name='".strtolower($tg)."' AND Date='".date("Y-m-d")."' AND Window='".$cw."'";
if($toUndo == "Tour"){
    $sql = "UPDATE People SET Tours=Tours-1 WHERE Name='".strtolower($tg)."'";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully".$eleveninm;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $sql = "UPDATE SignedIn SET Tour='false' WHERE Name='".strtolower($tg)."' AND Date='".date("Y-m-d")."' AND Window='".$cw."'";
}
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
fclose($timeFile);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>