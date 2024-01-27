<html>
<head>
    <title>Highlight Pd12</title>
    <?php
    session_start();
    include_once 'dbconnection.php';
    $con=openconnection();
    if(!$_SESSION['logged_in']){
     header("location:index.php");
    }
    $logininfo=$_SESSION['logged_in'];

    ?>
    <style>
        header {
            background-color: #ffffff;
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
            padding-bottom:15px;
            padding-top:15px;
        }
        header p:first-child{
            margin-left:200px;
            font-size:20pt;
        }
        .logout{
            float:right;
            margin-right:30px;
            font-size:18pt;
        }
        .logout:hover{
            background-color:blue;
        }
        .total{
            width:10rem;
            height:10rem;
            margin:auto;
            margin-top:50px;
            border:2px solid black;
        }
        .total h2{
            background-color:blue;
            text-align: center;
        }
        header p{
            margin-left:0px;
        }
        .div-container1100{
            width:80%;
        }
        section#hero {
            background-image: linear-gradient(#3491dd, #2d6898);
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
        }
        h1 {
            color: #ffffff;
            font-family: Poppins, sans-serif;
            font-size: 64px;
        }
        .hero_text{
            height:14rem;
            display:flex;
            flex-direction:column;
            justify-content: center;
            align-items:center;

        }
        .hero_text p{
            color:white;
        }
        .search{
            display:flex;
            justify-content:center;
        }
        .search form{
            align-self:center;
        }
        .search form input{
            font-size:20pt;
        }
        .search form button{
            background-color:  #25dc96;
            color:  #ffffff;
            cursor: pointer;
            font-family: Poppins, sans-serif;
            font-size: 16px;
            font-weight: 700;
            font-size:20pt;
            text-transform: uppercase;
            transition: background 0.2s ease 0s;
        }
        .search form button:hover{
            font-size:22pt;
            background-color:red;
        }
        .display_data{
            margin-left:20px;
            margin-right:20px;
        }
    </style>
</head>
<body>
<header>
    <div class="container-1100">
        <p style="display:inline"><b>OCHR</b></p>
        <p style="display:inline">Organization for coordination of humanitarian relief</p>
        <?php
        $logininfo=$_SESSION['logged_in'];
        if($logininfo=='abdullah'){
            echo "<a href='../dashboardVersionOld.php'>login as admin </a>";
        }
        ?>
        <div class="logout" >
            <form method="post" action="">
                <button type="submit" name="logout" >Logout</button>
            </form>
            <?php
            if(isset($_POST['logout'])){
                session_destroy();
                header("location:index.php");
            }
            ?>
        </div>

    </div>
