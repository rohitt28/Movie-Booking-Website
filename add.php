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
<?php
session_start();
if(isset($_SESSION['user']) and $_SESSION['user']==10)
    $userID=$_SESSION['user'];
else{
    header("Location: home.php");
}
?>
<style>
    body {
        width: 100vw;
        height:100vh;
        margin: 0px;
        font-family:  sans-serif;
        font-size:2.3vh;
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
        padding:1vh 2vw 1vh 2vw;
    }
    .sub >button:hover{
        transform: translate(0, -1px);
    }
    
</style>
<body>
    <div class="row1">
    <h2 style="text-align: center;">Add New Movie</h2>
    </div>
    <div class ="row" id="wrap"style="height:auto; margin-left:20vw; margin-right:20vw;">
        <div class="col">
            <form class="add" id="add" method = 'post' action='add.php' enctype="multipart/form-data" >
            <div class ="row" >
                <div class="col-lg-6 col-sm-12">
                    <label>Name:</label>
                    <input name="Name"type="text" required>
                    </br></br>

                    <label>Cast: </label>
                    <input name="Cast" type="text" required>
                    </br></br>

                    <label>Image: </label>
                    <input name="Image" id="img1" type="file" style="width:20vw" required>
                    <br><br>

                    <label>Show Schedule: </label><br>
                    <label>Start Date: </label>
                    <input id='start' name="Start" type="date" oninput=funct(this.id) required><br>
                    <label>End Date: </label>
                    <input id='end'name="End" type="date" oninput=funct(this.id) required>
                    <br><br>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <label>Genre: </label>
                    <input name="Genre" type="text" required>
                    </br></br>

                    <label>Duration: </label>
                    <input name="Duration" type="time" required>
                    <br><br>

                    <label>Trailer link: </label>
                    <input name="Trailer" type="text" required>
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
                    <input name="Amount" type="number" value=0 step=50 min=0>
                    <br><br>
                    </div>
                <div class="sub" style="text-align:center;">
                    <button type=submit class="btn btn-primary"  style="margin-bottom:5vh">Add Movie</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>
<script>
    var today = new Date();
    today.setDate(today.getDate() + 1);
    var dd = today.getDate();
    var mm = today.getMonth()+1; 
    var yyyy = today.getFullYear();
    if(dd<10){
        dd='0'+dd;
    } 
    if(mm<10){
        mm='0'+mm;
    }
    var date=yyyy+'-'+mm+'-'+dd;
    document.getElementById('start').setAttribute('min',date);
    document.getElementById('end').setAttribute('min',date);
    $(function(){
		$('.add').on('submit', function(event){
            event.preventDefault();
            var fileInput = document.getElementById('img1');
            var reader = new FileReader();
            reader.readAsDataURL(fileInput.files[0]);
            var form1 =this;
            var flag=0;
            var str="";
            if(document.getElementById('time0').checked){
                if(str!="")str+='-';
                str+='10:15';
            }
            else{
                flag++;
            }
            if(document.getElementById('time1').checked){
                if(str!="")str+='-';
                str+='01:15';
            }
            else{
                flag++;
            }
            if(document.getElementById('time2').checked){
                if(str!="")str+='-';
                str+='04:15';
            }
            else{
                flag++;
            }
            if(document.getElementById('time3').checked){
                if(str!="")str+='-';
                str+='07:15';
            }
            else{
                flag++;
            }
            if(flag==4){
                alert("Atleast 1 show time should be selected.");
                return;
            }
            $(form1).append('<input id="if" type="hidden" name="alltime" value='+str+'>');
            reader.onload = function () {
                $(form1).append('<input type="hidden" name="image" value='+reader.result+'>');
                form1.submit();
            };
		});
	});
    function funct(id){
        var val=document.getElementById(id).value;
        if(val>=date){
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
    $name =$_POST['Name'];
    $cast =$_POST['Cast'];
    $genre =$_POST['Genre'];
    $img =$_POST['image'];
    $dr =$_POST['Duration'];
    $dr.=":00";
    $start =$_POST['Start'];
    $trailer =$_POST['Trailer'];
    $end =$_POST['End'];
    $time=$_POST['alltime'];
    $amt =$_POST['Amount'];
    $sql = "INSERT INTO `movie`.`movielist` (`Sr no`,`Name`,`Cast`, `Image`, `Genre`, `Trailer`, `Start`, `End` ,`Duration`, `Timing`, `Amount`) VALUES (NULL,'$name', 
    '$cast', '$img', '$genre', '$trailer', '$start','$end','$dr','$time','$amt');";
    $con->query($sql);
    echo '<script type="text/JavaScript">
        alert("Movie data added.");
        window.location.href = "admin.php";;
    </script>';
}
?>
