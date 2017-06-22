<?php
require_once("DBConnect.php");
$name = $_GET["TourGuide"];
$sql = "UPDATE People SET Tours=Tours+1 WHERE Name='".strtolower($name)."'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$sql = "UPDATE SignedIn SET Tour='true' WHERE Name='".$name."'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>