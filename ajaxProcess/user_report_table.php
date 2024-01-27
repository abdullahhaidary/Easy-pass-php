<?php
$con=mysqli_connect('localhost','root','Rania@%123123','ochrdb');
$date='20'.date('y-m-d');
$sql="SELECT DISTINCT user_id FROM received";
$result=$con->query($sql);
$headerTable=array('User','Today','Total');
echo "<table class='table table-bordered'>";
echo "<tr>";
foreach($headerTable as $header){
    echo "<td>".$header."</td>";
}
echo "</tr>";
while($row=$result->fetch_assoc()){
    echo "<tr>";
    foreach($headerTable as $header) {
        $user_id = $row['user_id'];
        if($header=='User') {
            $sql_user = "SELECT username FROM users WHERE id=$user_id";
        }else if($header=='Today'){
            $sql_user = "SELECT count(*) AS username FROM received WHERE user_id=$user_id AND TIMESTAMP(time) like '$date%'";
        }else if($header=='Total'){
            $sql_user = "SELECT count(*) AS username FROM received WHERE user_id=$user_id";
        }
        $result_user = $con->query($sql_user);
        $username = $result_user->fetch_assoc();
        $username = $username['username'];
        echo "<td>" . $username . "</td>";
    }
    echo "</tr>";
}
echo "<tr>";
echo "<td> Total</td>";
foreach($headerTable as $header) {
    if($header=='Today' || $header=='Total'){
    if($header=='Today'){
        $sql_user = "SELECT count(*) AS username FROM received WHERE TIMESTAMP(time) like '$date%'";
    }else if($header=='Total'){
        $sql_user = "SELECT count(*) AS username FROM received";
    }
    $result_user = $con->query($sql_user);
    $username = $result_user->fetch_assoc();
    $username = $username['username'];
    echo "<td>" . $username . "</td>";
}}

echo "</tr>";
echo "</table>";
