<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$cw = fgets($timeFile);
fclose($timeFile);
$tg = str_replace("'"," ",($_GET["TourGuide"]));
$sub = str_replace("'"," ",trim($_GET["Substitute"], " "));
$num = str_replace("'"," ",$_GET["Number"]);
$sql = "UPDATE SignedIn SET Name='".strtolower($sub)."', Display='".$sub."', Number='".$num."' WHERE Name='".strtolower($tg)."'AND Date='".date("Y-m-d")."' AND Window='".$cw."' AND Here='false'";
if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully".$eleveninm;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$Match = false;
$sql = "SELECT Name FROM People";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        if(strtolower($row["Name"]) == (strtolower($sub))){
            $Match = true;
        }
    }
}
if(!$Match) {
    $sql = "INSERT INTO People (Name, Number)
    VALUES ('" . strtolower($sub) . "', '".$num."')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>