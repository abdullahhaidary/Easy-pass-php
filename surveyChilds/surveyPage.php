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
if(isset($_GET['deleteId'])){
    $deleteId=$_GET['deleteId'];
    $sqlDelete="DELETE FROM scopeprocess WHERE ben_id=$deleteId";
    try{
        $resultDelete=$con->query($sqlDelete);
    }catch(Exception $e){
        header("location:surveyPage.php?AlreadyDeleted");
    }
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Survey System</title>
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
        <h1 class="d-inline">Beneficiary Database</h1><button class="d-inline btn-primary text-center" style="cursor:pointer" type="button" onclick="window.location.assign('advanceSearch.php')">Advance Search</button>

        <div class="row">
            <div class="mx-auto col-10 col-md-10 col-lg-6">
                <?php
                if(!(isset($_GET['advance']) || isset($_GET['ben_information']) )){
                    ?>
                    <form action="surveyPage.php" class="form-inline text-center"  type="POST">
                        <input type="text" required autofocus name="ben_information" class="form-control form-inline d-inline float-left" placeholder="Enter Ben Information"/>
                        <select name="option">
                            <option value="1">Tazkira</option>
                            <option value="2">Phone</option>
                        </select>
                        <button class="btn-primary" type="submit">Search</button>
                    </form>
                <?php
                }
        ?>
            </div>
        </div>
    </div>
    <div class="search">
    </div>
</section>
<?php
if(isset($_GET['nahia'])){
    echo "<h2 class='text-center'>Nahia 22</h2>";
}
if(isset($_GET['ben_information']) || isset($_GET['advance']) || isset($_GET['ben_id'])){
    if(isset($_GET['option'])) {
        $option = $_GET['option'];
    }
    if(isset($_GET['ben_information'])) {
        $hh = $_GET['ben_information'];
    }else if(isset($_GET['ben_id'])) {
        $hh = $_GET['ben_id'];
    }
    if(isset($_GET['advance'])){
        $ben_id= $_GET['advance'];
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
inner join criteria where beninfo.ben_id=criteria.criteria_id and ben_id = $ben_id";
    }else if($option==1) {
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
inner join criteria where beninfo.ben_id=criteria.criteria_id and ben_tazkira like '%$hh%'";
    }
    else if($option==2) {
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
inner join criteria where beninfo.ben_id=criteria.criteria_id and ben_phone like '%$hh%'";
    } else if($option==4) {
        $sql = "SELECT * from beninfo LEFT JOIN surveyorinfo on beninfo.surveyor_id=surveyorinfo.surveyorId
inner join criteria where beninfo.ben_id=criteria.criteria_id and ben_id like '%$hh%'";
        echo 'received';
    }
    $result2=$con->query($sql);
if($result2->num_rows>0){
$row=$result2->fetch_assoc();
if($row['Nahia']==22){
    header("location:surveyPage.php?nahia=22");
}else{
$ben_id=$row['ben_id'];
// CARD NUMBER
    if(isset($_GET['card_number'])) {
        echo 'received';
        $card_number = $_GET['card_number'];
        $beninfo=$_GET['ben_id'];
        $sql = "INSERT INTO scopeprocess (ben_id ,card_number ,scoper )
            VALUES ($beninfo,$card_number,'$logininfo')";
            $result = $con->query($sql);
            echo 'successfull';

    }
?>
<div class="row">
    <div class="mx-auto col-10 col-md-10 col-lg-6 mt-2 mb-2">
    <form action="surveyPage.php">
        <div class="d-inline">
            <input type="number" style="font-size:20pt" onkeypress="return noenter();" class="d-inline" Required name="card_number" id="card_number"/>
            <input type="text" hidden  value="<?php echo $row['ben_id'] ?>" Required name="ben_id" id="ben_id"/>
            <input type="number" hidden  value="4" Required name="option" id="option"/>
            <button class="btn-primary d-inline" style="font-size:20pt" type="submit">submit</button>
        </div>
    </form>
    </div></div>
        <?php
/*
 Check Data if it is received or not
 */
$sqlData="SELECT ben_id FROM scopeprocess WHERE ben_id=$ben_id";
$resultData=$con->query($sqlData);
if($resultData->num_rows>0){
    $_SESSION['receiveState']='on';
}else{
    $_SESSION['receiveState']='off';
}
//-----------------------------

?>
<div class="
<?php if($_SESSION['receiveState']=='on') echo 'bg-danger';  ?>
">
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
                    <input type="text" style="font-size:17pt;width:295px" id="<?php echo $column;  ?>" class="test float-center" value="<?php echo "KAO-SO1-CBT-AF01-1583-OCHR-";  ?>">
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
        <p class="lead">Surveyor: <?php    echo $row['surveyorName']   ?> </p>
    </div>
</div>
<?php
    if($logininfo=='abdullah'){
        ?>
        <a href="dashboard.php" class="btn-danger text-center d-block mb-2" style="text-decoration: none;font-size:15pt">Dashboard</a>

        <?php
    }
    ?>
    <a href="surveyPage.php" class="btn-danger text-center d-block mb-2" style="text-decoration: none;font-size:15pt">Ignore</a>
<a href="surveyPage.php?deleteId=<?php echo $row['ben_id'] ?>" class="btn-danger text-center d-block" style="text-decoration: none;font-size:15pt">Delete Benefeciary</a>
        <?php
}
    ?>
 <a href="surveyTotal.php" class="btn-primary text-center d-block mt-2" style="text-decoration: none;">Total</a>

<?php
}else{
    echo "<h2 class='display-1'> Not Available</h2>";
}
}else if(isset($_GET['duplicateEntry'])){
?>
    <p class="text-center display-1 bg-danger text-white">The User is Already Registered</p>
<?php
}else if(isset($_GET['AlreadyDeleted'])){
?>
<p class="text-center display-1 bg-danger text-white">The User is Already Deleted</p>
<?php
}

?>
<div class="mx-auto col-10 col-md-10 col-lg-6">
</div>
</body>
</html>

