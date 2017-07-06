<?php
$dateFileR = fopen("EDD", "r");
$currentDate = fgets($dateFileR);
fclose($dateFileR);
$newDate = date('Y-m-d', strtotime($currentDate) + 30 * 86400);
$dateFileW = fopen("EDD", "w");
fwrite($dateFileW, $newDate);
fclose($dateFileW);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>