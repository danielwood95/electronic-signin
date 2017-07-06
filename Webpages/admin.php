<!DOCTYPE HTML>
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

</style>
</head>
<body>
<span style="float: left; margin-left: 10px; margin-bottom:10px;"><a href="getPreviousTours.php">See Previous Tours</a></span>
<span style="float: right; margin-right: 10px; margin-bottom:10px;"><a href="layout.php">Tour Guide Sign In</a></span>
<h1>Admin Page</h1>
<div id="totals">
    <h2>Totals:</h2>
    <table>
            <col width="40%">
            <col width="20%">
            <col width="20%">
            <col width="20%">
            <tr>
                <th>Name</th>
                <th>Tours Given</th>
                <th>Minutes Late</th>
                <th>Absences</th>
            </tr>
            <?php
            require_once("DBConnect.php");
            $sql = "SELECT * FROM People";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Tours"]."</td>
                <td>".$row["Late"]."</td>
                <td>".$row["Absences"]."</td>
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
                <th>Date to give tour</th>
                <th>Tour Time</th>
                <th>Enter</th>
            </tr>
            <form id="add" action="AdminAddTourGuide.php">
                <tr>
                    <td><input type="text" name="Name" placeholder="Name" required></td>
                    <td><input type="text" name="Number" placeholder="Number" required></td>
                    <td><input type="date" name="Date" required></td>
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
</body>
</html>