<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
</head>
<style>
    .container{
        padding:0%;
        margin:0%;
        height:100%;
    }
    .container #btn1 {
        position: absolute;
        top: 60%;
        left: 20%;
        right: 20%;
        background-color: #FAF9F6;
        color: #151F30;
        font-size: min(2.5vh,4.5vw);
        font-weight: 550;
        padding: 12px 8px;
        border-width: 1px;
        cursor: pointer;
        border-radius: 5px;
    }
    .container #btn2 {
        position: absolute;
        top: 30%;
        left: 20%;
        right: 20%;
        background-color: #FAF9F6;
        color: #151F30;
        font-size:  min(2.5vh,4.5vw);
        font-weight: 550;
        padding: 12px 8px;
        border-width: 1px;
        cursor: pointer;
        border-radius: 5px;
    }
    .btn3 {
        display: none;
    }
    .btn3:hover {
        transform: translate(0, -2px);
    }
    .dropdown-menu:hover{
        cursor:pointer;
    }
    .container >img{
        border: 1px solid grey;
    }
    .container:hover >*, .container:active >*{
        display: block;
    }
    .container:hover >img, .container:active >img{
        filter: blur(3px);
        transform: scale(1.03);
    }
    .row{
        margin-top: 10vh;
        height: min(70vh,500px);
        width:100%;
    }
    .row h2{
        padding-left: 8%;
    }
    .row1{
        position: fixed;
        padding: 2.5vh;
        width:100%;
        background-color: black;
        z-index: 2;
    }
    img{
        border-radius: 5%;
        transition: transform .5s;
    } 
    h3{
        margin-top: 5%;
        text-align: center;
        transition: transform .5s;
    }
    button{
        cursor: pointer;
        border-radius: 5px;
    }
    .search{
        padding-left: 2%;
        border-radius: 5px;
        height:7vh;
    }
    .carousel-item{
        padding-left: 10%;
        padding-right: 10%;
    }
    .carousel{
        padding: 0%;
        width:100%;
        height:80%;
    }
    .modal1{
        padding:0%;
        margin:0%;
        width:100vw;
        text-align:center;
    }
    .srch{
        
    }
    @media only screen and (max-width: 1200px) {
        .col{
            width:33%;
        }
    }
    @media only screen and (max-width: 600px) {
        .col{
            width:50%;
        }
    }
    @media only screen and (max-width: 400px) {
        .col{
            width:100%;
        }
    }
    @media only screen and (min-height: 1000px) {
        .search{
            height:5vh;
        }
    }
</style>
<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server, $username, $password);
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    $sql1="SELECT * FROM `movie`.`movielist`";
	$res=$con->query($sql1);
	$image1=array();
    $image2=array();
    $names=array();
    $id1=array();
    $id2=array();
    $trailer1=array();
    $trailer2=array();
    session_start();
    date_default_timezone_set('Asia/Kolkata');
	$date=date('Y-m-d');
	while($row = $res->fetch_assoc()){
        if($row['Start']<=$date and $row['End']>=$date){
            array_push($image1, $row['Image']);
            array_push($id1, $row['Sr no']);
            array_push($names, $row['Name']);
            array_push($trailer1, $row['Trailer']);
        }
        else if($row['Start']>$date){
            array_push($image2, $row['Image']);
            array_push($id2, $row['Sr no']);
            array_push($trailer2, $row['Trailer']);
        }
	}
    if(count($_COOKIE) > 0){
        '<script type="text/JavaScript">
        console.log("iii");
            
        </script>';
    }
?>
<body>
    <div class="row1">
        <div id="srch" style="float:left; text-align:right; width:60vw;">
            <input id="search"class="search" type="text" oninput="search()" onclick="search()" placeholder="Search a movie" style="color:black; 
            font-size: medium; width:40vw"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="dropdown-menu" id="searchopt" style="width:40vw" aria-labelledby="dropdownMenuButton">

            </div>
        </div>
        <div style="float:right">
            <button id="login" onclick="change()" class="btn btn-primary" style="float: right;margin-right: 3%;
            font-weight:550;">Login</button>
        </div>
        <div id="user" class="dropdown1" style="float:right;">
            <img class="dropbtn1" src="img/profile.png" width=80% >
            <div class="dropdown-content1">
                <a href="user.php">Account Details</a>
                <a id="bookings" href="booking.php">My bookings</a>
                <a onclick="logout()" style="cursor: pointer;">Logout</a>
            </div>
        </div>
    </div>
    <br><br>
    <div class="row" style="margin-left:0%;">
        <h2 class="w-100">Now Showing</h2>
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol id="indicator" class="carousel-indicators">
                
            </ol>
            <div id="now" class="carousel-inner">
                <div id="activenow" class="carousel-item active">
                    
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <div class="row" style="margin-left:0%;">
        <h2 class="w-100">Coming Soon</h2>
        <div id="carouselExampleIndicators1" class="carousel slide" data-ride="carousel">
            <ol id="indicator1" class="carousel-indicators">
                
            </ol>
            <div id="nowi" class="carousel-inner">
                <div id="activenowi" class="carousel-item active">
                    
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
    <div class="modal1">
        <div class="modal fade" id="myModal" role="dialog" style="width: 90vw; margin-left:0%">
            <div class="modal-dialog" style="margin:0%; padding:0%;">
                <div class="modal-content" style="margin-left:10vw;margin-top:10vh;">
                    <div class="modal-body" id="modalbody"  style="background-color: black;width: 80vw; height: 80vh;">
                        <iframe width="100%" id="youtube" height="100%" src="" title="YouTube video player" frameborder="0" 
                        allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>    
    </div>      
