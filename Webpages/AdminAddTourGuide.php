<?php
require_once("DBConnect.php");
$tg = $_GET["Name"];
$num = $_GET["Number"];
$date = $_GET["Date"];
$win = $_GET["Window"];
$sql = "INSERT INTO SignedIn (Name, Number, Date, Window) VALUES ('".$tg."', '".$num."', '".$date."', '".$win."')";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>