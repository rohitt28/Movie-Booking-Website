<?php 
session_start();
if(isset($_SESSION['user']))
    $userID=$_SESSION['user'];
else{
    header("Location: book.php");
}
$server = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($server, $username, $password);

if(!$con){
    die("connection to this database failed due to" . mysqli_connect_error());
}
$sql="SELECT * FROM `movie`.`bookings` WHERE `Cust ID` = '$userID'";
$res=$con->query($sql);
$title=array();
$title1=array();
$time=array();
$date=array();
$qty=array();
while($row = $res->fetch_assoc()){
	array_push($time, $row['Time']);
    array_push($title, $row['Movie ID']);
    array_push($date, $row['Date']);
    array_push($qty, $row['Seats']);
}
for($i =0; $i<count($title);$i++){
    $sql="SELECT * FROM `movie`.`movielist` WHERE `Sr no` ='$title[$i]'";
    $res=$con->query($sql);
    while($row = $res->fetch_assoc()){
        array_push($title1, $row['Name']);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<style>
    body {
        background-color: hsl(235, 21%, 11%);
    }
    .row {
        margin-left:12vw;
        margin-right:12vw;
        margin-top: 10vh;
        height: 380px;
    }
    h3 {
        margin-top: 5%;
        text-align: center;
        transition: transform .5s;
    }
    table{
        background-color:  hsl(235, 24%, 19%);
    }
</style>
<body>
    <div class="row1">
        <div style="float:left">
            <button id="login" onclick="home()" class="btn btn-primary" style="margin-left:2vw;float: right;margin-right: 3%;
            font-weight:550;"><i class="fa fa-home"></i></button>
        </div>
        <h2 style="text-align: center;">Booking History<h2>
    </div>
    <div style="padding-top:5%; padding-bottom: 5%;">
    <table id='list' class="center;" style="text-align: center;">
        <tr style="background-color:hsl(235, 21%, 11%);">
            <th>Date</th>
            <th>Time</th>
            <th>Title</th>
            <th>No of Seats</th>
        </tr>
        </table>
    </div>
</body>
<script type='text/JavaScript'>
    function home(){
        window.location.href = 'home.php';
    }
</script>
</html>
<?php
for ($i = 0; $i < count($time); $i++){
    $time[$i]=substr($time[$i],0,5);
    if($time[$i]=="10:15"){
        $time[$i].=" AM";
    }
    else{
        $time[$i].=" PM";
    }
    echo "
    <script type='text/javascript'>
        var table = document.getElementById('list');
        table.innerHTML+='\
        <tr>\
            <td>$date[$i]</td>\
            <td>$time[$i]</td>\
            <td>$title1[$i]</td>\
            <td>$qty[$i]</td>\
        </tr>';
    </script>";
}
?>