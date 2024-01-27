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
    <div class="firsttotal">
        <h1 align="center" style="font-size:40pt;">
            <?php
            if($pd=='newpbldecember' || $pd=='january_23' || $pd=='january_third_batch' || $pd=='feberuary') {
                $sql="SELECT * FROM $pd where status ='TN' and Location='Nahia_12 010112'";
            }else{
                $sql="SELECT * FROM $pd where status ='TN' and date='$date'";
            }
            $result=$con->query($sql);
            echo $result->num_rows;
            ?>
        </h1>
    </div>
    <div class="secondtotal">
        <h2 style="color:white">ALL TIME</h2>
    </div>
    <?php
}
