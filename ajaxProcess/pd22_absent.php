<?php
try {
    $con = mysqli_connect("localhost", "root", "Rania@%123123", "ochrdb");
}catch(Exception $e){
    echo 'database connection error';
    exit();
}
$sqlstatus="SELECT status from select_db";
$resultstatus=$con->query($sqlstatus);
while($row=$resultstatus->fetch_assoc()){
    $pd=$row['status'];
}
if(isset($_GET['dataCount'])){
    $date=date('d-m-y');
    ?>
    <div class="firsttotal" id="firsttotal">
        <h1 align="center" style="font-size:40pt;">
            <?php
            if($pd=='newpbldecember' || $pd=='january_23' || $pd=='january_third_batch' || $pd=='feberuary')  {
                $sql = "SELECT * FROM $pd where status='nTN' and location='Nahia_22'";
            }else{
                $sql = "SELECT * FROM $pd where status='nTN'";
            }
            $result=$con->query($sql);
            $count= $result->num_rows;
            echo $count;
            ?>
        </h1>
    </div>
    <div class="secondtotal">
        <h2 style="color:white">ABSENT LIST</h2>
    </div>
    <?php
}