</header>
<section id="hero">
    <div class="hero_text">
        <h1>Beneficiary Database</h1>
        <p>Be Carefull with receive ;)</p>
    </div>
    <div class="search">
        <?php
        $date=date('d-m-y');
        $sqlstatus="SELECT status from select_db";
        $resultstatus=$con->query($sqlstatus);
        while($row=$resultstatus->fetch_assoc()){
            $pd='pd12december';
        }
        ?>
        <form action="" method ="GET">
            <input type="text" autofocus
                   <?php
                   if(isset($_GET['addid'])){
                       echo 'autofocus';
                   }
                   ?>
                   autocomplete="off" name="household" id="household"/>
            <select name="selection" style="font-size:20pt;margin-bottom:20px;">
                <?php if(isset($_GET['selection'])){
                    $selection=$_GET['selection'];
                }?>
                <option value="1" <?php
                if(!isset($_GET['selection'])){
                    $selection=1;
                }
                if($selection==1){ echo "selected";} ?>>Household</option>
                <option value="2" <?php if($selection==2){ echo "selected";}?>>Tazkira Number</option>
                <option value="3" <?php if($selection==3){ echo "selected";}?>>Past BPL</option>
                <option value="4"<?php if($selection==4){ echo "selected";}?>>Name</option>
                <option value="5" <?php if($selection==5){ echo "selected";}?>>Phone Number</option>
            </select>
            <script type="text/javascript">
                <?php
                    if(isset($_GET['household'])){
                        $household=$_GET['household'];
                    }
                ?>
            </script>
            <button type="submit" class="green-btn">Search</button>
        </form>
    </div>
    <div class="display_data">
        <?php
        if($con->connect_error){
            die("connection error");
        }
        if(isset($_GET['household']) || isset($_GET['addid']) || isset($_GET['deleteid'])){
            if(isset($_GET['addid'])){
                $household=$_GET['addid'];
            }elseif (isset($_GET['household'])) {
                $household = $_GET['household'];
            } elseif (isset($_GET['deleteid'])) {
                $household = $_GET['deleteid'];
            }
            if(isset($_GET['selection'])) {
                $selection = $_GET['selection'];
            }
            if($household!=null){
            $sql="SELECT * FROM $pd where hh=$household";
            }else{
                echo "<script type='text/javascript'>
                                    alert('no value to select')
                               </script>";
            }
            if($selection==2){
                $sql=" select * from $pd where document_number like '%$household%';";
            }
            if($selection==3){
                if($pd=="pd22"){
                    $sql=" select * from $pd where bbpl like '%$household%';";
                }
            }
            if($selection==4){
                $sql=" select * from $pd where first_name like '%$household%';";
            }
            if($selection==5){
                $sql=" select * from $pd where phone_number like '%$household%';";
            }
            if(isset($sql)){
            $result=$con->query($sql);
            }
            $_distribuation_state="undone";
            if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                    if($pd=="pd12" && $selection==3){
                        echo "Coming Soon ;)";
                    }
                    echo "<table border='2'  style='
font-size: 16pt;background-color:white; width:100%;height:100px; text-align: center; border-color:white'><tr>
                                        <td><b>PBL</b></td>
                                        <td><b>Household</b></td>
                                        <td><b>Name</b></td>
                                        <td><b>Father Name</b></td>
                                        <td><b>Document Number</b></td>
                                        <td><b>Phone Number</b></td>
                                        <td><b>Alternate Name</b></td>
                                        <td><b>Alternate Document</b></td>
                                        </tr>
                                      
                                        <tr style='font-size: 14pt'>
                                        <td>".$row['pbl']."</td>
                                        <td>".$row['hh_ful']."</td>
                                        <td>".$row['first_name']."</td>
                                        <td>".$row['father_name']."</td>
                                        <td>".$row['document_number']."</td>
                                        <td>".$row['phone_number']."</td>
                                        <td>".$row['alternate_name']."</td>
                                        <td>".$row['alternate_document']."</td>
                                        ";
                    if($row['status2']=="NTN"){
                        echo"<button style='font-size:16pt;' onclick=\"document.getElementById('household').disabled='false'\"><a href='home2.php?addid=".$row['hh']." & addidpbl=".$row['pbl']."& household=".$row['hh']."'  style='text-decoration: none'>Received</a></button>";
                        echo "<script>document.getElementById('household').disabled=true</script>";
                    }
                    if($row['status2']=="NTN"){
                        echo"<button style='font-size:16pt;' onclick=\"document.getElementById('household').disabled='false'\"><a href='home2.php?notthisone=on' style='text-decoration: none'>Not This One</a></button>";
                    }
                    else{
                        echo "<button style='background-color: red;'><a style='color:white;' href='home2.php?deleteidpbl=".$row['pbl']."& household=".$row['hh']."' style='text-decoration: none'>Delete</a></button>";
                        $_distribuation_state="done";
                    }
                    echo" </tr></table>
                                        ";
                    if( $_distribuation_state == "done" ){
                        $_distribuation_state=="";
                    }
                }

            }else{
            }
        }
        if(isset($_GET['notthisone'])){
            $status=$_GET['notthisone'];
            if($status=='on'){
                echo "<script>document.getElementById('household').disabled=false</script>";
            }
        }
        if(isset($_GET['addidpbl'])){
            $addid=$_GET['addidpbl'];
            echo "<script>document.getElementById('household').disabled=false</script>";
            echo "<script>document.getElementById('household').autofocus=true</script>";
            $sql="UPDATE $pd set status2='TN' WHERE pbl=$addid";
            $sql2="update $pd set username2='$logininfo' WHERE pbl=$addid";
            $sql3=" update $pd set highlight_date='$date' WHERE pbl=$addid";
            $con->query($sql);
            $con->query($sql2);
            $con->query($sql3);
        }

        if(isset($_GET['deleteidpbl'])){
            $deleteid=$_GET['deleteidpbl'];
            $sql="UPDATE $pd set status2='NTN' WHERE pbl=$deleteid";
            $sql2=" update $pd set username2=' ' WHERE pbl=$deleteid";
            $sql3=" update $pd set highlight_date='' WHERE pbl=$deleteid";
            $con->query($sql);
            $con->query($sql2);
            $con->query($sql3);

        }
        ?>

    </div>

</section>
<div class="total">
    <div class="first">
        <h1 align="center" style="font-size:40pt;color:black;">
            <?php
            $date=date('d-m-y');
            $sql="SELECT * FROM $pd where status2='TN' and highlight_date='$date'";
            $result=$con->query($sql);
            echo $result->num_rows;
            ?>
        </h1>

    </div>
    <div class="second">
        <h2>today</h2>
    </div>
</div>
</body>
</html><?php ?>
