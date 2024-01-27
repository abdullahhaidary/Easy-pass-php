<?php
$con=mysqli_connect('localhost','root','Rania@%123123','ochrdb');
session_start();
if(!isset($_SESSION['logged_in'])) {
    header("location:../index.php");
}else{
    $logininfo = $_SESSION['logged_in'];

}
$sql="SELECT * FROM deduplication_table_temporary d INNER JOIN imported_data i on d.no=i.id_number  WHERE user='$logininfo'";
$result=$con->query($sql);
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        echo 'received';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deduplication List</title>
</head>
<body>

</body>
</html>
