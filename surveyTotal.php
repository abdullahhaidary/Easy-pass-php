<?php
try{
    $con=mysqli_connect("localhost","root","Rania@%123123","survey");
}catch(Exception $exception){
    echo "<h1>Erro Occured</h2>";
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
<?php
$sql="SELECT DISTINCT scope from scoped";
$result=$con->query($sql);
$usernames = array();
if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
        $usernames[] = $row['scope'];
    }
}
?>
<div class="container-fluid">
<table class="table table-hover">
<tr>
    <td>Scoper Name</td>
    <td>Total</td>
    <td>Data</td>
</tr>
    <?php
    foreach ($usernames as $username){
        $sql="SELECT * FROM scoped WHERE scope='$username'";
        $result=$con->query($sql);

        ?>
        <tr>
            <td>
            <?php echo $username  ?>
            </td>
            <td>
                <?php
                echo $result->num_rows;
                ?>
            </td>
            <td>
                <a href="surveyChilds/scoperData.php?username=<?php echo $username ?>">Data</a>
            </td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
</body>
</html>


<?php
