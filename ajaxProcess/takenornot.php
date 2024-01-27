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
$resultstatus->close();
$sql="SELECT status from $pd where pbl=".$_GET['pbl'];
$result=$con->query($sql);
$row = $result->fetch_assoc();
echo $row['status'];