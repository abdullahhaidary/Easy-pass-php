<?php

function openconnection()
{
    try {
        $servername = "localhost";
        $serveruname = "root";
        $serverpass = "Rania@%123123";
        $dbName = "ochrdb";
        $con = new mysqli($servername, $serveruname, $serverpass, $dbName);
        return $con;
    }catch(Exception $e){
        echo '<h2>Connection to the database was interrupted</h2>';
        exit();
    }
}