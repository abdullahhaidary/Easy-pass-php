<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export Phone Numbers</title>
    <style>
        header {
            background-color: #ffffff;
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
            padding-bottom:15px;
            padding-top:15px;
        }
        header p:first-child{
            margin-left:200px;
            font-size:20pt;
        }
        header p{
            margin-left:0px;
        }
        .body{
            display:flex;
            margin-bottom:50px;
            justify-content: space-around;

        }
        .total{
            width:10rem;
            height:10rem;
            border:2px solid black;
        }
        .first{
            display:inherit
            height:8rem;
            width:10rem;
        }
        .second{
            height:2rem;
            display:inherit;
            text-align:center;
            width:10rem;
            background-color:blue;
        }
        .totalall{
            width:10rem;
            height:10rem;
            border:2px solid black;
        }
        .firsttotal{
            display:inherit
            height:8rem;
            width:10rem;
        }
        .secondtotal{
            height:2rem;
            display:inherit;
            text-align:center;
            width:10rem;
            background-color:blue;
        }
        .second h2{
            font-color:white;
            color:white;
        }
        .data{
            display:flex;
            flex-direction: column;
        }

        .urlbutton{
            height:50px;
            width:340px;
            background-color:blue;
            font-size:20pt;
            margin:auto;
            border:2px solid white;
            color:white;
            border-radius: 10px;
            text-decoration: none;
            text-align:center;
        }
        .urlbutton:visited{
            color:white;
        }
        .urlbutton:hover{
            background-color:lightblue;
            font-size:22pt;
            font-weight: bold;
        }
        .buttons{
            display:inherit;
        }
        .distribuationdata{

        }
        .body{
            margin-top:50px;
            display:block;
        }
        </style>

</head>
<body>
<header>
    <div class="container-1100">
        <p style="display:inline"><b>OCHR</b></p>
        <p style="display:inline">Organization for coordination of humanitarian relief</p>
    </div>
</header>
<div class="body">
<!---------------Roshan -------------->
<div class="data">
    <a href="exportscript.php?operator=roshan" class="urlbutton">Roshan</a>
</div>

<!---------------Etisalat -------------->
<div class="data">
    <a href="exportscript.php?operator=etisalat" class="urlbutton">Etisalat</a>
</div>

<!---------------MTN -------------->
<div class="data">
    <a href="exportscript.php?operator=mtn" class="urlbutton">Mtn</a>
</div>

<!---------------Afghan Bisim -------------->
<div class="data">
    <a href="exportscript.php?operator=awec" class="urlbutton">Afghan Bisim</a>
</div>

<!---------------Salaam -------------->
<div class="data">
    <a href="exportscript.php?operator=salaam" class="urlbutton">Salaam</a>
</div>

<!---------------Others -------------->
<div class="data">
    <a href="exportscript.php?operator=others" class="urlbutton">Others</a>
</div>
    <div class="data">
        <a href="exportscript.php?operator=all" class="urlbutton">All</a>
    </div>
</div>
</body>
</html>

