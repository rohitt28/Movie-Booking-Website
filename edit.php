<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>add</title>
</head>
<style>
    body{
        width: 98vw;
        height:100vh;
        margin: 0px;
        font-family:  sans-serif;
        color:white;
        background-color: hsl(235, 21%, 11%);
        color: #d3d3d3;
    }
    .col{
        position: relative;
        width: 100%;
        float: left;
        height: 98%;
        margin-top: 3%;
        box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
        background-color: hsl(235, 24%, 19%);
        border-radius: 5vh;
        margin-bottom:5vh;
    }
    .row1{
        padding: 0.1vh;
        background-color: black;
        margin-right: 0;
    }
    label{
        font-size:2.4vh;
    }
    input{
        width: 60%;
        border: 0.1px solid white;
        border-radius: 18px;
        margin-top: 5%;
        padding: 1.5vh;
        color:white;
        background-color: hsl(235, 24%, 19%);
    }
    input[type=checkbox],input[type=time]{
        width: auto;
    }
    input:hover{
        cursor: pointer;
    }
    input[type=text]:hover{
        cursor: text;
    }
    form >*{
        margin-left: 5%;
    }
    .sub{
        width:100%;
    }
    .sub >button{
        border-radius:12px;
        padding:1.5vh 2vw 1.5vh 2vw;
    }
    .sub >button:hover{
        transform: translate(0, -1px);
    }
