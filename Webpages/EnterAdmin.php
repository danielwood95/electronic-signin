<head>
    <title>Admin Sign-in</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .page-bg {
            background: url('princeton.png') no-repeat;
            background-size: 100% 100%;
            filter: blur(4px);
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: -1;
        }
        .btn-primary{
            border-color: ff8f00;
            background-color: transparent;
            border-radius: 5px;
        }
        .btn-primary:hover{
            color: black;
            background-color: transparent;
            border-color: ff8f00;
        }
        body{
            text-align: center;
        }
        #resetpw{
            width:50%;
            height:330px;
            margin-top:100px;
            background-color:rgba(255,255,255,0.8);
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
            /*border: solid lightgray;*/
        }
        input{
            height: 30px;
        }
        .reset{
            height: 20px;
        }
        .resetButton{
            height: 30px;
            background-color: ff8f00;
            border-color: gray;
            border-radius: 5px;
            color: white;
        }
        .resetButton:hover{
            color: black;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    function checkMatch() {
        var newpw = document.forms["resetForm"]["NewPW"].value;
        if(newpw == document.forms["resetForm"]["ConfirmNewPW"].value){
            if(newpw.length >= 8 && newpw.match(/[A-Z]/) && newpw.match(/\d/)){
                if(!confirm("Are You Sure You Want To Reset The Password?")){
                    return false;
                }
            }else{
                if(newpw.length < 8){
                    alert("New password is too short. Passwords must be at least 8 characters.");
                }else if(!newpw.match(/[A-z]/)){
                    alert("New password does not contain a letter. Passwords must contain at least one letter and one capital letter.");
                }else if(!newpw.match(/[A-Z]/)){
                    alert("New password does not contain a capital letter. Passwords must contain at least one capital letter.");
                }else if(!newpw.match(/\d/)){
                    alert("New password does not contain a number. Passwords must contain at least one number.");
                }
                return false;
            }

        }else{
            alert("Passwords do not match")
            return false;
        }
    }
    function openReset() {
        document.getElementById("resetpw").style.display = "block";
        document.getElementById("resetpw").style.visibility = "visible";
        document.getElementById('containerDiv').style.filter = "blur(4px)";
    }
    function closeReset() {
        document.getElementById('resetpw').style.display = "none";
        document.getElementById("resetpw").style.visibility = "hidden";
        document.getElementById('containerDiv').style.filter = "none";
    }
</script>
<nav class="navbar navbar-inverse">
    <a class="navbar-brand" href="#"><span><img src="Princeton_shield.png" style="width: 25px; height: 30px; margin-top: -5px; margin-right: 10px">Admin Sign-in</span></a>
    <a class="navbar-brand" href="index.php" style="float: right; margin-right: 10px;">Back To Tour Guide Sign In</a>
</nav>
<div class="container" id="containerDiv" style="background: rgba(170, 170, 170, 0.5);">
    <h1>Please Enter The Password To Continue To Admin Site</h1>
    <br>
    <form action="admin.php" method="post">
        <input type="password" name="PSSWD" placeholder=" password" style="width:50%; font-size: larger" required>
        <input type="submit" value="Enter" class="btn-primary" style="width: 10%;">
    </form>
    <button onclick="openReset()" class="btn-primary">Reset Password</button>
    <br><br>
</div>
<div id="resetpw">
    <h1>Reset Password</h1>
    <form onsubmit="return checkMatch()" id="resetForm" method="post" action="resetPW.php">
        Old Password:<br>
        <input type="password" name="OldPW" required class="reset"><br>
        New Password:<br>
        <input type="password" name="NewPW" required class="reset"><br>
        Re-Enter New Password:<br>
        <input type="password" name="ConfirmNewPW" required class="reset"><br><br>
        <input type="submit" value="Change" class="resetButton">
    </form>
    <button onclick="closeReset()" class="resetButton">Cancel</button>
</div>
<div class="page-bg">
</div>
</body>
</html>