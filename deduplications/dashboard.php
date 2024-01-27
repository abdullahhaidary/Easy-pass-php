<!doctype html>
<html lang="en">
<?php
$con=mysqli_connect('localhost','root','Rania@%123123','ochrdb');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/bootstrap.css" rel="stylesheet"/>
    <title>Dashboard</title>
</head>

<body onload="load()">
<h1>Dashboard</h1>
<div id="table">

</div>
<button class="btn btn-primary" onclick="load();">Refresh</button>
<script>
    function load() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById('table').innerHTML=this.responseText;
            }
        }
        xmlhttp.open('GET', 'ajax/dbTable.php', true);
        xmlhttp.send();
    }
    window.setInterval(function(){
        load();
    },500);
</script>
</body>
</html>