<?php
date_default_timezone_set("America/New_York");
$timeFileR = fopen("currentTourWindow", "r");
$ct = fgets($timeFileR);
$timeFileW = fopen("currentTourWindow", "w");
if($ct == "eleven"){
    $toWrite = "three";
}else if($ct == "one"){
    $toWrite = "eleven";
}else{
    if(date("w")=="0"){
        $toWrite = "eleven";
    }else{
        $toWrite = "one";
    }
}
fwrite($timeFileW, $toWrite);
fclose($timeFileR);
fclose($timeFileW);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>