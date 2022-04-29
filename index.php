<?php
$server = "localhost";

$username = "root";

$password = "";

$con = mysqli_connect($server, $username, $password);

if(!$con){
    die("connection to this database failed due to" . mysqli_connect_error());
}
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$phone = $_POST['contact'];
$pass = $_POST['password'];
echo "Success connecting to the db $fname";

$sql = "INSERT INTO `movie`.`signup` (`Srno`,`fname`, `lname`, `Email`, `Contact`, `Password`, `Time`) VALUES (NULL,'$fname', '$lname', '$email', '$phone', '$pass', 'current_timestamp()');";

if ($con->query($sql) === TRUE) {
    header('Location: login.html');
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>