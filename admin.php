<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<style>
    body{
        background-color: hsl(235, 21%, 11%);
        font-family:  sans-serif;
        font-size:min(2vh,3vw);
    }
    .row1 {
        position: fixed;
        padding: 1vh;
        width:100%;
        background-color: black;
        z-index: 2;
    }
    table{
        background-color: hsl(235, 24%, 19%);
    }
    button{
        padding:1vh 1vw 1vh 1vw;
        font-weight:550;
        border: none;
    }
    button:hover{
        transform: scale(1.02);
    }
    table button{
        margin:3%;
        padding:0.8vh 1vw 0.8vh 1vw;
    }
    #list,.btn{
        font-size:min(2.7vh,3.5vw);
    }
</style>
<body>
    <div class="row1">
        <div style="float:left">
            <button id="login" onclick="home()" class="btn btn-primary" style="margin-left:2vw;float: right;margin-right: 3%;
            font-weight:550;"><i class="fa fa-home"></i></button>
        </div>
        <h2 style="text-align: center;">Movie List<h2>
    </div>
    <div style="padding-top: 15vh; padding-bottom: 10vh;">
    <div style="width:97vw; text-align: center;">
    <button onclick="change('add.php')" class="btn btn-primary" style="margin-right: 2vw; font-weight:550;">
        Add New Movie</button>
    <button onclick="change('file.php')" class="btn btn-primary" style="margin-left: 2vw; font-weight:550;">
        Add Multiple Movies</button>
    </div>
    <br><br>
    <table id ='list' class="center" style="text-align: center;">
    <tr style="background-color:#131720;">
        <th>Cover</th>
        <th>Title</th>
        <th>Action</th>
    </tr>
    </table>
    </div>
</body>
<?php
	$server = "localhost";
	$username = "root";
	$password = "";
    session_start();
    if(isset($_SESSION['user']) and $_SESSION['user']==10)
        $userID=$_SESSION['user'];
    else{
        header("Location: home.php");
    }
	$con = mysqli_connect($server, $username, $password);
	$sql="SELECT * FROM `movie`.`movielist`";
	$res=$con->query($sql);
	$img=array();
    $title=array();
    $id=array();
	while($row = $res->fetch_assoc()){
		array_push($img, $row['Image']);
        array_push($title, $row['Name']);
        array_push($id, $row['Sr no']);
	}
    for ($i = 0; $i < count($img); $i++){
        echo "
        <script type='text/javascript'>
            var table = document.getElementById('list');
            table.innerHTML+='\
            <tr>\
                <td><img src=$img[$i] width=70 height=100></td>\
                <td>$title[$i]</td>\
                <td><button id=$id[$i] onclick= myFunction1(this.id)>Edit</button><br>\
                <button id=$id[$i]  onclick= myFunction(this.id)>Delete</button></td>\
            </tr>';
        </script>";
    }
?>
<script type="text/javascript">
    function change(page){
        window.location.href = page;
    }
    function home(){
        window.location.href = 'home.php';
    }
    function myFunction(id) {
        if(confirm("Are you sure you want to delete this entry?")){
            var form = document.createElement("form");
            var element1 = document.createElement("input"); 
            form.method = "POST";
            element1.value=id;
            element1.name="ID";
            form.appendChild(element1);  
            document.body.appendChild(form);
            form.submit();
            document.body.removeChild(form);
        }
    }
    function myFunction1(id) {
        var form = document.createElement("form");
        var element1 = document.createElement("input"); 
        form.method = "POST";
        form.action= "http://localhost/WP/edit.php";
        element1.value=id;
        element1.name="ID";
        form.appendChild(element1);  
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
</script>
</html>
<?php
if ( 'POST' === $_SERVER['REQUEST_METHOD'] ){
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server, $username, $password);

    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    $id = $_POST["ID"];
    $sql1="DELETE FROM `movie`.`movielist` WHERE `movielist`.`Sr no` = $id;";
    if($con->query($sql1)){
        echo "
        <script type='text/javascript'>
            alert('Movie entry deleted successfully.');
            window.location.href = 'admin.php';
        </script>"; 
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>