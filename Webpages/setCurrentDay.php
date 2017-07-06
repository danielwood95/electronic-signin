<?php
$dateFileW = fopen("EDD", "w");
fwrite($dateFileW, date("Y-m-d"));
fclose($dateFileW);
header('Location: ' . $_SERVER["HTTP_REFERER"] );
exit;
?>