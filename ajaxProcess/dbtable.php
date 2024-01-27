<?php
include_once('../dbconnection.php');
$con=openconnection();
$tableHeader=array("Nahia","Current Day","Current Cycle","Total Absent","MALE","Female");
$sql="SELECT count(*) AS totalCount FROM data";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$total=$row['totalCount'];
$sql="SELECT count(*) AS totalCount FROM received";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$received=$row['totalCount'];
$percentage=($received/$total*100);
$date='20'.date('y-m-d');
?>
<table class="table table-bordered">
    <thead>
    <tr>
        <th style="width: 10px">#</th>
        <th>Task</th>
        <th>Total</th>
        <th>Progress</th>
        <th style="width: 40px">Label</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>1.</td>
        <td>Total Distributions</td>
        <td id="received_data_all"><?php echo $received ?></td>
        <td>
            <div class="progress progress-xs">
                <div id="received_data_all_chart" class="progress-bar progress-bar-danger" style="width:<?php echo $percentage."%"?>"></div>
            </div>
        </td>
        <td><span id="received_data_all_percentage" class="badge bg-primary"><?php echo number_format($percentage,1)."%"?></span></td>
    </tr>
    <tr>
        <td>2.</td>
        <td>Daily Target</td>
        <?php
        $sql_daily="SELECT count(*) as totalCount FROM `data` RIGHT JOIN received on data.pbl=received.pbl where TIMESTAMP(time) like '$date%'";
        $result_daily=$con->query($sql_daily);
        $row_daily=$result_daily->fetch_assoc();
        ?>
        <td id="received_data_all_target"><?php echo $row_daily['totalCount'] ?></td>
        <?php $percentage=($row_daily['totalCount']/2000*100);?>
        <td>
            <div class="progress progress-xs">
                <div id="received_data_all_chart" class="progress-bar progress-bar-danger" style="width:<?php echo $percentage."%"?>"></div>
            </div>
        </td>
        <td><span id="received_data_all_percentage" class="badge bg-primary"><?php echo number_format($percentage,1)."%"?></span></td>
    </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead>
    <?php
    foreach($tableHeader as $table){
    ?>
        <th><?php echo $table; ?></th>

    <?php
    }
    echo "</thead>";
    echo "<tbody>";
    $sql="SELECT DISTINCT Location FROM data";
    $result=$con->query($sql);
    while($row=$result->fetch_assoc()){
        $location=$row['Location'];
        ?>
        <tr>
            <?php
            echo "<td>".$location."</td>";
            $i=0;
            foreach($tableHeader as $header) {
                     if ($header == 'Current Day') {
                        $sql = "SELECT count(*) as totalCount FROM `data` RIGHT JOIN received on data.pbl=received.pbl where TIMESTAMP(time) like '$date%' AND Location='$location'";
                    } else if ($header == 'Current Cycle') {
                        $sql = "SELECT count(*) as totalCount FROM `data` RIGHT JOIN received on data.pbl=received.pbl where Location='$location'";
                    } else if ($header == 'Total Absent') {
                        $sql = "SELECT count(*) as totalCount FROM `data` where status = 0 AND Location='$location'";
                    } else if ($header == 'MALE') {
                        $sql = "SELECT count(*) as totalCount FROM `data` RIGHT JOIN received on data.pbl=received.pbl where TIMESTAMP(time) like '$date%' AND Location='$location' AND Gender='Male'";
                    } else if ($header == 'Female') {
                        $sql = "SELECT count(*) as totalCount FROM `data` RIGHT JOIN received on data.pbl=received.pbl where TIMESTAMP(time) like '$date%' AND Location='$location' AND Gender='Female'";
                    }
                if($header!='Nahia'){
                    $resultCount = $con->query($sql);
                    $rowCount = $resultCount->fetch_assoc();
                    echo "<td>" . $rowCount['totalCount'] . "</td>";
                }
            }

            ?>

        </tr>
        <?php
    }
    echo "</tbody>";
    ?>
</table>

