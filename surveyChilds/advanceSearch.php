<!doctype html>
<?php
try{
    $con=mysqli_connect("localhost","root","Rania@%123123","survey");
}catch(Exception $exception){
    echo "<h1>Erro Occured</h2>";
    exit();
}
session_start();
if(!isset($_SESSION['logged_in'])){
    header("location:../index.php");
}else {
    $logininfo = $_SESSION['logged_in'];
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Advance Search</title>
    <link href="../css/bootstrap.css" rel="stylesheet"/>
    <style>
        div.container-1100 {
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
            margin: 0px auto;
            max-width: 90.875em;
            padding: 0px 1em;
            font-size: 17pt;
        }

        div.container-1100::after {
            clear: both;
            content: " ";
            display: table;
            line-height: 0;
        }

        div.container-1100::before {
            content: " ";
            display: table;
            line-height: 0;
        }
        section#hero {
            background-image: linear-gradient(#3491dd, #2d6898);
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
            margin:auto;
            text-align: center;
            color:white;
            font-size:18pt;
            padding-top:20px;
            padding-botton:20px;
        }
        body {
            font-family:"Roboto", sans-serif;
        }
        .label{
            padding:10px;font-size:18px;
            color:#111;

        }
        .copy-text button{
            padding:5px;
            background:#5674f5;
            color:#fff;
            font-size:14px;
            border:none;
            outline:none;
            border-raduis:5px;
            cursor:pointer;

        }
        .copy-text button:active{
            background:#809ce2;
        }
        .copy-text :before{
            content:"Copied";
            position:absolute;
            top:50px;
            right:0px;
            background:#5c81dc;
            padding:8px 10px;
            border-raduis:20px;
            font-size:15px;
            display:none;
        }
        .copy-text button:after{
            content:"";
            position:absolute;
            top:-20px;
            right:25px;
            width:10px;
            height:10px;
            background:#5c81dc;
            transform:rotate(45deg);
        }
        .copy-text.active button:before,
        copy-text.active button:after{
            display:block;
        }
    </style>
    <script>
        function triggerExample(idFul) {
            const element = document.querySelector(idFul);
            element.select();
            element.setSelectionRange(0, 99999);
            document.execCommand('copy');
            element.classList.remove();
        }
        function change_ben_initial(){
            window.location.assign("surveySystem.php?initializeBen");
        }
    </script>
</head>
<body>

<section id="hero" class="pb-4">
    <div class="hero_text">
        <h1>Beneficiary Database</h1>
        <div class="row">
            <div class="mx-auto col-10 col-md-8 col-lg-6">
                <form action="advanceSearch.php" class="form-inline" type="POST">
                    <input type="text" required name="ben_information" class="form-control form-inline d-inline float-left" placeholder="Enter Ben Information"/>
                    <select name="option">
                        <option value="1">Name</option>
                        <option value="2">Father Name</option>
                        <option value="3">Guzar</option>
                    </select>
                    <button class="btn-primary" type="submit">Search</button>
                </form>
            </div>
        </div>
        <a href="surveyPage.php" class="btn-primary" style="text-decoration: none;">Simple Search</a>
    </div>
    <div class="search">
    </div>
</section>
<?php
if(isset($_GET['ben_information'])){
    $option=$_GET['option'];
    $hh=$_GET['ben_information'];
    switch($option){
        case 1:$type='ben_name';break;
        case 2: $type='ben_fathername'; break;
    }
    if($option==1) {
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
LEFT join criteria ON beninfo.ben_id=criteria.criteria_id WHERE ben_name like '%$hh%' and nahia=12";
    }else if($option==2){
            $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
LEFT join criteria ON beninfo.ben_id=criteria.criteria_id WHERE ben_fathername like '%$hh%' and nahia=12";
    }else if($option==3){
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
LEFT join criteria ON beninfo.ben_id=criteria.criteria_id WHERE Guzar=$hh and nahia=12";
    }
    $result2=$con->query($sql);
if($result2->num_rows>0){
    ?>
    <div class="container">
        <table class="table-bordered table table-hover table-response">
            <tr>
                <td>Name</td>
                <td>Father Name</td>
                <td>Tazkira</td>
                <td>Phone</td>
                <td></td>
            </tr>
            <?php
            while($row=$result2->fetch_assoc()){
            ?>
            <tr>
                <td><?php  echo $row['ben_name']  ?></td>
                <td><?php  echo $row['ben_fathername']  ?></td>
                <td><?php  echo $row['ben_tazkira']  ?></td>
                <td><?php  echo $row['ben_phone']  ?></td>
                <td><a href="surveyPage.php?advance=<?php  echo $row['ben_id']  ?>">Go To</a></td>
            </tr>
            <?php
            } ?>
        </table>
    </div>


<?php
}
}
?>
</body>
</html>

