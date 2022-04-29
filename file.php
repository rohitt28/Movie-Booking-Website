<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Movies</title>
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
        padding-top: 0.5vh;
        width:100%;
        background-color: black;
        z-index: 2;
    }
    input{
        cursor:pointer;
    }
    table{
        background-color: hsl(235, 24%, 19%);
        width: 75%;
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
        <h2 style="text-align: center;">Add Movies<h2>
    </div>
    <div style="padding-top: 15vh; padding-bottom: 10vh;">
    <div style="width:97vw; text-align: center;">
        <form id="add" method="POST">
        <input name="data" id="data" oninput="inpt()" type="file" accept=".xlsx,.xls" required>
        <button type=submit class="btn btn-primary">Submit</button>
        </form>
        <br><br>
        <h5>
            Insert a Excel File that contains data in the format given below:  
        </h5>
        <br><br>
        <table id ='list' class="center" style="text-align: center;">
        <tr style="background-color:#131720;">
            <th>Name</th>
            <th>Cast</th>
            <th>Image</th>
            <th>Genre</th>
            <th>Trailer</th>
            <th>Start</th>
            <th>End</th>
            <th>Duration</th>
            <th>Timing</th>
            <th>Amount</th>
        </tr>
        <tr>
            <td>name</td>
            <td>actor1, actor2, ...</td>
            <td>image_url</td>
            <td>genre1, genre2, ...</td>
            <td>embedded_youtube_url</td>
            <td>YYYY-MM-DD</td>
            <td>YYYY-MM-DD</td>
            <td>HH:MM</td>
            <td>10:15-01:15-04:15<br>(min 1)</td>
            <td>amount</td>
        </tr>
        </table>
    </div>
</div>
    
</body>
</html>
<script type='text/javascript'>
    var data11;
    var ExcelToJSON = function() {
        this.parseExcel = function(file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var data = e.target.result;
                var workbook = XLSX.read(data, {
                    type: 'binary'
                });
                workbook.SheetNames.forEach(function(sheetName) {
                var XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                var json_object = JSON.stringify(XL_row_object);
                console.log(JSON.parse(json_object));
                data11=JSON.parse(json_object);
                jQuery( '#xlx_json' ).val( json_object );
                })
            };
            reader.onerror = function(ex) {
                console.log(ex);
            };
            reader.readAsBinaryString(file);
        };
    };
    function inpt(){
        var fileInput = document.getElementById('data');
        var xl2json = new ExcelToJSON();
        if(fileInput.value){
            xl2json.parseExcel(fileInput.files[0]);
        }
    }
    $(function(){
		$('form').on('submit', function(event){
            event.preventDefault();
            var dbcols=["Name","Cast","Image","Genre","Trailer","Start","End",
                "Duration","Timing","Amount"];
            dbcols.sort();
            var cols=Object.keys(data11[0]);
            cols.sort();
            if(dbcols.length!=cols.length){
                alert("The files doesn't have reqiured number of columns.");
                return;
            }
            else{
                let flag=0;
                for(let i =0; i <dbcols.length;i++){
                    if(dbcols[i]!=cols[i]){
                        console.log(dbcols[i]);
                        console.log(cols[i]);
                        flag=1;
                    }
                }
                if(flag){
                    alert("Invalid Column names.");
                    return;
                }
            }
            var result = [];
            var brt="'";
            for(var i in data11)
                result.push(data11[i]['Name']);
            $(this).append("<input type='hidden' name='Name' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Cast']);
            $(this).append("<input type='hidden' name='Cast' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Image']);
            $(this).append("<input type='hidden' name='Image' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Genre']);
            $(this).append("<input type='hidden' name='Genre' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Trailer']);
            $(this).append("<input type='hidden' name='Trailer' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Start']);
            $(this).append("<input type='hidden' name='Start' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['End']);
            $(this).append("<input type='hidden' name='End' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Duration']);
            $(this).append("<input type='hidden' name='Duration' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Timing']);
            $(this).append("<input type='hidden' name='Timing' value="+brt+JSON.stringify(result)+brt+">");
            result = [];
            for(var i in data11)
                result.push(data11[i]['Amount']);
            $(this).append("<input type='hidden' name='Amount' value="+JSON.stringify(result)+">");
            this.submit();
        })
    })
</script>
<?php
function get_content($URL){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $URL);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if ( 'POST' === $_SERVER['REQUEST_METHOD'] and isset($_POST['Name'])){
    $server = "localhost";
    $username = "root";
    $password = "";
    $con = mysqli_connect($server, $username, $password);
    $name =test_input(json_decode($_POST['Name']));
    $cast =test_input(json_decode($_POST['Cast']));
    $genre =test_input(json_decode($_POST['Genre']));
    $img =test_input(json_decode($_POST['Image']));
    $dr =test_input(json_decode($_POST['Duration']));
    for($i =0;$i<count($dr);$i++){
        $dr[$i].=":00";
    }
    for($i=0; $i<count($img);$i++){
        $image = file_get_contents($img[$i]);
        $img[$i]= 'data:image/jpg;base64,'.base64_encode($image);
    }
    $start =test_input(json_decode($_POST['Start']));
    $trailer =test_input(json_decode($_POST['Trailer']));
    $end =test_input(json_decode($_POST['End']));
    $time=test_input(json_decode($_POST['Timing']));
    $amt =test_input(json_decode($_POST['Amount']));
    for($i =0;$i<count($name);$i++){
        $sql = "INSERT INTO `movie`.`movielist` (`Sr no`,`Name`,`Cast`, `Image`,
        `Genre`, `Trailer`, `Start`, `End` ,`Duration`, `Timing`, `Amount`)
        VALUES (NULL,'$name[$i]', '$cast[$i]', '$img[$i]', '$genre[$i]',
        '$trailer[$i]', '$start[$i]','$end[$i]','$dr[$i]','$time[$i]',
        '$amt[$i]');";
        $con->query($sql);
    }
    echo "
    <script type='text/javascript'>
        alert('Movie data added successfully.');
        window.location.href = 'admin.php';
    </script>"; 
}
?>