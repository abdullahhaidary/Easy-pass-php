<!doctype html>
<html lang="en">
<head>
    <?php
    $con=mysqli_connect('localhost','root','Rania@%123123','ochrdb');
    ?>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/bootstrap.css" rel="stylesheet"/>
    <title>Deduplication</title>
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['logged_in'])) {
    header("location:../index.php");
}else{
    $logininfo = $_SESSION['logged_in'];

}
if($logininfo=='abdullah'){
    $min=0;
    $max=120;
}
if($logininfo=='shujahat'){
    $min=0;
    $max=200;
}
if($logininfo=='helal'){
    $min=201;
    $max=400;
}
if($logininfo=='abdurahman'){
    $min=401;
    $max=600;
}
if($logininfo=='rafi'){
    $min=601;
    $max=700;
}
if($logininfo=='helal'){
    $min=701;
    $max=800;
}
if($logininfo=='noorahmad'){
    $min=801;
    $max=1000;
}
//if($logininfo=='jawed'){
//    $min=1001;
//    $max=1200;
//}
//if($logininfo=='zia'){
//    $min=1201;
//    $max=1400;
//}

//if($logininfo=='zia'){
//    $min=1401;
//    $max=1600;
//}
//if($logininfo=='jawed'){
//    $min=1601;
//    $max=1800;
//}
if($logininfo=='zia'){
    $min=1801;
    $max=1850;
}
if($logininfo=='abdurahman'){
    $min=1851;
    $max=1900;
}
if($logininfo=='jawed'){
    $min=1901;
    $max=1950;
}
if($logininfo=='noorahmad'){
    $min=1951;
    $max=2000;
}
$sql="SELECT * FROM imported_data WHERE status='not_set' and no between $min and $max";
$result=$con->query($sql);
$no=array();
if($result->num_rows>0) {
echo '<h1 class="lead">'.$result->num_rows.'</h1>';
while ($row = $result->fetch_assoc()) {
        $no[] = $row['no'];
    }
if(!isset($_SESSION['beneficiary'])) {
    $arrayIndex=array_rand($no,1);
    $randomNumber=$no[$arrayIndex];
    $sql = "SELECT * FROM imported_data WHERE no=$randomNumber";
}else{
    $session=$_SESSION['beneficiary'];
    $sql = "SELECT * FROM imported_data WHERE id_number=$session";
}
$result=$con->query($sql);

?>
<h1 class="mb-5 text-center">Deduplication</h1>
<div class="container">
    <?php
    if(isset($_GET['receive'])){
        $receive=$_GET['receive'];
        $sql="UPDATE imported_data set status='Green',user='$logininfo' WHERE id_number=$receive";
        $result=$con->query($sql);
        $sql="INSERT INTO deduplication_table_temporary (no,user) VALUES ('$receive','$logininfo')";
        $result=$con->query($sql);
        unset($_SESSION['beneficiary']);
        header('location:deduplication.php');
    }else if(isset($_GET['notFound'])){
        $receive=$_GET['notFound'];
        $sql="UPDATE imported_data set status= 'Red',user='$logininfo' WHERE id_number=$receive";
        $result=$con->query($sql);
        $sql="INSERT INTO deduplication_table_temporary (no,user) VALUES ('$receive','$logininfo')";
        $result=$con->query($sql);
        unset($_SESSION['beneficiary']);
        header('location:deduplication.php');
    }
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $_SESSION['beneficiary']=$row['id_number'];
            ?>
            <div class="">

                <input type="text" style="width: 300px" id="household" value="<?php echo $row['household_name']?>"/>
                <button class="btn btn-primary" onclick="copy();">Copy</button>
                <script>
                    function copy(){
                        var select= document.getElementById('household');
                        select.select();
                        document.execCommand('copy');
                    }
                    document.addEventListener('keydown',function(event){
                        if(event.shiftKey && event.key==='c'){
                            copy();
                        }
                    });
                </script>
                <table class="table table-bordered table-hover">
                    <tr>
                        <td><a href="deduplication.php?receive=<?php echo $row['id_number'] ?>" class="btn btn-primary">Receive</a></td>
                        <td><a href="deduplication.php?notFound=<?php echo $row['id_number']?>" class="btn btn-danger float-right" >Not Found</a></td>
                    </tr>
                    <tr>
                        <td>Recipient:</td>
                        <td><?php echo $row['recipient'] ?>: <b class="text-danger"><?php echo $row['remarks'] ?></b></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><?php echo $row['first_name'] ?></td>
                    </tr><tr>
                        <td>Last Name</td>
                        <td><?php echo $row['last_name']?></td>
                    </tr><tr>
                        <td>Document</td>
                        <td><?php echo $row['documents']?></td>
                    </tr>
                </table>
            </div>
            <?php
        }}
}else{
    echo "<div class='display-1'>no data to display</div>";
    unset($_SESSION['beneficiary']);
}
    ?>
</div>
<div class="container">
</div>
</body>
</html>