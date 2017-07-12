<?php
$dateFileR = fopen("EDD", "r");
$currentDate = fgets($dateFileR);
fclose($dateFileR);
$newDate = date('Y-m-d', strtotime($currentDate) - 30 * 86400);
$dateFileW = fopen("EDD", "w");
fwrite($dateFileW, $newDate);
fclose($dateFileW);
?>
<html>
<form name='redirect' action='getPreviousTours.php' method='POST'>
    <input type='hidden' name='PSSWD' value='<?php echo $_POST["PSSWD"]; ?>'>
</form>
<script type='text/javascript'>
    document.redirect.submit();
</script>
</html>
