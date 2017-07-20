<head>
    <?php
    date_default_timezone_set("America/New_York");
    require_once("DBConnect.php");
    $dateFile = fopen("CurrentDate", "r");
    $CD = fgets($dateFile);
    fclose($dateFile);
    if($CD != date("Y-m-d")){
        $sql = "SELECT Name From SignedIn WHERE Date='".$CD."' AND Here='false'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $sql2 = "UPDATE People SET Absences=Absences+1 WHERE Name='".strtolower($row["Name"])."'";
                if ($conn->query($sql2) === TRUE) {
                    $dateFileWrite = fopen("CurrentDate", "w");
                    fwrite($dateFileWrite, date("Y-m-d"));
                    fclose($dateFileWrite);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }else{
            $dateFileWrite = fopen("CurrentDate", "w");
            fwrite($dateFileWrite, date("Y-m-d"));
            fclose($dateFileWrite);
        }
    }
    ?>
    <title>Orange Key Sign-in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .page-bg {
            background: url('nasssauhall2.jpg') no-repeat;
            background-size: 100% 100%;
            filter: blur(4px);
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        #subDiv{
            width:50%;
            height:400px;
            margin-top:100px;
            background-color: ff8f00;
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
        #addTourDiv{
            width:50%;
            height:330px;
            margin-top:100px;
            background-color: ff8f00;
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
        #btn10{
            float: right;
            background-color: transparent;
        }
        .btn-primary:hover{
            color: black;
        }
        .btn-primary:disabled:hover{
            color: gray;
        }
        .btn-primary:disabled{
            color: gray;
        }
        .backImg{
            width:20px;
            height: 20px;
            border:none;
            background-color: transparent;
            margin-right: 20px;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    function signIn(nom) {
        window.location.href = 'signin.php?Name='+nom;
    }

    function giveTour(nom) {
        window.location.href = 'startTour.php?TourGuide='+nom;
    }

    function next() {
        window.location.href = 'nextSession.php';
    }
    function prev() {
        window.location.href = 'prevSession.php';
    }
    function substitute(toReplace) {
        document.forms["subForm"]["TourGuide"].value = toReplace;
        document.getElementById('subDiv').style.display = "block";
        document.getElementById('subDiv').style.visibility = "visible"
    }
    function openAdd() {
        if(confirm("You Are Creating An Additional Tour Guide Are Your Sure You Are Not Supposed To Substitute?")){
            document.getElementById("addTourDiv").style.display = "block";
            document.getElementById("addTourDiv").style.visibility = "visible";
        }
    }
    function validateAdd(){
        var signedIn = document.getElementById("here").innerHTML;
        var sub = document.forms["addTourDiv"]["TourGuide"].value.toLowerCase();
        if(signedIn.indexOf(("\n".concat(sub, "\n")))!=-1){
            if(confirm("You Are Already Giving A Tour In This Time Block Are You Sure You Would Like To Give Another?")){
                document.getElementById('addTourDiv').style.display = "none";
            }else{
                return false;
            }
        }else{
            document.getElementById('addTourDiv').style.display = "none";
        }
    }
    function closeAdd() {
        document.getElementById('addTourDiv').style.display = "none";
    }
    function validate(){
        var signedIn = document.getElementById("here").innerHTML;
        var sub = document.forms["subForm"]["Substitute"].value.toLowerCase();
        if(signedIn.indexOf(("\n".concat(sub, "\n")))!=-1){
            if(confirm("You Are Already Giving A Tour In This Time Block Are You Sure You Would Like To Give Another?")){
                document.getElementById('subDiv').style.display = "none";
            }else{
                return false;
            }
        }else{
            document.getElementById('subDiv').style.display = "none";
        }
    }
    function hideSubView(){
        document.getElementById('subDiv').style.display = "none";
    }
    function undo(nom, did){
        window.location.href = 'undo.php?TourGuide=' + nom+"&Did="+did;
    }

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
    $(function() {
        $("#NumberAdd").attr('maxlength', '12');
        $("#NumberAdd").on('keyup', function() {
            var inp = $("#NumberAdd").val();
            var n = inp.indexOf("-");
            if ((inp.length == 3) || (inp.length == 7)) {
                $('#NumberAdd').val(inp + '-');
            }
            else {

            }
        });
    });

</script>
<nav class="navbar navbar-inverse">
    <a class="navbar-brand" href="#"><span><img src="Princeton_shield.png" style="width: 25px; height: 30px; margin-top: -5px; margin-right: 10px">Orange Key Electronic Sign-in</span></a>
    <a href="EnterAdmin.php" style="float: right; margin-right: 10px; margin-top: 10px"><img src="gear.jpg" style="width: 30px; height: 30px;"></a>
</nav>
<div class="container" style="background: rgba(170, 170, 170, 0.5);">
    <div id="panels">
        <div style="margin-left: 10px">
            <?php
            date_default_timezone_set("America/New_York");
            $timeFile = fopen("currentTourWindow", "r");
            $ct = fgets($timeFile);
            fclose($timeFile);
            $timeToDisplay = "11:15 Tour";
            if($ct == "one"){
                $timeToDisplay = "1:00 Tour";
            }else if($ct == "three"){
                $timeToDisplay = "3:30 Tour";
            }
            echo "<h2>".date("l, F d")." ".$timeToDisplay." <button id=\"btn10\" type=\"button\" class=\"btn btn-primary\" style=\"margin-left: 10px; margin-bottom:10px; border-color: ff8f00;\" onclick=\"openAdd()\"><b>Additional Guide +</b></button></h2>";
            ?>
        </div>
    <br>
    <?php
    require_once("DBConnect.php");
    date_default_timezone_set("America/New_York");
    $timeFile = fopen("currentTourWindow", "r");
    $currentWindow = fgets($timeFile);
    $sql = "SELECT * FROM SignedIn 
    WHERE Date='".date("Y-m-d")."' AND Window='".$currentWindow."'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["Here"] == 'false'){
                echo "<div id=\"pnl1\" class='panel panel-default' style='height: 60px'>
            <div style='float: left; width: 55%; margin-top: 10px'>
                <h4 style='margin-left: 20px'>".$row["Name"]."  ".$row["Number"]."</h4>
            </div>
            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn1\" type=\"button\" class=\"btn btn-primary\" onclick=\"signIn('".$row["Name"]."');\" style='background-color: ff8f00;'>Sign in</button>
            </div>

            <div style='float:left; width:15%; margin-top: 10px;'>
                <button id=\"btn2\" type=\"button\" class=\"btn btn-primary\" disabled='true' style='background-color: ff8f00;'>Give tour</button>
            </div>

            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn3\" type=\"button\" style='background-color: ff8f00;' class=\"btn btn-primary\" onclick=\"substitute('".$row["Name"]."');\">Substitute</button>
            </div>
        </div>";
            }else{
                if($row["Tour"] == 'false'){
                    echo "<div id=\"pnl1\" class='panel panel-default' style='height: 60px; background: palegreen;'>
            <div style='float: left; width: 55%; margin-top: 10px'>
                 <h4 style='margin-left: 20px'><button class='backImg' onclick='undo(\"".$row["Name"]."\", \"Here\")'><img class='backImg' src='backarrow.png'></button>".$row["Name"]."  ".$row["Number"]."</h4>
            </div>

            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn1\" type=\"button\" class=\"btn btn-primary\" style='background-color: ff8f00;' disabled='true'>Signed in</button>
            </div>

            <div style='float:left; width:15%; margin-top: 10px;'>
                <button id=\"btn2\" type=\"button\" class=\"btn btn-primary\" style='background-color: ff8f00;' onclick='giveTour(\"" . $row["Name"] . "\");'>Give tour</button>
            </div>

            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn3\" type=\"button\" class=\"btn btn-primary\" disabled='true' style='visibility: hidden;'>Substitute</button>
            </div>
        </div>";
                }else{
                    echo "<div id=\"pnl1\" class='panel panel-default' style='height: 60px; background: palegreen;'>
            <div style='float: left; width: 55%; margin-top: 10px'>
                 <h4 style='margin-left: 20px'><button class='backImg' onclick='undo(\"".$row["Name"]."\", \"Tour\")'><img class='backImg' src='backarrow.png'></button>".$row["Name"]."  ".$row["Number"]."</h4>
            </div>

            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn1\" type=\"button\" class=\"btn btn-primary\" disabled='true' style='background-color: ff8f00;'>Signed in</button>
            </div>

            <div style='float:left; width:15%; margin-top: 10px;'>
                <button id=\"btn2\" type=\"button\" class=\"btn btn-primary\" disabled='true', style='background-color: transparent; color: ff8f00; border-color: gray;' >Gave tour</button>
            </div>

            <div style='float: left; width: 15%; margin-top: 10px;'>
                <button id=\"btn3\" type=\"button\" class=\"btn btn-primary\" disabled='true' style='visibility: hidden;'>Substitute</button>
            </div>
        </div>";
                }
            }

        }
    }
    fclose($timeFile);

    ?>
    </div>
    <div style='float: left; width: 10%; margin-top: 10px; margin-bottom: 20px'>
        <button type="button" class="btn btn-primary" onclick="prev();" style="width: 100%; background-color: transparent; border-color: ff8f00;"><b>Prev Tour</b></button>
    </div>
    <div style='float: right; width: 10%; margin-top: 10px; margin-bottom: 20px'>
        <button type="button" class="btn btn-primary" onclick="next();" style="width: 100%; background-color: transparent; border-color: ff8f00;"><b>Next Tour</b></button>
    </div>
