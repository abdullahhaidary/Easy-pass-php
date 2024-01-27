<?php
session_start();
$loginstatus = $_SESSION['logged_in'];
if(!isset($_GET['loginasadmin'])){
if ($loginstatus != "abdullah") {
    header("location:../index.php");
}
}