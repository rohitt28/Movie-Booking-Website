<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');

.wrapper{
	width: min(600px,90vw);
	border-radius: 15px;
	box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
	background-color: hsl(235, 24%, 19%);
}
.wrapper form .field{
	height: min(9vh,60px);
	width: 100%;
	margin-top: 20px;
	width: 90%;
	margin-left: 2.5%;
	margin-right: 2.5%;
}
form .signup-link{
	left:min(40vw,60px);
	color: #262626;
	margin-top: 20px;
}
</style>
<?php
	$server = "localhost";
	$username = "root";
	$password = "";
	$con = mysqli_connect($server, $username, $password);
	$sql1="SELECT `Email` FROM `movie`.`signup`";
	$res=$con->query($sql1);
	$result=array();
	while($row = $res->fetch_assoc()){
		array_push($result, $row['Email']);
	}
?>
<body>
	<div class="wrapper">
		<div class="title">
		   	Register
		</div>
		<form class='register' method='post' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<div class="row">
			<div class="col-md-6 col-sm-12">
				<div class="field">
					<input type="text" name="fname" required autocomplete="off"/>
					<label>First Name</label>
				</div>
			</div>
			<div class="col-md-6 col-sm-12">
				<div class="field">
					<input type="text" name="lname" required autocomplete="off"/>
					<label>Last Name</label>
				</div>
			</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="field">
						<input id="email" type="email" name="email" required autocomplete="off"/>
						<label>Email</label>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="field">
						<input id="contact" type="text" name="contact" required autocomplete="off"/>
						<label>Contact no</label>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-12">
					<div class="field">
						<input id="pass1" type="password" name="password" required />
						<label>Password</label>
					</div>
				</div>
				<div class="col-md-6 col-sm-12">
					<div class="field">
						<input id="pass2" type="password" required />
						<label>Confirm Password</label>
					</div>
				</div>
			</div>
			<div class="field" style="width: 70%; margin-left: 15%;">
				<input type="submit" value="Signup" />
			</div>
			<div class="signup-link">
				<p> Already have an account?  <a href="login.php">Login</a></p>
			</div>
		</form>
	</div>
</body>
</html>
<script type="text/javascript">
	var k =[<?php echo '"'.implode('","', $result).'"' ?>];
	$(function(){
		$('.register').on('submit', function(event){
			var flag =0;
			event.preventDefault();
			var con=document.getElementById('contact').value;
			for(let i =0; i <con.length;i++){
				if(con[i]>'9' || con[i]<'0'){
					flag=1;
				}
			}
			for(let i =0; i <k.length;i++){
				if(k[i]==document.getElementById('email').value){
					flag=2;
				}
			}
			if(document.getElementById('pass1').value!=
					document.getElementById('pass2').value){
				alert('Both passwords should be identical.');
			}
			if(document.getElementById('pass1').value.length<6){
				alert('Password Should have atleast 6 characters.');
			}
			else if(con.length!=10 || flag==1){
				alert('Invalid phone number.');
			}
			else if(flag==2){
				alert("Account already exists.")
			}
			else{
				this.submit();
			}
		});
	});
</script>
<?php
	if ( 'POST' === $_SERVER['REQUEST_METHOD'] ){
		$server = "localhost";
		$username = "root";
		$password = "";
		$con = mysqli_connect($server, $username, $password);

		if(!$con){
			die("connection to this database failed due to" . mysqli_connect_error());
		}
		$fname = test_input($_POST['fname']);
		$lname = test_input($_POST['lname']);
		$email = test_input($_POST['email']);
		$phone = test_input($_POST['contact']);
		$pass = test_input($_POST['password']);
		date_default_timezone_set('Asia/Kolkata');
		$date=date('Y-m-d');

		$sql = "INSERT INTO `movie`.`signup` (`Srno`,`fname`, `lname`, `Email`, `Contact`, `Password`, `Date`) VALUES (NULL,'$fname', '$lname', '$email', '$phone', '$pass', '$date');";
		if ($con->query($sql) === TRUE) {
			header('Location: login.php');
		} 
		else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
?>
