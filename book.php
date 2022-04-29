<?php
    session_start();
    if(isset($_SESSION['user']))
        $userID=$_SESSION['user'];
    else{
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<style>
    form{
        width:100%;
    }
    .row{
        margin:2vw;
        margin-left:5vw;
    }
    .row1{
        padding: 2vh;
        background-color: black;
    }
    .search{
        margin-left: 20%;
        padding-left: 2%;
        border-radius: 5px;
    }
    .dropdown-menu:hover{
        cursor:pointer;
    }
    #col1{
        cursor:pointer;
        transition: transform .2s;
    }
    #col1:hover >img{
        transform: scale(1.04);
    }
    #data{
        width: 80%;
        height:100%;
        float: left;
    }
    #data >*{
        margin:2vw;
    }
    form{
        color: white;
    }
    body input, body button, select{
        color:black;
    }
</style>
<body>
    <div class="row1">
    <div style="float:left">
        <button id="login" onclick="home()" class="btn btn-primary" style="margin-left:2vw;float: right;margin-right: 3%;
        font-weight:550;"><i class="fa fa-home"></i></button>
    </div>
    <div>
        <input id="search"class="search" type="text" oninput="search()" onclick="search()" placeholder="Search a movie" style="height: 7vh; 
            color:black; font-size: medium; width:40vw"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <div class="dropdown-menu" id="searchopt" style="width:40vw" aria-labelledby="dropdownMenuButton">
                
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 " id="col1">
            <a data-toggle="modal" 
            data-target="#myModal"></a>
            <img data-toggle="modal" id="poster" 
            data-target="#myModal" style="width: 100%;" >
        </div>
        <div class="col-md-9 " id="data">
            
        </div>
    </div>
    <div class="row" style="text-align:center">
        <form method="post">
            <label>Date: </label>
            <input id="date" name='date' type="date">
            <label>Time: </label>
            <select id='opt' name='time'>

            </select><br><br>
            <label>Qty: </label>
            <input oninput="myFunction()" id ="qty" name='qty' type="number" value="1" 
            min="1" max="10" maxlength="10" step="1"> Amt: <b id ="demo">
            </b><br><br>
            <button class="btn btn-primary">Book</button>
        </form>
    </div>
    <div class="modal1">
        <div class="modal fade" id="myModal" role="dialog" style="width: 90vw; margin-left:0%">
            <div class="modal-dialog" style="margin:0%; padding:0%;">
                <div class="modal-content" style="margin-left:10vw;margin-top:10vh;">
                    <div class="modal-body"  style="background-color: black;width: 80vw; height: 80vh;">
                        <iframe width="100%" id="youtube" height="100%" src="" title="YouTube video player" frameborder="0" 
                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</body>
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
    $opts=$info['Timing'];
    $opts=explode ("-", $opts); 
    for($i=0; $i<count($opts);$i++){
        if($opts[$i]=="10:15"){
            $opts[$i].=" AM";
        }
        else{
            $opts[$i].=" PM";
        }
    }
    $sql1="SELECT * FROM `movie`.`movielist`";
	$res1=$con->query($sql1);
    $names=array();
    $id1=array();
    date_default_timezone_set('Asia/Kolkata');
    $date=date('Y-m-d');
    while($row = $res1->fetch_assoc()){
        if($row['Start']<=$date and $row['End']>=$date){
            array_push($id1, $row['Sr no']);
            array_push($names, $row['Name']);
        }
	}
    echo "
    <script type='text/javascript'>
        document.getElementById('youtube').setAttribute('src','$info[Trailer]');
        document.getElementById('poster').setAttribute('src','$info[Image]');
        document.getElementById('data').innerHTML='\
        <h2>$info[Name]</h2>\
            <h5>Duration: $time</h5>\
            <p>\
                Genre: $info[Genre]<br>\
                Cast: $info[Cast]\
            </p>\
        <br><br>';
        document.getElementById('date').setAttribute('min','$date');
        document.getElementById('date').setAttribute('max','$info[End]');
    </script>";
    for($i=0; $i<count($opts);$i++){
        echo "
        <script type='text/javascript'>
        document.getElementById('opt').innerHTML+='\
            <option>$opts[$i]</option>';
        </script>";
    }
    if(isset($_POST['id'])){
        $id =$_POST['id'];
        $user=$_SESSION['user'];
        $date=$_POST['date'];
        $qty=$_POST['qty'];
        $time=$_POST['time'];
        $sql = "INSERT INTO `movie`.`bookings` (`Sr no`, `Movie ID`, `Cust ID`, `Date`, `Time`, `Seats`) 
        VALUES (NULL,'$id', '$user', '$date', '$time','$qty');";
        if ($con->query($sql) === TRUE) {
            echo "
            <script type='text/javascript'>
                alert('Ticket Booked.');
                window.location.href = 'home.php';
            </script>";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
else{
    echo "
    <script type='text/javascript'>
    window.location.href = 'home.php';
    </script>";
}
?>
<script type="text/javascript">
    document.getElementById("searchopt").style.display = "none";
    var cost=parseInt(<?php echo $info['Amount'];?>);
    document.getElementById('demo').innerText=cost;
    var names =[<?php echo '"'.implode('","', $names).'"' ?>];
    var ids =[<?php echo '"'.implode('","', $id1).'"' ?>];
    function myFunction() {
        var qty = document.getElementById('qty').value;
        if(qty>10){
            qty-=(qty%10);
            qty/=10;
        }
        document.getElementById("qty").value = qty;
        document.getElementById("demo").innerText = qty*cost;
    }
    $('.modal').on('hide.bs.modal', function() {
        var memory = $(this).html();
        $(this).html(memory);
    });
    $(function(){
		$('form').on('submit', function(event){
            event.preventDefault();
            $(this).append('<input type="hidden" name="id" value='+<?php echo $id;?>+'>');
            this.submit();
		});
	});
    function book(id) {
        var form = document.createElement("form");
        var element1 = document.createElement("input"); 
        form.method = "POST";
        form.action= "book.php";
        element1.value=id;
        element1.name="ID";
        form.appendChild(element1);  
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
    function search(){
        var val=document.getElementById("search").value.toLowerCase();
        document.getElementById("searchopt").style.display = "none";
        document.getElementById("searchopt").innerHTML="";
        for(let i =0;i <names.length;i++){
            if(names[i].toLowerCase().includes(val) && val!=""){
                document.getElementById("searchopt").innerHTML+="\
                <a class='dropdown-item' onclick='book("+ids[i]+")'>\
                "+names[i]+"</a>";
                document.getElementById("searchopt").style.display = "block";
            }
        }
    }
    function home(){
        window.location.href = 'home.php';
    }
    window.onclick = function(event) {
        if (!event.target.matches('.searchopt')) {
            document.getElementById("searchopt").style.display = "none";
        }
    }
</script>
</html>
