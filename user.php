<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<style>
    body {
        width: 100vw;
        height:100vh;
        font-family:  sans-serif;
        color:white;
        background-color: hsl(235, 21%, 11%);
    }
    .col{
        width: 100%;
        padding-top:3%;
        height:auto;
        margin-top: 10vh;
        box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        background-color: hsl(235, 24%, 19%);
        border-radius: 5vh;
    }
    .row{
        margin-left:10vw;
        margin-right:10vw;
    }
    .row1{
        padding: 0.1vh;
        background-color: black;
        margin-right: 0;
    }
    input{
        border: 0.1px solid #D3D3D3;
        border-radius: 18px;
        margin-top: 1.2vh;
        padding: 1.5vh;
        font-size: 16px;
        width:90%;
        color:white;
        background-color: hsl(235, 24%, 19%);
    }
    input::placeholder{
        color:#D3D3D3;
    }
    form >*{
        margin-left: 5%;
    }
    .sub{
        width:100%;
    }
    .sub >button{
        border-radius:12px;
        padding:2vh 2vw 2vh 2vw;
    }
    .sub >button:hover{
        transform: translate(0, -1px);
    }
    h3{
        font-size: 25px;
        font-weight: 600;
    }
</style>
<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server, $username, $password);
    session_start();
    if(isset($_SESSION['user']))
        $userID=$_SESSION['user'];
    else{
        header("Location: home.php");
    }
    $sql1="SELECT * FROM `movie`.`signup` WHERE `Srno` = '$userID'";
    $info='';
    $res=$con->query($sql1);
    $info=$res->fetch_assoc();
?>
<body>
    <div class="row1" style="padding-top:1%">
    <div style="float:left">
        <button id="login" onclick="home()" class="btn btn-primary" style="margin-left:2vw;float: right;margin-right: 3%;
        font-weight:550;"><i class="fa fa-home"></i></button>
    </div>
        <h2 style="text-align: center;">Account Details<h2>
    </div>
    <div class ="row" style="height:80%;">
    <div class="col-lg-6 col-sm-12">
        <div class="col">
            <h3 style="text-align: center;">Profile Details</h3><br>
            <form method = 'post'>
                <div style="position: relative; float: left; width: 45%;">
                    <label>First Name:</label><br>
                    <input name="fname" id="fname" type="text" ; placeholder="Rohit"><br><br>
                    <label>Email:</label><br>
                    <input name="email" id="email" type="email" ; placeholder="abc@gmail.com"><br><br>
                </div>
                <div style="position: relative;float: left; width: 45%;">
                    <label>Last Name:</label><br>
                    <input name="lname" id="lname" type="text" ; placeholder="Tawde"><br><br>
                    <label>Contact:</label><br>
                    <input name="contact" id="contact" type ="tel" ; placeholder="7021846923"><br><br>
                </div>
                <div class="sub" style="text-align:center; margin-left:0;">
                    <button type=submit class="btn btn-primary"  
                    style="margin-bottom:5vh">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-6 col-sm-12">
    <div class="col">
        <h3 style="text-align: center;">Change Password</h3><br>
        <form class="pass" method = 'post'>
            <label>Old Password:</label><br>
            <input style="margin-top: 2%; width:40%";
            id="oldpass" type="password" required><br><br>
            <div style="position: relative; float: left; width: 45%;">
                <label>New Password:</label><br>
                <input name='pass' id="newpass" type="password" ; required><br><br>
            </div>
            <div style="position: relative; float: left; width: 45%;">
                <label>Confirm new Password:</label><br>
                <input id="confirmpass" type="password" ; required><br><br>
            </div>
            <div class="sub" style="text-align:center;margin-left:0;">
                <button type=submit class="btn btn-primary" 
                style="margin-bottom:5vh">Save Changes</button>
            </div>
        </form>
    </div>
    </div>
</body>
<script type='text/JavaScript'>
    document.getElementById('fname').placeholder="<?php echo $info['fname'];?>";
    document.getElementById('lname').placeholder="<?php echo $info['lname'];?>";
    document.getElementById('email').placeholder="<?php echo $info['Email'];?>";
    document.getElementById('contact').placeholder="<?php echo $info['Contact'];?>";
    
    $(function(){
		$('.pass').on('submit', function(event){
            event.preventDefault();
            var oldPass="<?php echo $info['Password'];?>";
            if(document.getElementById('oldpass').value!=oldPass){
                alert("Incorrect Current password.");
            }
            else if(document.getElementById('newpass').value !=
                        document.getElementById('confirmpass').value){
                alert("New passwords and confirm password should be same.")
            }
            else{
                this.submit();
            }
        });
    });
    function home(){
        window.location.href = 'home.php';
    }
</script>
</html>
<?php
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
	if ( 'POST' === $_SERVER['REQUEST_METHOD'] ){
		$server = "localhost";
		$username = "root";
		$password = "";
		$con = mysqli_connect($server, $username, $password);
        $flag =0;
        if(isset($_POST['fname'])){
            $upd=test_input($_POST['fname']);
            if(strlen($upd)!=0){
                $sql="UPDATE `movie`.`signup` SET `fname` = '$upd' WHERE `signup`.`Srno` = '$userID';";
                if($con->query($sql))
                $flag=1;
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        if(isset($_POST['lname'])){
            $upd=test_input($_POST['lname']);
            if(strlen($upd)!=0){
                $sql="UPDATE `movie`.`signup` SET `lname` = '$upd' WHERE `signup`.`Srno` = '$userID';";
                if($con->query($sql))
                $flag=1;
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        if(isset($_POST['email'])){
            $upd=test_input($_POST['email']);
            if(strlen($upd)!=0){
                $sql="UPDATE `movie`.`signup` SET `email` = '$upd' WHERE `signup`.`Srno` = '$userID';";
                if($con->query($sql))
                $flag=1;
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        if(isset($_POST['contact'])){
            $upd=test_input($_POST['contact']);
            if(strlen($upd)!=0){
                $sql="UPDATE `movie`.`signup` SET `Contact` = '$upd' WHERE `signup`.`Srno` = '$userID';";
                if($con->query($sql))
                $flag=1;
                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
        if(isset($_POST['pass'])){
            $upd=test_input($_POST['pass']);
            $sql="UPDATE `movie`.`signup` SET `Password` = '$upd' WHERE `signup`.`Srno` = '$userID';";
            if($con->query($sql))
            $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if($flag){
            echo "
            <script type='text/javascript'>
                alert('User info updated successfully.');
                window.location.href = 'home.php';
            </script>"; 
        }
        if(!$con){
			die("connection to this database failed due to" . mysqli_connect_error());
		}
		
	}
?>