</body>
<script type="text/javascript">  
    document.getElementById("user").style.display = "none";
    document.getElementById("searchopt").style.display = "none";
    document.getElementById("login").style.display = "block";
    window.addEventListener('resize', function(event){
        setdata();
        trsize();
    });
    trsize();
    setdata();
    var names =[<?php echo '"'.implode('","', $names).'"' ?>];
    var ids =[<?php echo '"'.implode('","', $id1).'"' ?>];
    function setdata(){
        var allid =[<?php echo '"'.implode('","', $id1).'"' ?>];
        var img =[<?php echo '"'.implode('","', $image1).'"' ?>];
        var trailers =[<?php echo '"'.implode('","', $trailer1).'"' ?>];
        var ii=0;
        var size=4;
        if(screen.width<400){
            size=1;
        }
        else if(screen.width<600){
            size=2;
        }
        else if(screen.width<1200){
            size=3;
        }
        document.getElementById('indicator').innerHTML="\
        <li data-target='#carouselExampleIndicators' data-slide-to='now0' class='active'></li>";
        document.getElementById('now').innerHTML="\
        <div id='activenow' class='carousel-item active'>\
        </div>";
        document.getElementById('indicator1').innerHTML="\
        <li data-target='#carouselExampleIndicators' data-slide-to='nowi0' class='active'></li>";
        document.getElementById('nowi').innerHTML="\
        <div id='activenowi' class='carousel-item active'>\
        </div>";
        for(let i =0; i <Math.ceil(allid.length/size);i++){
            var str;
            if(i>0){
            str="now"+i; 
            document.getElementById('indicator').innerHTML+='\
            <li data-target="#carouselExampleIndicators"\
            data-slide-to="'+str+'"></li>';
            
            document.getElementById('now').innerHTML+="\
            <div id="+str+" class='carousel-item'>\
            </div>";
            }
            else{
                str="activenow";
            }
            for(let j=0; j<size;j++){
                if(ii>=allid.length)break;
                    document.getElementById(str).innerHTML+='\
                    <div class="col">\
                        <div class="container">\
                            <img src='+img[(i*size)+j]+' width=95% height=100%>\
                            <button onclick="book('+allid[(i*size)+j]+')" id="btn1" class="btn3">Book Now</button>\
                            <button id="btn2" data-toggle="modal"\
                                data-target="#myModal" onclick="settrailer(`'+String(trailers[(i*size)+j])+'`)" class="btn3" >Watch Trailer</button>\
                        </div>\
                    </div>';
                    ii++;
            }
        }
        allid =[<?php echo '"'.implode('","', $id2).'"' ?>];
        img =[<?php echo '"'.implode('","', $image2).'"' ?>];
        trailers =[<?php echo '"'.implode('","', $trailer2).'"' ?>];
        var ii=0;
        for(let i =0; i <Math.ceil(allid.length/size);i++){
            var str;
            if(i>0){
                str="nowi"+i; 
                document.getElementById('indicator1').innerHTML+='\
                <li data-target="#carouselExampleIndicators"\
                data-slide-to="'+str+'"></li>';
                document.getElementById('nowi').innerHTML+="\
                <div id="+str+" class='carousel-item'>\
                </div>";
            }
            else{
                str='activenowi';
            }
            for(let j=0; j<size;j++){
                if(ii>=allid.length)break;
                document.getElementById(str).innerHTML+='\
                    <div class="col">\
                        <div class="container">\
                            <img src='+img[(i*size)+j]+' width=95% height=100%>\
                            <button id="btn2" style="top:50%;" data-toggle="modal"\
                                data-target="#myModal" onclick="settrailer(`'+String(trailers[(i*size)+j])+'`)" class="btn3" >Watch Trailer</button>\
                        </div>\
                    </div>';
                
                ii++;
            }
        }
    }
    function trsize(){
        document.getElementById("modalbody").style.height="80vh";
        if(screen.width<800){
            document.getElementById("modalbody").style.height="100vw";
        }
    }
    function myFunction(){
        document.getElementById("myDropdown").classList.toggle("show");
    }
    function change(){
        window.location.href = 'login.php';
    }
    function logout(){
        var form = document.createElement("form");
        var element1 = document.createElement("input"); 
        form.method = "POST";
        form.action= "home.php";
        element1.value='0';
        element1.name="ID";
        form.appendChild(element1);  
        document.body.appendChild(form);
        form.submit();
        document.body.removeChild(form);
    }
    function settrailer(lnk){
        document.getElementById("youtube").setAttribute('src',lnk);
    }
    $('.modal').on('hide.bs.modal', function() {
        var memory = $(this).html();
        $(this).html(memory);
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
    window.onclick = function(event) {
        if (!event.target.matches('.searchopt')) {
            document.getElementById("searchopt").style.display = "none";
        }
    }
</script>
</html>
<?php
if(isset($_POST['ID'])){
    unset($_SESSION['user']);
}
if(isset($_SESSION['user'])){
    if($_SESSION['user']==10){
        echo "
        <script type='text/javascript'>
        document.getElementById('bookings').href = 'admin.php';
        document.getElementById('bookings').innerHTML = 'Movie List';
    </script>";
    }
    echo "
    <script type='text/javascript'>
    document.getElementById('user').style.display = 'block';
    document.getElementById('login').style.display = 'none';
    </script>";
}
?>