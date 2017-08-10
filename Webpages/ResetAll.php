<?php
$pwfile = fopen("Password", "r");
$pw = fgets($pwfile);
fclose($pwfile);
if(!password_verify($_POST["PSSWD"], $pw)){
    echo "password incorrect please re-enter password <a href='EnterAdmin.php'>here</a>";
    die;
}
require_once("DBConnect.php");
$deletes = 0;
$sql = "DELETE FROM People";
if ($conn->query($sql) === TRUE) {
    $deletes++;
} else {
    echo "Error deleting record: " . $conn->error;
}
$sql = "DELETE FROM SignedIn";
if ($conn->query($sql) === TRUE) {
    $deletes++;
} else {
    echo "Error deleting record: " . $conn->error;
}
if($deletes==2){
    echo "Record deleted successfully<br><a onclick='goBack()' style='color: purple; cursor: pointer;'>Click Here To Return To Admin Page</a> ";
}else{
    echo "Error deleting records";
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
    <input type="text" name="PSSWD" value="<?php echo $_POST["PSSWD"]?>" readonly>
</form>
</body>
</html>
