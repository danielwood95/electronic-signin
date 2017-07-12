<?php
    require_once("DBConnect.php");
    $inDBfile = fopen("tourGuidesinDB.txt", "r+");
    $Match = false;
    while(!feof($inDBfile)){
        if(strtolower(fgets($inDBfile)) == (strtolower($_GET['Name'])."\n")){
            $Match = true;
        }
    }
    if(!$Match) {
        $sql = "INSERT INTO People (Name)
    VALUES ('" . strtolower($_GET['Name']) . "')";
        if ($conn->query($sql) === TRUE) {
            fwrite($inDBfile, strtolower($_GET['Name'])."\n");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    fclose($inDBfile);
    $SONEFile = fopen("SessionOne", "r");
    $STWOFile = fopen("SessionTwo", "r");
    $STHREEFile = fopen("SessionThree", "r");
    $SONETime = fgets($SONEFile);
    $STWOTime = fgets($STWOFile);
    $STHREETime = fgets($STHREEFile);
    fclose($SONEFile);
    fclose($STWOFile);
    fclose($STHREEFile);
    date_default_timezone_set("America/New_York");
    $eleven = time()-strtotime((date("Y-m-d")." ".$SONETime));
    $one = time()-strtotime((date("Y-m-d")." ".$STWOTime));
    $three = time()-strtotime((date("Y-m-d")." ".$STHREETime));
    $toWrite = $_GET['Name'];
    $TourWindowFileR = fopen("currentTourWindow", "r");
    $TourWindow = fgets($TourWindowFileR);
    $signinsql;
    if($TourWindow == "eleven"){
        if($eleven > 0){
            $sql = "UPDATE People set Late = Late+".($eleven/60)."WHERE Name='".strtolower($_GET['Name']."'");
            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            //echo("<script>alert(\"you are \".$eleven/60.\" minutes late\"</script>");
        }
    }else if($TourWindow == "one"){//(abs($one)/60<45){

        if($one > 0){
            $sql = "UPDATE People SET Late=Late+".($one/60)." WHERE Name='".strtolower($_GET['Name']."'");
            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }
    }else{
        if($three > 0){
            $sql = "UPDATE People SET Late=Late+".($three/60)." WHERE Name='".strtolower($_GET['Name']."'");
            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
    //echo date("Y-m-d");
    fclose($TourWindowFileR);
    $sisql = "UPDATE SignedIn SET Here='true' WHERE Name='".strtolower($_GET['Name'])."'";
    if ($conn->query($sisql) === TRUE) {
        //echo "New record created successfully".$eleveninm;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
    exit;
?>