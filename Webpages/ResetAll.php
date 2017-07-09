<?php
require_once("DBConnect.php");
$reset = fopen("tourGuidesinDB.txt", "w");
fclose($reset);
$deletes = 0;
$sql = "DELETE FROM People";
if ($conn->query($sql) === TRUE) {
    $deletes++;
} else {
    echo "Error deleting record: " . $conn->error;
}
$sql = "DELETE FROM SignedIn";
if ($conn->query($sql) === TRUE) {
    $deletes++;
} else {
    echo "Error deleting record: " . $conn->error;
}
if($deletes==2){
    echo "Record deleted successfully<br><a href='admin.php'>Click Here To Return To Admin Page</a> ";
}else{
    echo "Error deleting records";
}
?>