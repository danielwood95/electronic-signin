<!DOCTYPE HTML>
<html>
<style>
    body{
        text-align: center;
        border-top: solid orange;
        background-color: white;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    }
    table{
        border: solid black;
        width: 100%;
        text-align: center;
    }
    tr,th,td{
        border: solid black;
        text-align: center;
        font-size: large;
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
    }
    tr{
        height: 35px;
    }
    input:read-only{
        text-align: center;
        border: none;
    }
    .transparent{
        color: transparent;
    }
    .orange{
        background-color: orange;
    }
    .button{
        border: solid black;
        background-color: orange;
        border-radius: 15%;
        height: 30px;
    }
    .textfield{
        border: solid orange;
        color: black;
    }
    input{
        font-family: -apple-system, BlinkMacSystemFont, sans-serif;
        font-size: large;
    }
</style>
<h1>Admissions Check In</h1>
<script>
    function validateForm(){
        window.location.reload();
        var nameVal = document.forms["signin"]["Name"].value.toLowerCase();
        if(nameVal == "sign in" || nameVal == "" || nameVal.indexOf("\"")!=-1 || nameVal.indexOf("\'")!=-1){
            alert("Please Enter Your Name To Sign In");
            return false;
        }
        var newWindow = "f";
        newWindow = <?php
            date_default_timezone_set("America/New_York");
            $SONEFile = fopen("SessionOne", "r");
            $STWOFile = fopen("SessionTwo", "r");
            $STHREEFile = fopen("SessionThree", "r");
            $SONETime = fgets($SONEFile);
            $STWOTime = fgets($STWOFile);
            $STHREETime = fgets($STHREEFile);
            fclose($SONEFile);
            fclose($STWOFile);
            fclose($STHREEFile);
            $eleven = time()-strtotime((date("Y-m-d")." ".$SONETime));
            $one = time()-strtotime((date("Y-m-d")." ".$STWOTime));
            $three = time()-strtotime((date("Y-m-d")." ".$STHREETime));
            $TourWindowFileR = fopen("currentTourWindow", "r");
            $TourWindow = fgets($TourWindowFileR);
            fclose($TourWindowFileR);
            if(((abs($eleven))<=(abs($one)) && (abs($eleven))<=(abs($three))) && $TourWindow != "eleven"){
                echo "\"t\"";
            }else if(((abs($one))<=(abs($eleven)) && (abs($one))<=(abs($three))) && $TourWindow != "one"){
                echo "\"t\"";
            }else if (((abs($three))<=(abs($eleven)) && (abs($three))<=(abs($one))) && $TourWindow != "three"){
                echo "\"t\"";
            }else{
                echo "\"f\"";
            }
            ?>;
            if(newWindow == "f"){
            var signedIn = document.getElementById("SignedInPeople").innerHTML.toLowerCase();
            if(signedIn.indexOf(("\n".concat(nameVal, "\n")))!=-1){
                alert("You Are Already Signed In");
                return false;
            }
        }
    }
</script>
<form id="signin" action="signin.php" method="get" onsubmit="return validateForm()">
    <input class="textfield" type="text" name="Name" placeholder="Sign In">
    <input class="button" type="submit" value="Submit">
</form>
<br>
<table>
    <col width="70%">
    <col width="15%"
    <col width="15%">
    <tr>
        <th>Name</th>
        <th>Checked In</th>
        <th>Tour</th>
    </tr>
    <?php
    require_once("DBConnect.php");
    $sql = "SELECT * FROM SignedIn";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["Tour"] == "false"){
                echo "<tr>
        <form action=\"startTour.php\" method=\"get\">
            <td>
                <input id=\"name\" name=\"TourGuide\" type=\"text\" value=\"".$row["Name"]."\" readonly>
            </td>
            <td>
                ".$row["Time"]."
            </td>
            <td>
                <input class=\"button\" type=\"submit\" value=\"start\">
            </td>
        </form>
    </tr>";
            }else{
                echo "<tr class='orange'><td>
                ".$row["Name"]."
            </td>
            <td>
            ".$row["Time"]."
            </td>
            <td>
                Started
            </td></tr>";
            }
        }
    }
    ?>
</table>
<span class="transparent" id="SignedInPeople">
<?php
require_once("DBConnect.php");
$sql = "SELECT Name FROM SignedIn";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "\n".$row["Name"]."\n";
    }
}
?>
</span>
</html>