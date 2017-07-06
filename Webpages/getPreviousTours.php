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
            margin-top: 10px;
        }
        table, th, td {
            text-align: center;
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<script>
    function prev() {
        window.location.href = 'prev30tours.php';
    }
    function next() {
        window.location.href = 'next30tours.php';
    }
    function toCurrent(){
        window.location.href = 'setCurrentDay.php';
    }
</script>
<div id="tablediv">
    <span style="float: left; margin-left: 10px; margin-bottom:10px;"><a href="admin.php">Back to Admin Page</a></span>
    <button id="btn10" type="button" style="float: right; margin-right: 10px; margin-bottom:10px;" onclick="toCurrent()">Current Day</button>
    <form action="search.php">
        <input type="search" name="Search" required>
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
        function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

            $dates = array();
            $current = strtotime($first);
            $last = strtotime($last);

            while( $current <= $last ) {

                $dates[] = date($output_format, $current);
                $current = strtotime($step, $current);
            }

            return $dates;
        }
        $enddateFile = fopen("EDD", "r");
        $enddate = fgets($enddateFile);
        fclose($enddateFile);
        $startdate = date('Y-m-d', strtotime($enddate) - 30 * 86400);
        $dateArray = date_range($startdate, $enddate);
        echo "Displaying Tours ". $startdate. " Through " . $enddate;
        for($x = count($dateArray)-1; $x >= 0; $x--) {
            $sql = "SELECT * FROM SignedIn WHERE Date='".$dateArray[$x]."' AND Window='eleven'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $sn = "No";
                    if($row["Here"] == 'true'){
                        $sn = "Yes";
                    }
                    $gt = "No";
                    if($row["Tour"] == 'true'){
                        $gt = "Yes";
                    }
                    if(time()-strtotime($dateArray[$x]) < 0){
                        echo "<tr stlye='background-color: green;'>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>11:15</td>
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
            }
            $sql = "SELECT * FROM SignedIn WHERE Date='".$dateArray[$x]."' AND Window='one'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $sn = "No";
                    if($row["Here"] == 'true'){
                        $sn = "Yes";
                    }
                    $gt = "No";
                    if($row["Tour"] == 'true'){
                        $gt = "Yes";
                    }
                    if(time()-strtotime($dateArray[$x]) < 0){
                        echo "<tr stlye='background-color: green;'>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>1:00</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                    }else{
                        echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>1:00</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                    }
                }
            }
            $sql = "SELECT * FROM SignedIn WHERE Date='".$dateArray[$x]."' AND Window='three'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $sn = "No";
                    if($row["Here"] == 'true'){
                        $sn = "Yes";
                    }
                    $gt = "No";
                    if($row["Tour"] == 'true'){
                        $gt = "Yes";
                    }
                    if(time()-strtotime($dateArray[$x]) < 0){
                        echo "<tr stlye='background-color: green;'>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>3:30</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                    }else{
                        echo "<tr>
                <td>".$row["Name"]."</td>
                <td>".$row["Number"]."</td>
                <td>".$row["Date"]."</td>
                <td>3:30</td>
                <td>".$sn."</td>
                <td>".$gt."</td>
            </tr>";
                    }
                }
            }
        }
        ?>
    </table>
    <div style='float: left; width: 10%; margin-top: 10px; margin-bottom: 20px'>
        <button type="button" onclick="prev();" style="width: 100%;">Prev</button>
    </div>
    <div style='float: right; width: 10%; margin-top: 10px; margin-bottom: 20px'>
        <button type="button" onclick="next();" style="width: 100%;">Next</button>
    </div>
</div>
</body>
</html>