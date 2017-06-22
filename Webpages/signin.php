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
    VALUES ('" . strtolower($_GET['Name'] . "')");
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
    if((abs($eleven))<=(abs($one)) && (abs($eleven))<=(abs($three))){
        if($TourWindow != "eleven"){
            $signinsql = "DELETE FROM SignedIn";
            if ($conn->query($signinsql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $TourWindowFileW = fopen("currentTourWindow", "w");
            fwrite($TourWindowFileW, "eleven");
            fclose($TourWindowFileW);
        }
        if($eleven > 0){
            $sql = "UPDATE People set Late = Late+".($eleven/60)."WHERE Name='".strtolower($_GET['Name']."'");
            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            //echo("<script>alert(\"you are \".$eleven/60.\" minutes late\"</script>");
        }
    }else if((abs($one))<=(abs($eleven)) && (abs($one))<=(abs($three))){//(abs($one)/60<45){
        if($TourWindow != "one"){
//            echo "thirtytwo".fgets($TourWindowFile);
            $signinsql = "DELETE FROM SignedIn";
            if ($conn->query($signinsql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $TourWindowFileW = fopen("currentTourWindow", "w");
            fwrite($TourWindowFileW, "one");
            fclose($TourWindowFileW);
        }

        if($one > 0){
            $sql = "UPDATE People SET Late=Late+".($one/60)." WHERE Name='".strtolower($_GET['Name']."'");
            if ($conn->query($sql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
               echo "Error: " . $sql . "<br>" . $conn->error;
            }
          }
    }else{
        if($TourWindow != "three"){
//            echo "thirtytwo".fgets($TourWindowFile);
            $signinsql = "DELETE FROM SignedIn";
            if ($conn->query($signinsql) === TRUE) {
                //echo "New record created successfully".$eleveninm;
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            $TourWindowFileW = fopen("currentTourWindow", "w");
            fwrite($TourWindowFileW, "three");
            fclose($TourWindowFileW);
        }

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
    $signinsql = "INSERT INTO SignedIn (Name, Time) Values ('".$toWrite."', '".date("h:i")."')";
    if ($conn->query($signinsql) === TRUE) {
        //echo "New record created successfully".$eleveninm;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header('Location: ' . $_SERVER["HTTP_REFERER"] );
    exit;
?>