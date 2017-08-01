<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
$tg = trim($_GET["TourGuide"], " ");
$num = $_GET["Number"];
$sql = "INSERT INTO SignedIn (Name, Display, Number, Date, Window) VALUES ('".strtolower($tg)."', '".$tg."', '".$num."', '".date("Y-m-d")."', '".$cw."')";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
fclose($timeFile);
//check if tour guide is in People Database
$inDBfile = fopen("tourGuidesinDB.txt", "r+");
$Match = false;
while(!feof($inDBfile)){
    if(strtolower(fgets($inDBfile)) == (strtolower($tg)."\n")){
        $Match = true;
    }
}
if(!$Match) {
    $sql = "INSERT INTO People (Name, Number)
    VALUES ('" . strtolower($tg) . "', '".$num."')";
    if ($conn->query($sql) === TRUE) {
        fwrite($inDBfile, strtolower($tg)."\n");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
//cleanup and return to webpage that called this
fclose($inDBfile);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>