<?php
$dateFileW = fopen("EDD", "w");
fwrite($dateFileW, date("Y-m-d"));
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

