<!DOCTYPE HTML>
<?php
//check password
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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
    th{
        cursor: pointer;
    }
    th:hover{
        background-color: lightgray;
    }
    .t2header{
        cursor: auto;
    }
    .t2header:hover{
        background-color: white;
    }
</style>
</head>
<body>
<script>
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("totalstable");
        switching = true;
        //Set the sorting direction to ascending:
        dir = "asc";
        /*Make a loop that will continue until
         no switching has been done:*/
        while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.getElementsByTagName("TR");
            /*Loop through all table rows (except the
             first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
                //start by saying there should be no switching:
                shouldSwitch = false;
                /*Get the two elements you want to compare,
                 one from current row and one from the next:*/
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                /*check if the two rows should switch place,
                 based on the direction, asc or desc:*/
                if (dir == "asc") {
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                        //if so, mark as a switch and break the loop:
                        shouldSwitch= true;
                        break;
                    }
                }
            }
            if (shouldSwitch) {
                /*If a switch has been marked, make the switch
                 and mark that a switch has been done:*/
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                //Each time a switch is done, increase this count by 1:
                switchcount ++;
            } else {
                /*If no switching has been done AND the direction is "asc",
                 set the direction to "desc" and run the while loop again.*/
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    }
</script>
<script>
//    add dashes automatically for phone number
    $(function() {
        $("#Number").attr('maxlength', '12');
        $("#Number").on('keyup', function() {
            var inp = $("#Number").val();
            var n = inp.indexOf("-");
            if ((inp.length == 3) || (inp.length == 7)) {
                $('#Number').val(inp + '-');
            }
            else {

            }
        });
    });
    function deleteCheck() {
        if(confirm("Deleting all tour information. Would you like to continue?")){
        }else{
            return false;
        }
    }
    function openReset() {
        if(confirm("Starting a new semester and resetting tour guide totals. Would you like to continue?")){
            document.getElementById("resetDiv").style.display = "block";
            document.getElementById("resetDiv").style.visibility = "visible";
        }
    }
    function closeReset() {
        document.getElementById('resetDiv').style.display = "none";
    }
    //submit previous tours form when hyperlink is clicked
    function toPreviousTours(){
        document.getElementById("toPrev").submit();
    }
</script>
<?php
$SemesterEndFile = fopen("EDD", "r");
$SemesterEnd = fgets($SemesterEndFile);
fclose($SemesterEndFile);
if(time() > strtotime($SemesterEnd)){
    echo"<script> alert('The current semester has ended to set a new semester click the new semester button');
</script>";
}
?>
<span style="float: left; margin-left: 10px; margin-bottom:10px;"><a onclick="toPreviousTours()" style="color: purple; cursor: pointer;">See Previous Tours</a></span>
<span style="float: right; margin-right: 10px; margin-bottom:10px;"><a href="index.php">Tour Guide Sign In</a></span>
<h1>Admin Page</h1>
<div id="totals">
    <h2>Totals:</h2>
    <table id="totalstable">
            <col width="25%">
            <col width="12.5%">
            <col width="12.5%">
            <col width="12.5%">
            <col width="12.5%">
            <col width="12.5%">
            <col width="12.5%">
            <tr>
                <th onclick="sortTable(0)">Name</th>
                <th onclick="sortTable(1)">Number</th>
                <th onclick="sortTable(2)">Tours Given</th>
                <th onclick="sortTable(3)">Minutes Late</th>
                <th onclick="sortTable(4)">Absences</th>
                <th onclick="sortTable(5)">Tour Day</th>
                <th onclick="sortTable(6)">Tour Time</th>
            </tr>
            <?php
            //get totals from People Table
            require_once("DBConnect.php");
            $sql = "SELECT * FROM People";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $win = $row["Window"];
                    if($row["Window"] == "one"){
                        $win="1:00";
                    }else if($row["Window"] == "three"){
                        $win = "3:30";
                    }else if($row["Window"] == "eleven"){
                        $win = "11:15";
                    }
                    echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
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
                <th class="t2header">Tour Guide's Name</th>
                <th class="t2header">Mobile Number</th>
                <th class="t2header">Day To Give Tour</th>
                <th class="t2header">Tour Time</th>
                <th class="t2header">Enter</th>
            </tr>
            <form id="add" action="AdminAddTourGuide.php" method="post">
                <tr>
                    <td><input type="text" name="Name" placeholder="Name" required></td>
                    <td><input id="Number" type="text" name="Number" placeholder="Number" required></td>
                    <td><select name="Day" required>
                            <option value="monday">Monday</option>
                            <option value="tuesday">Tuesday</option>
                            <option value="wednesday">Wednesday</option>
                            <option value="thursday">Thursday</option>
                            <option value="friday">Friday</option>
                            <option value="saturday">Saturday</option>
                            <option value="sunday">Sunday</option>
                            <option value="none">None</option>
                        </select></td>
                    <td><select name="Window" required>
                            <option value="eleven">11:15</option>
                            <option value="one">1:00</option>
                            <option value="three">3:30</option>
                        </select></td>
<!--                    pass password to where form submits so it does not have to be reentered-->
                    <input name="PSSWD" value="<?php echo $_POST["PSSWD"]; ?>" style="visibility: hidden; display: none;" type="text">
                    <td><input type="submit"></td>
                </tr>
            </form>
        </table>
    <br><br>
</div>
<div id="resetDiv">
    <h1>New Semester</h1>
    <form action="ResetPeople.php" method="post">
        <!--pass password to where form submits so it does not have to be reentered-->
        <input name="PSSWD" value="<?php echo $_POST["PSSWD"]; ?>" style="visibility: hidden; display: none;" type="text">
        Date the New Semester ends:<br>
        <input type="date" name="SemesterDate" required><br><br>
        <input type="submit" value="Make New Semester" style="background-color: green; border-radius: 5px;">
    </form><br>
    <button style="background-color: red; border-radius: 5px;" onclick="closeReset()">Cancel</button>
</div>
<button style="background-color: orange; float: left; margin-left: 10px; border-radius: 5px" onclick="openReset()">New Semester</button>
<form action="ResetAll.php" onsubmit="return deleteCheck()" method="post">
    <!--pass password to where form submits so it does not have to be reentered-->
    <input name="PSSWD" value="<?php echo $_POST["PSSWD"]; ?>" style="visibility: hidden; display: none;" type="text">
    <input type="submit" value="Reset All" style="background-color: orangered; float: left; margin-left: 10px; border-radius: 5px">
</form>
<!--invisible form to submit when going to previous tours in order to pass password-->
<form id="toPrev" action="getPreviousTours.php" method="post">
    <input type="password" value="<?php echo $_POST["PSSWD"];?>" name="PSSWD" readonly>
</form>
</body>
</html>