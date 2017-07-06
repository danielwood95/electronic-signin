<html>
<head>
    <style>
        body{
            text-align: center;
        }
        table{
            width: 100%;
            margin-left: auto;
            margin-right: auto;
        }
        table, th, td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<div id="tablediv">
    <span style="float: left; margin-left: 10px; margin-bottom:10px;"><a href="admin.php">Back to Admin Page</a></span>
    <form action="search.php">
        <input type="search" value="<?php echo $_GET["Search"]?>" name="Search" required>
        <input type="submit" value="search">
    </form>
    <table>
        <col width="30%">
        <col width="20%">
        <col width="15%">
        <col width="15%">
        <col width="10%">
        <col width="10%">
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Date</th>
            <th>Time</th>
            <th>Signed In</th>
            <th>Gave Tour</th>
        </tr>
        <?php
        require_once("DBConnect.php");
        $search = $_GET["Search"];
        $searchlower = strtolower($_GET["Search"]);
        $searchUF = ucfirst($_GET["Search"]);
        $searchDate = date("Y-m-d", strtotime($search));
        $sql = "SELECT * FROM SignedIn WHERE Name='".$search."' OR Number='".$search."' OR Date='".$search."' OR Name='".$searchlower."' OR Name='".$searchUF."' OR Date='".$searchDate."'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                // output data of each row
            while ($row = $result->fetch_assoc()) {
                $sn = "No";
                if($row["Here"] == 'true'){
                    $sn = "Yes";
                }
                $gt = "No";
                if($row["Tour"] == 'true'){
                    $gt = "Yes";
                }
                $time = "11:15";
                if($row["Window"] == 'one'){
                    $time = "1:00";
                }else if($row["Window"] == 'three'){
                    $time = "3:30";
                }
                if(time()-strtotime($dateArray[$x]) < 0){
                    echo "<tr stlye='background-color: green;'>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>".$time."</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                }else{
                    echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>11:15</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                }
            }
        }else{
            echo "</table>";
            echo "No Results";
        }
        ?>
    </table>
</div>
</body>
</html>