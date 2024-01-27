<html>
<head>
    <title>DataPage</title>
    <?php
    include_once 'dbconnection.php';
    $con=openconnection();
    $date='20'.date('y-m-d');
    $pd = 'data';
    $sql="SELECT * FROM data where status =0";
    $result=$con->query($sql);
    ?>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
<?php
include 'dashboard_childs/header.php';
?>
<div class="container-fluid mt-5">
    <table  class="table table-bordered table-responsive table-light text-center">
        <thead>
            <td>PBL</td>
            <td style="width:200px">Household</td>
            <td>Name</td>
            <td>FatherName</td>
            <td>Document Number</td>
            <td>Phone</td>
            <td>Nahia</td>
            <td>Address</td>

        </thead>
        <?php
        while($row=$result->fetch_assoc()){
            echo "
        <tr>
         
            <td>".$row['pbl']."</td>
            <td >".$row['hh_ful']."</td>
            <td >".$row['first_name']."</td>
            <td >".$row['father_name']."</td>
            <td >".$row['document_number']."</td>
            <td >".$row['phone_number']."</td>            
            <td >".$row['Location']."</td>
            <td >".$row['address']."</td>

        </tr>
        ";}
        ?>
    </table>
</div>
</body>
</html>