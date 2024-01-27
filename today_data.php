<html>
<head>
    <?php
    include_once 'dbconnection.php';
    $con=openconnection();
    $date='20'.date('y-m-d');
        $pd = 'data';
    ?>
<title>DataPage</title>
    <style>
        .data{
            display:flex;
            flex-flow: column nowrap;
            justify-content:center;
            margin-left:40px;
            align-content:center;
        }
    </style>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
<?php
include_once 'dashboard_childs/header.php';
?>
<div style="margin-bottom:30px; margin-left:50%; font-size:20pt;">
<form action="" method="get">
<select style="font-size:20pt" name="date" >
    <?php
    $sql="SELECT DISTINCT day(time) AS time from received";
    $result=$con->query($sql);
    if($result->num_rows){
    if(isset($_GET['time'])) {
        $selectedDate=$_GET['time'];
    }
        while($row=$result->fetch_assoc()){
        if($row['time']==$selectedDate){
            $selected="selected";
        }else{
            $selected='';
        }
                echo "<option $selected>";
                echo '2023-08-'.$row['time'];
                echo "</option>";
        }
    }
    ?>
</select>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

<div class="container">
    <?php
    if(isset($_GET['date'])){
        $date=$_GET['date'];
    }
    $sql="SELECT * FROM received RIGHT JOIN data on received.pbl=data.pbl where received.time like '$date%'";
    $result=$con->query($sql);
    ?>
    <table class="table table-bordered table-light">
        <tr>
            <td ><b>PBL</b></td>
            <td><b>Household</b></td>
            <td ><b>Name</b></td>
            <td ><b>FatherName</b></td>
            <td ><b>Document Number</b></td>
            <td ><b>Phone</b></td>
            <td ><b>username</b></td>
            <td ><b>Gender</b></td>
            <td ><b>Date</b></td>

        </tr>
        <?php
        while($row=$result->fetch_assoc()){
            $user_id=$row['user_id'];
            $sql="SELECT username FROM users WHERE id=$user_id";
            $result_user_id=$con->query($sql);
            $row_user_id=$result_user_id->fetch_assoc();
            echo "
        <tr>
            <td >".$row['pbl']."</td>
            <td >".$row['hh_ful']."</td>
            <td >".$row['first_name']."</td>
            <td >".$row['father_name']."</td>
            <td >".$row['document_number']."</td>
            <td >".$row['phone_number']."</td>
            <td >".$row_user_id['username']."</td>
            <td >".$row['Gender']."</td>
            <td >".$row['time']."</td>
        </tr>
        ";}
        ?>
    </table>
</div>
</body>
</html>