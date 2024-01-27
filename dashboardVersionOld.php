<!doctype html>
<?php
include_once 'dashboard_childs/checkadmin_session.php';
include_once 'dbconnection.php';
$con=openconnection();
$login=$_SESSION['logged_in'];
$date='20'.date('Y-M-D');
$pd='data';
?>
<script src="js/jquery.js"></script>

<head>
<title>Dashboard</title>
    <link rel="stylesheet" href="css/bootstrap.css"/>
    <script type="text/javascript">
        function loadDoc() {
            /*---------pd22_absent-----------*/
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("tableAll").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "ajaxProcess/dbtable.php", true);
            xhttp.send();

        }
        setInterval(function(){
            loadDoc();
        },100);
        window.load=loadDoc();
    </script>
</head>
<body>
<?php
include_once 'dashboard_childs/header.php';
?>
<div class="container-fluid mt-5" id="tableAll">
</div>
</body>
</html>
