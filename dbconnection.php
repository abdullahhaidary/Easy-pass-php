<?php

function openconnection()
{
    $servername = "localhost";
    $serveruname = "root";
    $serverpass = "";
    $dbName = "ochrdb";
    $con = new mysqli($servername, $serveruname, $serverpass, $dbName);
    if($con->connect_error){
        die('the connection to database is lost...');
    }
    return $con;
}