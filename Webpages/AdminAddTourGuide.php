<?php
require_once("DBConnect.php");
date_default_timezone_set("America/New_York");
$tg = str_replace("'"," ",trim($_POST["Name"], " "));
$num = str_replace("'"," ",$_POST["Number"]);
$day = $_POST["Day"];
$win = $_POST["Window"];
if($day == "none"){
    $win = "none";
}
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
    $sql = "INSERT INTO People (Name, Day, Window, Number)
    VALUES ('" . strtolower($tg) . "', '".$day."', '".$win."', '".$num."')";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
    }
}else{
    $sql = "SELECT Day FROM People WHERE Name='".strtolower($tg)."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["Day"] != "none"){
                $enddateFile = fopen("SemesterEnd", "r");
                $enddate = fgets($enddateFile);
                fclose($enddateFile);
                $daytoReplace = $row["Day"];
                $startdate = date('Y-m-d', (strtotime("next ".$daytoReplace)));
                $dateArray = date_range($startdate, $enddate);
                for($x = 0; $x < count($dateArray); $x++) {
                    $sql = "DELETE FROM SignedIn WHERE Name='".strtolower($tg)."' AND Date='".$dateArray[$x]."'";
                    if ($conn->query($sql) === TRUE) {
                        //echo "New record created successfully".$eleveninm;
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        die;
                    }
                }
            }
        }
    }
    $sql = "UPDATE People SET Window='".$win."', Day='".$day."', Number='".$num."' WHERE Name='".strtolower($tg)."'";
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
    }
}
function date_range($first, $last, $step = '+7 day', $output_format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}
if($day != "none"){
    $enddateFile = fopen("SemesterEnd", "r");
    $enddate = fgets($enddateFile);
    fclose($enddateFile);
    $startdate = date('Y-m-d', (strtotime("next ".$day)));
    $dateArray = date_range($startdate, $enddate);
    for($x = 0; $x < count($dateArray); $x++) {
        $sql = "INSERT INTO SignedIn (Name, Display, Number, Date, Window) VALUES ('".strtolower($tg)."', '".$tg."', '".$num."', '".$dateArray[$x]."', '".$win."')";
        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully".$eleveninm;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            die;
        }
    }
}
?>
<html>
<form name='redirect' action='admin.php' method='POST'>
    <input type='hidden' name='PSSWD' value='<?php echo $_POST["PSSWD"]; ?>'>
</form>
<script type='text/javascript'>
    document.redirect.submit();
</script>
</html>

