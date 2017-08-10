<?php
$pwfile = fopen("Password", "r");
$pw = fgets($pwfile);
fclose($pwfile);
if(!password_verify($_POST["PSSWD"], $pw)){
    echo "password incorrect please re-enter password <a href='EnterAdmin.php'>here</a>";
    die;
}
require_once("DBConnect.php");
$semesterEnd = fopen("SemesterEnd", "w");
fwrite($semesterEnd, $_POST["SemesterDate"]);
$totalsWipe = fopen("Session1Totals", "w");
fwrite($totalsWipe, "Name\t\tTours\tLate\tAbsences");
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
$sql2 = "DELETE FROM People";
if ($conn->query($sql2) === TRUE) {
    echo "Semester Started Successfully <br><a onclick='goBack()' style='color: purple; cursor: pointer;'>Click Here To Return To Admin Page</a> ";
} else {
    echo "Error deleting record: " . $conn->error;
    die;
}
?>
<html>
<body>
<script>
    function goBack(){
        document.forms['goBack'].submit();
    }
</script>
<form id="goBack" action="admin.php" method="post" style="visibility: hidden; display: none;">
    <input type="text" name="PSSWD" value="<?php echo$_POST["PSSWD"]?>" readonly>
</form>
</body>
</html>
