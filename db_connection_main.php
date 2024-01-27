<?php
$servername = "localhost";
$serveruname = "root";
$serverpass = "Rania@%123123";
$dbName = "ochrdb";
$con = new mysqli($servername, $serveruname, $serverpass, $dbName);
if($con->connect_error){
    die('the connection to database is lost...');
}
