<?php
$pwfile = fopen("Password", "r");
$pw = fgets($pwfile);
fclose($pwfile);
if(password_verify($_POST["OldPW"], $pw)){
    $pwwrite = fopen("Password", "w");
    $towrite = password_hash($_POST["NewPW"], PASSWORD_DEFAULT);
    fwrite($pwwrite, $towrite);
    echo "Password Reset Sucessfully Click <a href='EnterAdmin.php'>Here</a> To Return To Login";
}else{
    echo "Old Password Is Incorrect Click <a href='EnterAdmin.php'>Here</a> To Return To Login";
}
?>