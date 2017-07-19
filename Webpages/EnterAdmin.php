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
        input{
            height: 60px;
        }
        .reset{
            height: 20px;
        }
        .resetButton{
            height: 30px;
            background-color: transparent;
            border-color: white;
            border-radius: 5px;
            color: black;
        }
        .resetButton:hover{
            color: white;
        }
    </style>
</head>
<body>
<script type="text/javascript">
    function checkMatch() {
        if(document.forms["resetForm"]["NamePW"].value == document.forms["resetForm"]["ConfirmNewPW"].value){
            if(!confirm("Are You Sure You Want To Reset The Password?")){
                return false;
            }
        }else{
            alert("Passwords Do Not Match")
            return false;
        }
    }
    function openReset() {
        document.getElementById("resetpw").style.display = "block";
        document.getElementById("resetpw").style.visibility = "visible";
    }
    function closeReset() {
        document.getElementById('resetpw').style.display = "none";
        document.getElementById("resetpw").style.visibility = "hidden";
    }
</script>
<nav class="navbar navbar-inverse">
    <a class="navbar-brand" href="#"><span><img src="Princeton_shield.png" style="width: 25px; height: 30px; margin-top: -5px"> Admin Sign-in</span></a>
    <a class="navbar-brand" href="layout.php" style="float: right; margin-right: 10px;">Back To Tour Guide Sign In</a>
</nav>
<div class="container" style="background: rgba(170, 170, 170, 0.5);">
    <h1>Please Enter The Password To Continue To Admin Site</h1>
    <br>
    <form action="admin.php" method="post">
        <input type="password" name="PSSWD" placeholder="password" style="width:50%; font-size: larger" required>
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