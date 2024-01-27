<?php
try{
    $con=mysqli_connect("localhost","root","Rania@%123123","survey");
}catch(Exception $exception){
    echo "<h1>Erro Occured</h2>";
    exit();
}
?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scoper Data</title>
    <link href="../css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
<?php
if(isset($_GET['username'])) {
    $username = $_GET['username'];
    $sql = "SELECT * FROM scopeprocess JOIN beninfo ON scopeprocess.ben_id=beninfo.ben_id WHERE scopeprocess.scoper ='$username'";
    $result=$con->query($sql);
}
?>
<div class="container-fluid">
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th class="col"> Household </th>
            <th class="col"> Name </th>
            <th class="col"> F/Name </th>
            <th class="col"> Tazkira </th>
            <th class="col"> Phone </th>
            <th class="col"> id </th>
        </tr>
        </thead>
        <?php
        if($result->num_rows){
            while($row=$result->fetch_assoc()){
                ?>
                <tr>
                    <td> <?php echo "KAO-SO1-CBT-AF01-1583-OCHR-".$row['card_number']; ?> </td>
                    <td> <?php echo $row['ben_name']; ?> </td>
                    <td> <?php echo $row['ben_fathername']; ?> </td>
                    <td> <?php echo $row['ben_tazkira']; ?> </td>
                    <td> <?php echo $row['ben_phone']; ?> </td>
                    <td> <?php echo $row['ben_id']; ?> </td>
                </tr>
                <?php
            }}
        ?>
    </table>

</div>
</body>
</html>