<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
fclose($timeFile);
$tg = $_GET["TourGuide"];
$sub = $_GET["Substitute"];
$num = $_GET["Number"];
$sql = "UPDATE SignedIn SET Name='".$sub."', Number='".$num."' WHERE Name='".$tg."'AND Date='".date("Y-m-d")."' AND Window='".$cw."' AND Here='false'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>