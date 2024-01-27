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
        <title>Total</title>
        <link href="../css/bootstrap.css" rel="stylesheet"/>
    </head>
    <body>
    <?php
    $sql="SELECT DISTINCT scoper from scopeprocess";
    $result=$con->query($sql);
    $usernames = array();
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            $usernames[] = $row['scoper'];
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
                $sql="SELECT * FROM scopeprocess WHERE scoper='$username'";
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
                        <a href="scoperData.php?username=<?php echo $username ?>">Data</a>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <div class="container">
        <form action="dashboard.php" method="get">
            <input type="text" name="ben_information" id="ben_information"/>
            <select name="option">
                <option value="1">tazkira</option>
                <option value="2">Name</option>
                <option value="3">Father Name</option>
                <option value="4">Guzar</option>
            </select>
            <button type="submit">Submit</button>
        </form>

    <?php
    if(isset($_GET['ben_information'])){
        $option=$_GET['option'];
        $hh=$_GET['ben_information'];

        if($option==1) {
            $sql = "SELECT * from scopeprocess LEFT JOIN beninfo on scopeprocess.ben_id=beninfo.ben_id
LEFT join criteria ON scopeprocess.ben_id=criteria.criteria_id WHERE ben_tazkira like '%$hh%' and nahia=12";
        }
        else if($option==2) {
            $sql = "SELECT * from scopeprocess LEFT JOIN beninfo on scopeprocess.ben_id=beninfo.ben_id
LEFT join criteria ON scopeprocess.ben_id=criteria.criteria_id WHERE ben_name like '%$hh%' and nahia=12";
        }else if($option==2){
            $sql = "SELECT * from scopeprocess LEFT JOIN beninfo on scopeprocess.ben_id=beninfo.ben_id
LEFT join criteria ON scopeprocess.ben_id=criteria.criteria_id WHERE father_name like '%$hh%' and nahia=12";
        }else if($option==3){
            $sql = "SELECT * from scopeprocess LEFT JOIN beninfo on scopeprocess.ben_id=beninfo.ben_id
LEFT join criteria ON scopeprocess.ben_id=criteria.criteria_id WHERE Guzar like '%$hh%' and nahia=12";
        }
        $result2=$con->query($sql);
        if($result2->num_rows>0){
            ?>
            <div class="container">
                <table class="table-bordered table table-hover table-response">
                    <tr>
                        <td>Name</td>
                        <td>Father Name</td>
                        <td>Tazkira</td>
                        <td>Phone</td>
                        <td>scoper</td>
                        <td>date</td>
                        <td></td>
                    </tr>
                    <?php
                    while($row=$result2->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php  echo $row['ben_name']  ?></td>
                            <td><?php  echo $row['ben_fathername']  ?></td>
                            <td><?php  echo $row['ben_tazkira']  ?></td>
                            <td><?php  echo $row['ben_phone']  ?></td>
                            <td><?php  echo $row['scoper']  ?></td>
                            <td><?php  echo $row['dateTime']  ?></td>
                            <td><a href="surveyPage.php?advance=<?php  echo $row['ben_id']  ?>">Go To</a></td>
                        </tr>

                        <?php
                    } ?>

                </table>

            </div>


            <?php
        }
    }
    ?>
        <p class="d-inline">Total</p>
        <?php
        $date='20'.date('y-m-d');
        $sql="SELECT * from scopeprocess WHERE dateTime like '$date%'";
        $result =$con->query($sql);
        ?>
        <?php echo $result->num_rows; ?>
    </div>
    </body>
    </html>


<?php
