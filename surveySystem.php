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
    header("location:index.php");
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
    <title>Survey System</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
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
        <p>Survey System</p>
    </div>
    <div class="search">
    </div>
</section>
<?php
$sql="SELECT hh FROM beninfo WHERE status='not_biometric' and nahia=22";
$result=$con->query($sql);

$hhs=array();
$i=0;
if($result->num_rows>0){
    echo   $result->num_rows;
while($row=$result->fetch_assoc()){
    $hhs[$i]=$row['hh'];
    $i++;
}
    if(!isset($_SESSION['ben'])){
        $randhh = array_rand($hhs);
        $_SESSION['ben']=$randhh;
    }
}
if(isset($_GET['changeBen'])) {
    $randhh = array_rand($hhs);
    $hh=$_GET['changeBen'];
    $sql="UPDATE beninfo SET status='biometric' WHERE hh=$hh";
    $result=$con->query($sql);
    $sqlHousehold="SELECT * from beninfo where hh=$hh";
    $resultHousehold=$con->query($sqlHousehold);
    $rowHousehold=$resultHousehold->fetch_assoc();
    $benid=$rowHousehold['ben_id'];
    $date=date('d-m-y');
    $sqlScoper="INSERT INTO scoped (ben_id,scope,date) VALUES ('$benid','$logininfo','$date')";
    $resultScoper=$con->query($sqlScoper);

    $_SESSION['ben']=$randhh;
    header("location:surveySystem.php");
}
if(isset($_GET['ignoreBen'])){
    $randhh = array_rand($hhs);
    $hh=$_GET['ignoreBen'];
    $sql="UPDATE beninfo SET status='ignored' WHERE hh=$hh";
    $result=$con->query($sql);
    $_SESSION['ben']=$randhh;
    header("location:surveySystem.php");

}
if(isset($_SESSION['ben'])) {
    $randhh = $_SESSION['ben'];
}
$sql="SELECT * from beninfo INNER JOIN cfacinfo on beninfo.CFAC_id=cfacinfo.CFAC_Id
inner join surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
inner join criteria where beninfo.ben_id=criteria.criteria_id and hh=$randhh;";
$result2=$con->query($sql);

if($result2->num_rows>0){
    $id="id".rand(1,10000);
    $row=$result2->fetch_assoc();
?>
<button class="btn-primary" onclick="change_ben(<?php echo $randhh ;?>)">Received</button>
<script>
    function change_ben(randNumber){
        window.location.assign("surveySystem.php?changeBen="+randNumber);
    }
    function ignore_ben(randNumber){
        window.location.assign("surveySystem.php?ignoreBen="+randNumber);
    }
</script>
<button class="btn-primary" onclick="ignore_ben(<?php echo $randhh ;?>)">Ignore</button>

<div class="">
    <table class="table table-hover" style="font-size: 9pt;border:2px black solid;">
        <tr style="border:2px black solid;">
            <td style="border:2px black solid;width:10px;">1</td>
            <td style="border:2px black solid;">2</td>
            <td style="border:2px black solid;">3</td>
            <td style="border:2px black solid;">4</td>
            <td style="border:2px black solid;" >5</td>
            <td style="border:2px black solid;">6</td>
            <td style="border:2px black solid;">7</td>
            <td style="border:2px black solid;">8</td>
            <td style="border:2px black solid;">9</td>
            <td style="border:2px black solid;">10</td>
            <td style="border:2px black solid;">11</td>
            <td style="border:2px black solid;">12</td>
            <td style="border:2px black solid;">13</td>
            <td style="border:2px black solid;">Count</td>
        </tr>
        <tr>
            <td style="border:2px black solid;"><?php echo $row['A1'] ==1 ? "Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A2']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A3']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A4']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A5']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A6']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A7']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A8']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A9']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A10']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A11']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A12']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['A13']==1?"Y":"N";?></td>
            <td style="border:2px black solid;"><?php echo $row['count'];?></td>

        </tr>
    </table>
</div>
<div class="container" style="">
    <?php
    $columns = array("hh_ful","Guzar","child_5","plw","ben_gender","ben_name","ben_fathername","ben_tazkira",
        "ben_age","ben_phone");
    $fulColumns=array("household","Guzar","Childres","PLW","Gender","Name","F/name","Tazkira","Age","Phone");
    $i=0;
    foreach($columns as  $column){
        ?>
        <div class="row">
            <div class="col-3 mr-2" >
                <p style="font-size:19pt"><?php echo $fulColumns[$i++] ?>:   </p>
            </div>
            <div class="">
                <?php
                if($column=='ben_gender'){
                ?>
                    <input type="text" style="font-size:17pt;width:295px" id="<?php echo $column;  ?>" disabled class="test float-center" value="<?php echo $row[$column]==1?"Male":"Female";  ?>">
                    <button onclick="triggerExample(<?php echo "'#".$column."'";?>);" style="font-size:19pt" class="btn-primary text-center">
                        copy
                    </button>
                <?php
                }else if($column=='plw'){
                ?>
                <input type="text" style="font-size:17pt;width:295px" id="<?php echo $column;  ?>" class="test float-center" disabled value="<?php echo $row[$column]==0?"NO":"YES";  ?>">
                <button onclick="triggerExample(<?php echo "'#".$column."'";?>);" style="font-size:19pt" class="btn-primary text-center">
                    copy
                </button>
                <?php
                }else if($column=='Guzar'){
                    ?>
                    <input type="text" style="font-size:17pt;width:295px" id="<?php echo $column;  ?>" class="test float-center" value="<?php echo "Guzar-".$row[$column];  ?>">
                    <button onclick="triggerExample(<?php echo "'#".$column."'";?>);" style="font-size:19pt" class="btn-primary text-center">
                        copy
                    </button>
                    <?php
                }else if($column=='hh_ful'){
                    ?>
                    <input type="text" style="font-size:17pt;width:295px" id="<?php echo $column;  ?>" class="test float-center" value="<?php echo "KAO-SO1-DRAFTS-SS1-".$row['hh'];  ?>">
                    <button onclick="triggerExample(<?php echo "'#".$column."'";?>);" style="font-size:19pt" class="btn-primary text-center">
                        copy
                    </button>
                    <?php
                }else{
                ?>
                <input type="text" style="font-size:17pt;width:295px;" id="<?php echo $column;  ?>" class="test float-center" value="<?php echo $row[$column];  ?>">
                <button onclick="triggerExample(<?php echo "'#".$column."'";?>);" style="font-size:19pt" class="btn-primary text-center">
                    copy
                </button>
                <?php
                }
                ?>
            </div>
        </div>
    <?php
    }
    ?>
<div class="container">
    <p class="lead">Surveyor:<?php    echo $row['surveyorName']   ?> </p>
</div>
    <a href="AllData.php" style="font-size: 20pt;" class="btn-primary d-block text-center">All Data</a>
    <a href="surveyTotal.php" style="font-size: 20pt;" class="btn-primary d-block text-center">Survey</a>
</div>
</body>
</html>
<?php
}
