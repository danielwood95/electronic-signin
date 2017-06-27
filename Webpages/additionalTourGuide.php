<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
$tg = $_GET["TourGuide"];
$num = $_GET["Number"];
$sql = "INSERT INTO SignedIn (Name, Number, Date, Window) VALUES ('".$tg."', '".$num."', '".date("Y-m-d")."', '".$cw."')";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
fclose($timeFile);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>