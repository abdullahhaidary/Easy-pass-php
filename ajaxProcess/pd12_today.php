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
    if($pd=='newpbldecember' || $pd=='january_23' || $pd=='january_third_batch' || $pd=='feberuary') {
        $sql="SELECT * FROM $pd where status ='TN' and date='$date' and Location='Nahia_12 010112'";
    }else{
        $sql="SELECT * FROM $pd where status ='TN' and date='$date'";
    }
    $result=$con->query($sql);
    ?>
    <div class="first">
        <h1 align="center" style="font-size:40pt;">
            <?php
            echo $result->num_rows;
            ?>
        </h1>
    </div>
    <div class="second">
        <h2>Nahia 12</h2>
    </div>
    <?php
}
