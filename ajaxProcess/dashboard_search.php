<?php
include_once('../dbconnection.php');
$con=openconnection();
$pd='data';
if(isset($_GET['household'])) {
    $household=$_GET['household'];
    $selected_location='Nahia_08';
    echo "<table class='table table-bordered '>
<tr>
        <td><b>PBL</b></td>
        <td><b>Household</b></td>
        <td><b>Name</b></td>
        <td><b>Last Name</b></td>
        <td><b>Document Number</b></td>
        <td><b>Phone Number</b></td>
        <td><b>Guzar</b></td>
        <td><b>Username</b></td>
        <td><b>Time</b></td>
</tr>
    <tr style='font-size: 14pt'>";
    $sql = "SELECT *,received.pbl FROM data LEFT JOIN received on received.pbl=data.pbl where hh=$household";
    $result=$con->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()) {
            if(isset($row['user_id'])) {
                $user_id = $row['user_id'];
                $sql_user = "SELECT * FROM users WHERE id=$user_id";
                $result_user = $con->query($sql_user);
                $row_user = $result_user->fetch_assoc();
                $username = $row_user['username'];
            }else{
                $username='NOT RECEIVED';
            }
            echo   "<tr>";
            echo   "<td>".$row['pbl']."</td>";
            echo   "<td>".$row['hh_ful']."</td>
                    <td>".$row['first_name']."</td>
                    <td>".$row['father_name']."</td>
                    <td>".$row['document_number']."</td>
                    <td>".$row['phone_number']."</td>
                    <td>".$row['address']."</td>
                    <td>".$username."</td>";
                echo "<td>".$row['time']."</td>";
            echo "</tr>";
        }
    }else{
        echo "<h2>No Result Found</h2>";
    }
}
?>
</table>
