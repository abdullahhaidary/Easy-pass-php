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
    $sql="SELECT * FROM $pd where status='nTN'";
    $result=$con->query($sql);
    ?>
  <div class="firsttotal">
            <h1 align="center" style="font-size:40pt;">
                <?php
                echo $result->num_rows;
                ?>
            </h1>
        </div>
        <div class="secondtotal">
            <h2 style="color:white">ALL TIME</h2>
        </div>
    <?php
}
