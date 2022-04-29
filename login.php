<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="login.css">
</head>
<style>
	@import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
</style>
<body>
	<div class="wrapper">
		<div class="title">
			Login
		</div>
		<form method = 'post' action='login.php'>
			<div class="field">
				<input id="email" type="email" name= "email" required/>
				<label>Email</label>
			</div>
			<div class="field">
				<input id="pass" type="password" name = "password" required />
				<label>Password</label>
			</div>
            <div class="field">
                <div style="width:10%; float:left">
                    <input type="checkbox" style="width: min(5vw,3vh); height:min(5vw,2.7vh);" name="remember" value="yes">
                </div>
                <div style="width:80%; float:left">
                    <p>Remember me</p>
                </div>
			</div>
			<div class="field">
				<input type="submit" value="Login" />
			</div>
			<div class="signup-link">
				<p> Don't have an account?  <a href="register.php">Sign Up</a></p>
			</div>
		</form>
	</div>
</body>
</html>
<?php
session_start();
if(isset($_SESSION['user'])){
    echo '<script type="text/JavaScript"> 
        window.location.href = "home.php";
    </script>';
}
if ( 'POST' === $_SERVER['REQUEST_METHOD'] ){
    $server = "localhost";
    $username = "root";
    $password = "";

    $con = mysqli_connect($server, $username, $password);

    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $rem="";
    if(isset($_POST['remember'])){
        $rem=$_POST['remember'];
    }
    $sql="SELECT * FROM `movie`.`signup` WHERE `Email` = '$email' AND `Password` = '$pass'";
    $result=$con->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['user'] = $row['Srno'];
        if($rem=="yes"){
            $cookie_name = "email";
            $cookie_value = $email;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30));
            $cookie_name = "pass";
            $cookie_value = $pass;
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30));
        }
        if($row['Srno']==10){
            echo '<script type="text/JavaScript"> 
            window.location.href = "admin.php";
            </script>';
        }
        else{
            echo '<script type="text/JavaScript"> 
            window.location.href = "home.php";
            </script>';
        }
    }
    else{
        echo '<script type="text/JavaScript"> 
            alert("Invalid user credentials.");
            </script>';
    }
}
if(isset($_COOKIE["email"])){
    $email = $_COOKIE["email"];
    $pass = $_COOKIE["pass"];
    echo "<script type='text/javascript'>
        document.getElementById('email').value='$email';
        document.getElementById('pass').value='$pass';
    </script>";
}
?>