</style>
<body>
    <div class="row1">
    <h2 style="text-align: center;">Edit Movie</h2>
    </div>
    <div class ="row" id="wrap" style="height:auto; margin-left:20vw; margin-right:20vw;">
        <div class="col">
            <form id="add" method = 'post' enctype="multipart/form-data" >
            <div class ="row" >
                <div class="col-lg-6 col-sm-12">
                    <label>Name:</label>
                    <input id="name"name="Name"type="text">
                    <br><br>

                    <label>Cast: </label>
                    <input id="cast" name="Cast" type="text">
                    </br></br>

                    <label>Image: </label>
                    <input name="Image" id="img1" style="width:20vw" type="file" >
                    <br><br>

                    Show Schedule:<br>
                    <label>Start Date: </label>
                    <input id='start' name="Start" type="date" oninput=funct(this.id)><br>
                    <label>End Date: </label>
                    <input id='end'name="End" type="date" oninput=funct(this.id)>
                    <br><br>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label>Genre: </label>
                    <input id="genre" name="Genre" type="text">
                    </br></br>

                    <label>Duration: </label>
                    <input id="time" name="Duration" type="time">
                    <br><br>

                    <label>Trailer link: </label>
                    <input id="trailer" name="Trailer" type="text">
                    <br><br>

                    <label>Timings: </label><br>
                    <div class ="row" >
                        <div class="col-lg-6 col-sm-12" style="text-align:center;">
                            <input id="time0" type="checkbox">
                            <label>10:15 AM</label>
                        </div>
                        <div class="col-lg-6 col-sm-12" style="text-align:center;">
                        <input id="time1" type="checkbox">
                        <label>01:15 PM</label><br>
                        </div>
                    </div>
                    <div class ="row" >
                        <div class="col-lg-6 col-sm-12" style="text-align:center;">
                        <input id="time2" type="checkbox">
                        <label>04:15 PM</label>
                        </div>
                        <div class="col-lg-6 col-sm-12" style="text-align:center;">
                        <input id="time3" type="checkbox">
                        <label>07:15 PM</label>
                        </div>
                    </div>
                    <label>Amount: </label>
                    <input id="amt" name="Amount" type="number" value=0 step=50 min=0>
                    <br><br>
                </div>
                <div class="sub" style="text-align:center;">
                    <button type=submit class="btn btn-primary"  style="margin-bottom:5vh">Update Details</button>
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(function(){
		$('#add').on('submit', function(event){
            event.preventDefault();
            var fileInput = document.getElementById('img1');
            var flag =0;
            if(fileInput.value){
                var reader = new FileReader();
                reader.readAsDataURL(fileInput.files[0]);
                flag=1;
            }
            var form1 =this;
            var str="";
            if(document.getElementById('time0').checked){
                if(str!="")str+='-';
                str+='10:15';
            }
            if(document.getElementById('time1').checked){
                if(str!="")str+='-';
                str+='01:15';
            }
            if(document.getElementById('time2').checked){
                if(str!="")str+='-';
                str+='04:15';
            }
            if(document.getElementById('time3').checked){
                if(str!="")str+='-';
                str+='07:15';
            }
            var k = document.getElementById('add').getAttribute('name');
            $(form1).append('<input type="hidden" name="id" value='+k+'>');
            $(form1).append('<input id="if" type="hidden" name="alltime" value='+str+'>');
            if(flag)
            reader.onload = function () {
                $(form1).append('<input type="hidden" name="image" value='+reader.result+'>');
                form1.submit();
            };
            else
            form1.submit();
		});
	});
    function funct(id){
        var val=document.getElementById(id).value;
        if(val){
            if(id=='start'){
                document.getElementById('end').setAttribute('min',val);
            }
            if(id=='end'){
                document.getElementById('start').setAttribute('max',val);
            }
        }
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
    $id =$_POST['ID'];
    $sql="SELECT * FROM `movie`.`movielist` WHERE `Sr no` = '$id'";
    $res=$con->query($sql);
    $info=$res->fetch_assoc();
    $time=$info['Duration'];
    $time=substr($time,0,5);
    echo "
    <script type='text/javascript'>
        document.getElementById('add').setAttribute('name',$id);
        document.getElementById('name').placeholder='$info[Name]';
        document.getElementById('genre').placeholder='$info[Genre]';
        document.getElementById('trailer').placeholder='$info[Trailer]';
        document.getElementById('cast').placeholder='$info[Cast]';
        document.getElementById('time').value='$time';
        document.getElementById('amt').value=$info[Amount];
        document.getElementById('start').value='$info[Start]';
        document.getElementById('end').value='$info[End]';
        document.getElementById('start').setAttribute('min','$info[Start]');
        document.getElementById('end').setAttribute('min','$info[Start]');
    </script>';";
    if(isset($_POST['id'])){
        $id = $_POST['id'];
        $flag=0;
        if(isset($_POST['Name']) and $_POST['Name']!=""){
            $upd =$_POST['Name'];
            $sql="UPDATE `movie`.`movielist` SET `Name` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Cast']) and $_POST['Cast']!=""){
            $upd =$_POST['Cast'];
            $sql="UPDATE `movie`.`movielist` SET `Cast` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Genre']) and $_POST['Genre']!=""){
            $upd =$_POST['Genre'];
            $sql="UPDATE `movie`.`movielist` SET `Genre` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['image']) and $_POST['image']!=""){
            $upd =$_POST['image'];
            $sql="UPDATE `movie`.`movielist` SET `Image` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Duration']) and $_POST['Duration']!=""){
            $upd =$_POST['Duration'];
            $upd.=":00";
            $sql="UPDATE `movie`.`movielist` SET `Duration` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Start']) and $_POST['Start']!=""){
            $upd =$_POST['Start'];
            $sql="UPDATE `movie`.`movielist` SET `Start` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Start']) and $_POST['Start']!=""){
            $upd =$_POST['Start'];
            $sql="UPDATE `movie`.`movielist` SET `Start` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['End']) and $_POST['End']!=""){
            $upd =$_POST['End'];
            $sql="UPDATE `movie`.`movielist` SET `End` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['trailer']) and $_POST['trailer']!=""){
            $upd =$_POST['trailer'];
            $sql="UPDATE `movie`.`movielist` SET `Trailer` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['alltime']) and $_POST['alltime']!=""){
            $upd =$_POST['alltime'];
            $sql="UPDATE `movie`.`movielist` SET `Timing` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        if(isset($_POST['Amount']) and $_POST['Amount']!=""){
            $upd =$_POST['Amount'];
            $sql="UPDATE `movie`.`movielist` SET `Amount` = '$upd' WHERE `Sr no` = '$id';";
            if($con->query($sql))
                $flag=1;
            else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        echo "
        <script type='text/javascript'>
        alert('Movie info updated.');
        window.location.href = 'admin.php';
        </script>";
    }
}
else{
    echo "<script type='text/javascript'>
    window.location.href = 'admin.php';
    </script>";
}
?>
