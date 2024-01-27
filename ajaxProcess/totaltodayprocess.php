<?php
try {
    $con = mysqli_connect("localhost", "root", "Rania@%123123", "ochrdb");
}catch(Exception $e){
    echo 'database connection error';
    exit();
}
if(isset($_GET['dataCount'])){
    $date=date('d-m-y');
   $sql="SELECT * FROM feberuary where status='TN' and date='$date'";
   $result=$con->query($sql);
   ?>
    <div class="first" id="firstid">
        <h1 align="center" style="font-size:40pt;">
            <?php
            echo $result->num_rows;
            ?>
        </h1>
    </div>
    <div class="second">
        <h2>Total</h2>
    </div>
    <?php
}
