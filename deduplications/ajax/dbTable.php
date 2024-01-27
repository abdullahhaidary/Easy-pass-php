<?php
$con=mysqli_connect('localhost','root','Rania@%123123','ochrdb');
$sql="SELECT count(*) as totalCount FROM imported_data WHERE status='Green'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$sql="SELECT count(*) as totalCount FROM imported_data WHERE status='Red'";
$result=$con->query($sql);
$rowRed=$result->fetch_assoc();
?>
<table class="table table-hover table-bordered">
    <tr>
        <td>Green</td>
        <td><?php echo $row['totalCount']?></td>
    </tr>
    <tr>
        <td>Red</td>
        <td><?php echo $rowRed['totalCount']?></td>
    </tr>
    <tr>
        <td>Total</td>
        <td><?php echo $rowRed['totalCount']+$row['totalCount']?></td>
    </tr>
</table>