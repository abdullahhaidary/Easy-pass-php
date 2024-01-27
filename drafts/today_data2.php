<html>
<head>
    <?php
    include_once 'dbconnection.php';
    $con=openconnection();
    $date=date('d-m-y');
    $sqlstatus="SELECT status from select_db";
    $resultstatus=$con->query($sqlstatus);
    while($row=$resultstatus->fetch_assoc()) {
        $pd = 'pd12december';
    }
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
</head>
<body>
<div style="margin-bottom:30px; margin-left:50%; font-size:20pt;">
<form action="" method="get">
<select style="font-size:20pt" name="date">
    <?php
    $sql="SELECT DISTINCT date from $pd";
    $result=$con->query($sql);
    if($result->num_rows){
        while($row=$result->fetch_assoc()){
            echo "<option >";
            echo $row['date'];
            echo "</option>";
        }
    }
    ?>
</select>
    <button type="submit" >Go To Date</button>
</form>
</div>

<div class="data" style="margin-left:20px ;justify-content: center">
    <?php
    if(isset($_GET['date'])){
        $date=$_GET['date'];
    }
    $sql="SELECT * FROM $pd where status2 ='tn' and highlight_date='$date'";

    $result=$con->query($sql);
    echo $result->num_rows;
    ?>
    <table  style="border:2px solid black; border-collapse: collapse; text-align: center">
        <tr>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt;"><b>PBL</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>Household</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>Name</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>FatherName</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>Document Number</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>Phone</b></td>
            <td style="border:2px solid black; border-collapse: collapse; font-size:16pt"><b>username</b></td>

        </tr>
        <?php
        while($row=$result->fetch_assoc()){
            echo "
        <tr>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['pbl']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['hh_ful']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['first_name']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['father_name']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['document_number']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['phone_number']."</td>
            <td style='border:2px solid black; border-collapse: collapse'>".$row['username']."</td>

        </tr>
        ";}
        ?>
    </table>
</div>
</body>
</html>