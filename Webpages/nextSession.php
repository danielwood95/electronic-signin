<?php
date_default_timezone_set("America/New_York");
$timeFileR = fopen("currentTourWindow", "r");
$ct = fgets($timeFileR);
$timeFileW = fopen("currentTourWindow", "w");
if($ct == "eleven"){
    if(date("w") == "0"){
        $toWrite = "three";
    }else{
        $toWrite = "one";
    }
}else if($ct == "one"){
    $toWrite = "three";
}else{
    $toWrite = "eleven";
}
fwrite($timeFileW, $toWrite);
fclose($timeFileR);
fclose($timeFileW);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>