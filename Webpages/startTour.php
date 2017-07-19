<?php
date_default_timezone_set("America/New_York");
require_once("DBConnect.php");
$name = $_GET["TourGuide"];
$sql = "UPDATE People SET Tours=Tours+1 WHERE Name='".strtolower($name)."'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "UPDATE SignedIn SET Tour='true' WHERE Name='".strtolower($name)."' AND Date='".date("Y-m-d")."'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>