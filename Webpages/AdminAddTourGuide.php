<?php
require_once("DBConnect.php");
$tg = $_POST["Name"];
$num = $_POST["Number"];
$day = $_POST["Day"];
$win = $_POST["Window"];
$inDBfile = fopen("tourGuidesinDB.txt", "r+");
$Match = false;
while(!feof($inDBfile)){
    if(strtolower(fgets($inDBfile)) == (strtolower($_POST['Name'])."\n")){
        $Match = true;
    }
}
if(!$Match) {
    $sql = "INSERT INTO People (Name, Day, Window, Number)
    VALUES ('" . strtolower($tg) . "', '".$day."', '".$win."', '".$num."')";
    if ($conn->query($sql) === TRUE) {
        fwrite($inDBfile, strtolower($tg)."\n");
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
$enddateFile = fopen("SemesterEnd", "r");
$enddate = fgets($enddateFile);
fclose($enddateFile);
$startdate = date('Y-m-d', (strtotime("next ".$day)-604800));
//$startdate = date('Y-m-d', strtotime($day));
$dateArray = date_range($startdate, $enddate);
for($x = 0; $x < count($dateArray); $x++) {
    $sql = "INSERT INTO SignedIn (Name, Number, Date, Window) VALUES ('".$tg."', '".$num."', '".$dateArray[$x]."', '".$win."')";
    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully".$eleveninm;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die;
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

