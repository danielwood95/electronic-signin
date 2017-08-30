<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
$tg = str_replace("'"," ",trim($_GET["TourGuide"], " "));
$num = str_replace("'"," ",$_GET["Number"]);
$sql = "INSERT INTO SignedIn (Name, Display, Number, Date, Window) VALUES ('".strtolower($tg)."', '".$tg."', '".$num."', '".date("Y-m-d")."', '".$cw."')";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
fclose($timeFile);
//check if tour guide is in People Database
$Match = false;
$sql = "SELECT Name FROM People";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        if(strtolower($row["Name"]) == (strtolower($tg))){
            $Match = true;
        }
    }
}
if(!$Match) {
    $sql = "INSERT INTO People (Name, Number)
    VALUES ('" . strtolower($tg) . "', '".$num."')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
//cleanup and return to webpage that called this
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>