<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
fclose($timeFile);
$tg = $_GET["TourGuide"];
$sub = $_GET["Substitute"];
$num = $_GET["Number"];
$sql = "UPDATE SignedIn SET Name='".strtolower($sub)."', Number='".$num."' WHERE Name='".strtolower($tg)."'AND Date='".date("Y-m-d")."' AND Window='".$cw."' AND Here='false'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$inDBfile = fopen("tourGuidesinDB.txt", "r+");
$Match = false;
while(!feof($inDBfile)){
    if(strtolower(fgets($inDBfile)) == (strtolower($sub)."\n")){
        $Match = true;
    }
}
if(!$Match) {
    $sql = "INSERT INTO People (Name, Number)
    VALUES ('" . strtolower($sub) . "', '".$num."')";
    if ($conn->query($sql) === TRUE) {
        fwrite($inDBfile, strtolower($sub)."\n");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
fclose($inDBfile);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>