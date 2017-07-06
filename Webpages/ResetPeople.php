<?php
require_once("DBConnect.php");
$totalsWipe = fopen("Session1Totals", "w");
fwrite($totalsWipe, "Name\tTours\tLate\tAbsences");
fclose($totalsWipe);
$totals = fopen("Session1Totals", "a");
$sql = "SELECT * FROM People";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $toWrite = "\n" . $row["Name"] . "\t\t" . $row["Tours"] . "\t\t" . $row["Late"] . "\t\t" . $row["Absences"];
        fwrite($totals, $toWrite);
    }
}
fclose($totals);
$reset = fopen("tourGuidesinDB", "w");
fclose($reset);
$sql2 = "DELETE FROM People";
if ($conn->query($sql2) === TRUE) {
    echo "Record deleted successfully<br><a href='admin.php'>Click Here To Return To Admin Page</a> ";
} else {
    echo "Error deleting record: " . $conn->error;
}

?>