</div>
<div id="subDiv">
    <h1>Substitute Form</h1>
    <form id="subForm" action="substitute.php" method="get" onsubmit="return validate();">
        Original Tour Guide:<br>
        <input type="text" value="tour guide" name="TourGuide" readonly required><br><br>
        Substitute Tour Guide(Full Name):<br>
        <input type="text" placeholder="Name" name="Substitute" required>
        <br><br>
        Substitute's Phone Number:<br>
        <input id="Number" type="text" placeholder="Phone Number" name="Number" required>
        <br><br>
        <input type="submit" value="Submit" class="btn btn-primary" style="background-color: transparent; border-color: white;">
    </form>
    <button type="button" class="btn btn-primary" onclick="hideSubView();" style="background-color: transparent; border-color: white;">Cancel</button>
</div>
<div id="addTourDiv">
    <h1>Add Tour Guide Form</h1>
    <form id="addForm" action="additionalTourGuide.php" method="get" onsubmit="return validateAdd()">
        Full Name:<br>
        <input type="text" placeholder="Name" name="TourGuide" required>
        <br><br>
        Phone Number:<br>
        <input id="NumberAdd" type="text" placeholder="Phone Number" name="Number" required>
        <br><br>
        <input type="submit" value="Submit" class="btn btn-primary" style="background-color: transparent; border-color: white;">
    </form>
    <button onclick="closeAdd();" type="button" class="btn btn-primary" style="background-color: transparent; border-color: white;">Cancel</button>
</div>
<span id="here" style="color: transparent">
<?php
date_default_timezone_set("America/New_York");
$timeFile = fopen("currentTourWindow", "r");
$currentWindow = fgets($timeFile);
fclose($timeFile);
$sql = "SELECT Name FROM SignedIn 
    WHERE Date='".date("Y-m-d")."' AND Window='".$currentWindow."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "\n".strtolower($row["Name"])."\n";
    }
}
?>
</span>
<div class="page-bg">
</div>
</body>
</html>