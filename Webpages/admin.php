<!DOCTYPE HTML>
<?php
$pwfile = fopen("Password", "r");
$pw = fgets($pwfile);
fclose($pwfile);
if(!password_verify($_POST["PSSWD"], $pw)){
    echo "password incorrect please re-enter password <a href='EnterAdmin.php'>here</a>";
    die;
}
?>
<html>
<head>
<style>
    body{
        text-align: center;
    }
    table{
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        background-color: white;
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    a{
        color: purple;
        text-decoration: none;
    }
    h1{
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }
    div{
        border-radius: 10px;
        background-color: gray;
        border: solid black;
        align-content: center;
        margin-bottom: 10px;
    }
    #resetDiv{
        width:50%;
        height:330px;
        margin-top:10px;
        background-color:orange;
        border-radius:3px;
        padding:10px;
        box-sizing:border-box;
        visibility:hidden;
        display:none;
        position: fixed;
        top: 0;
        left: 25%;
        right: 25%;
        text-align: center;
        border: solid lightgray;
    }
    #toPrev{
        visibility:hidden;
        display:none;
    }

</style>
</head>
<body>
<script>
    function deleteCheck() {
        if(confirm("You Are Deleting All Tour Information From This Current Year Are You Sure You Would Like To Continue?")){
        }else{
            return false;
        }
    }
    function openReset() {
        if(confirm("Are You Sure You Would Like To Reset The Tour Guide Totals")){
            document.getElementById("resetDiv").style.display = "block";
            document.getElementById("resetDiv").style.visibility = "visible";
        }
    }
    function closeReset() {
        document.getElementById('resetDiv').style.display = "none";
    }
    function toPreviousTours(){
        document.getElementById("toPrev").submit();
    }
</script>
<span style="float: left; margin-left: 10px; margin-bottom:10px;"><a onclick="toPreviousTours()" style="color: purple; cursor: pointer;">See Previous Tours</a></span>
<span style="float: right; margin-right: 10px; margin-bottom:10px;"><a href="layout.php">Tour Guide Sign In</a></span>
<h1>Admin Page</h1>
<div id="totals">
    <h2>Totals:</h2>
    <table>
            <col width="25%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <col width="15%">
            <tr>
                <th>Name</th>
                <th>Tours Given</th>
                <th>Minutes Late</th>
                <th>Absences</th>
                <th>Tour Day</th>
                <th>Tour Time</th>
            </tr>
            <?php
            require_once("DBConnect.php");
            $sql = "SELECT * FROM People";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $win = "11:15";
                    if($row["Window"] == "one"){
                        $win="1:00";
                    }else if($row["Window"] == "three"){
                        $win = "3:30";
                    }
                    echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Tours"]."</td>
                <td>".$row["Late"]."</td>
                <td>".$row["Absences"]."</td>
                <td>".$row["Day"]."</td>
                <td>".$win."</td>
            </tr>";
                }
            }
            ?>
    </table>
        <br><br>
</div>
<div id="addTour">
    <h2>Add Tour</h2>
        <table id="addTourGuideTable">
            <tr>
                <th>Tour Guide's Name</th>
                <th>Tour Guide's Number</th>
                <th>Day to give tour</th>
                <th>Tour Time</th>
                <th>Enter</th>
            </tr>
            <form id="add" action="AdminAddTourGuide.php">
                <tr>
                    <td><input type="text" name="Name" placeholder="Name" required></td>
                    <td><input type="text" name="Number" placeholder="Number" required></td>
                    <td><select name="Day" required>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                        </select></td>
                    <td><select name="Window" required>
                            <option value="eleven">11:15</option>
                            <option value="one">1:00</option>
                            <option value="three">3:30</option>
                        </select></td>
                    <td><input type="submit"></td>
                </tr>
            </form>
        </table>
    <br><br>
</div>
<div id="resetDiv">
    <h1>New Semester</h1>
    <form action="ResetPeople.php" method="get">
        Date the New Semester ends:<br>
        <input type="date" name="SemesterDate" required><br><br>
        <input type="submit" value="Make New Semester" style="background-color: green; border-radius: 5px;">
    </form><br>
    <button style="background-color: red; border-radius: 5px;" onclick="closeReset()">Cancel</button>
</div>
<button style="background-color: orange; float: left; margin-left: 10px; border-radius: 5px" onclick="openReset()">New Semester</button>
<form action="ResetAll.php" onsubmit="return deleteCheck()">
    <input type="submit" value="Reset All" style="background-color: red; float: left; margin-left: 10px; border-radius: 5px">
</form>
<form id="toPrev" action="getPreviousTours.php" method="post">
    <input type="password" value="<?php echo $_POST["PSSWD"];?>" name="PSSWD" readonly>
</form>
</body>
</html>