<?php
include '../dbconnection.php';
$con=openconnection();
function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
if(isset($_POST['username']) && isset($_POST['pass'])){
    if (empty ($_POST["username"])) {
        header("location:../index.php?error=No UserName Entered");
    }    if (empty ($_POST["pass"])) {
        header("location:../index?error=No Password Entered");
    }    else {
        $username = input_data($_POST['username']);
        $password = input_data($_POST['pass']);
        if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
            header("location:../index.php?error=Only White space and letters are allowed");
        }
    }
    $sql = "SELECT * FROM users where username= '$username' and BINARY password=BINARY '$password'";
    $result=$con->query($sql);
    if($result->num_rows>0){
        session_start();
        $_SESSION['logged_in']=strtolower($_POST['username']);
        header("location:../home.php");

    }else{
        header("location:../index.php?wrong_password");
    }

}
?>