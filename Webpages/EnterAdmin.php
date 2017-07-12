<html>
<head>
    <style>
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
            border: solid gray;
            border-radius: 10px;
        }
        input[type=submit]{
            border: solid green;
        }
        button{
            border: solid red;
            border-radius: 10px;
        }
    </style>
</head>
<body>
<script>
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
<a href="layout.php" style="float: left; margin-left: 10px; margin-bottom:10px;">Back To Check In</a>
<br>
<div>
    <h1 style="margin-top: 50px;">Please Enter The Password To Enter The Admin Site</h1>
    <br>
    <form action="admin.php" method="post">
        <input type="password" name="PSSWD" placeholder="password" style="width:50%; font-size: larger" required>
        <input type="submit" value="Enter" style="width: 10%">
    </form>
</div>
<br>
<button onclick="openReset()">Reset Password</button>
<div id="resetpw">
    <h1>Reset Password</h1>
    <form onsubmit="return checkMatch()" id="resetForm" method="post" action="resetPW.php">
        Old Password:<br>
        <input type="password" name="OldPW" required><br>
        New Password:<br>
        <input type="password" name="NewPW" required><br>
        Re-Enter New Password:<br>
        <input type="password" name="ConfirmNewPW" required><br><br>
        <input type="submit" value="change">
    </form>
    <button onclick="closeReset()">Cancel</button>
</div>
</body>
</html>