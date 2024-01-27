<?php
$selected_location="Nahia_08";
session_start();
include_once 'drafts/dbconnection.php';
$con=openconnection();
$logininfo=$_SESSION['logged_in'];
$pd='data';
$date='20'.date('y-m-d');
$sql="SELECT id FROM users WHERE username='$logininfo'";
$result=$con->query($sql);
$row=$result->fetch_assoc();
$user_id=$row['id'];
?>
<html>
<!--           GETS METHODS       -->
<?php
if(isset($_GET['notthisone'])){
    $status=$_GET['notthisone'];
    if($status=='on'){
        echo "<script>document.getElementById('household').disabled=false</script>";
    }
}

if(isset($_GET['problem'])) {
    $addid = $_GET['problem'];
    echo "<script>document.getElementById('household').disabled=false</script>";
    echo "<script>document.getElementById('household').autofocus=true</script>";
    $sql = "UPDATE $pd set status=1 WHERE pbl=$addid";
    $con->query($sql);
}

if(isset($_GET['addidpbl'])){
    $addid=$_GET['addidpbl'];
    $sql="SELECT pbl from highlighted where pbl='$addid'";
    $result=$con->query($sql);
    if($result->num_rows>0){
        header("location:highlight.php?Already Received");
    }else{
        $sql="INSERT INTO highlighted (pbl,user_id) VALUES ($addid,$user_id)";
        $result=$con->query($sql);
    }
    $sql="UPDATE $pd SET status=1 WHERE pbl=$addid";
    $result=$con->query($sql);
    $filename="files/data.txt";
    if(file_exists($filename)){
        $file= fopen($filename,'a');
        $write="$addid, $logininfo,$date;\n";
        fwrite($file,$write);
    }else{
        echo " <script>alert('file does not exist')</script>";
    }
}

if(isset($_GET['deleteidpbl'])){
    $deleteid=$_GET['deleteidpbl'];
    $sql="DELETE FROM highlighted WHERE pbl=$deleteid";
    $result=$con->query($sql);
    $sql="UPDATE $pd SET status2=0 WHERE pbl=$deleteid";
    $result=$con->query($sql);
    $pd_delete='data_delete';
    $filename="files/data_highlight_delete.txt";
    if(file_exists($filename)){
        $file= fopen($filename,'a');
        $write="$deleteid, $logininfo,$date;\n";
        fwrite($file,$write);
    }else{
        echo " <script>alert('file does not exist')</script>";
    }
}
?>
<head>
    <title>Home</title>
    <?php
    if(!$_SESSION['logged_in']){
        header("location:index.php");
    }
    ?>
    <style>

        *{
            font-family:sans-serif;
        }
        #tableduplicate{
            background-color:red;
            text-align:center;
            width:100%;
            color:white;
            font-family:arial;
            font-size:20pt;
            border-radius: 10px;
        }


        #customersduplicate {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customersduplicate td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customersduplicate tr:nth-child(even){background-color: #f2f2f2;}
        #customersduplicate tr:nth-child(odd){background-color: #f2f2f2;}

        #customersduplicate tr:hover {background-color: #ddd;}

        #customersduplicate th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: red;
            color: white;
        }



        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even){background-color: #f2f2f2;}
        #customers tr:nth-child(odd){background-color: #f2f2f2;}

        #customers tr:hover {background-color: #ddd;}

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }



        .div-container1100{
            width:80%;
        }
        section#hero {
            background-image: linear-gradient(#3491dd, #2d6898);
            color: #1d1d1d;
            font-family: Poppins, sans-serif;
        }
        h1 {
            color: #ffffff;
            font-family: Poppins, sans-serif;
            font-size: 64px;
        }
        .hero_text{
            height:14rem;
            display:flex;
            flex-direction:column;
            justify-content: center;
            align-items:center;

        }

        .receivebutton{
            cursor:pointer;
            font-size:16pt;
            align-self:center;
        }
        .hero_text p{
            color:white;
        }
        .search{
            display:flex;
            justify-content:center;
        }
        .search form{
            align-self:center;
        }
        .search form input{
            font-size:20pt;
        }
        .logout{
            float:right;
            margin-right:30px;
            font-size:18pt;
            margin-bottom:20px;
        }
        .search form button{
            background-color:  #149c85;
            color:  #ffffff;
            cursor: pointer;
            font-family: Poppins, sans-serif;
            font-size: 16px;
            font-weight: 700;
            font-size:20pt;
            text-transform: uppercase;
            transition: background 0.2s ease 0s;
        }
        .search form button:hover{
            background-color:#25dc96;
        }
        .display_data{
            margin-left:20px;
            margin-right:20px;
        }
        .second{
            color:white;
            font-family:arial;
            font-style: inherit;
        }

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
        .total{
            width:10rem;
            height:10rem;
            margin:auto;
            margin-top:50px;
            border:2px solid black;
        }
        .total h2{
            background-color:blue;
            text-align: center;
        }
        header p{
            margin-left:0px;
        }

        .login_as_admin{
            text-decoration: none;
            font-size:18pt;
            width:400px;
            text-align:end;
        }
        .dashboard{
            display:inline;
            width:available;
            color:black;
            margin-left:100px;
        }

        .dashboard:visited{
            color:black;
        }
        .dashboard:hover{
            background-color:lightgray;
        }
    </style>
</head>
<body>
<header>
    <div class="container-1100">
        <p style="display:inline"><b id="ochr">OCHR</b></p>
        <p style="display:inline">Organization for coordination of humanitarian relief</p>
        <div class="dashboard">
            <?php
            $logininfo=$_SESSION['logged_in'];
            if($logininfo=='abdullah'){
                echo "<a href='dashboardVersionOld.php' class='login_as_admin'>Dashboard</a>";
            }
            ?>
        </div>
    </div>
    <div class="logout" >
        <form method="post" action="logout.php">
            <input name="logout" type="hidden"/>
            <button type="submit" name="logout" >Logout</button>
        </form>
    </div>
</header>
<section id="hero">
    <div class="hero_text">
        <h1>Beneficiary Database</h1>
        <p>Be Carefull with receive ;)</p>
    </div>
    <div class="search">

        <form action="" method ="GET">
            <input type="text" autofocus autocomplete="off" name="household" id="household"/>
            <select name="selection" style="font-size:20pt;margin-bottom:20px;">
                <option value="1" selected>BPL</option>
            </select>
            <button type="submit" class="green-btn">Search</button>
        </form>
    </div>
    <div class="display_data">
        <?php
        if($con->connect_error){
            die("connection error");
        }
        if(isset($_GET['household']) || isset($_GET['addid']) || isset($_GET['deleteid'])){
            if(isset($_GET['addid'])){
                $household=$_GET['addid'];
            }elseif (isset($_GET['household'])) {
                $household = $_GET['household'];
            } elseif (isset($_GET['deleteidpbl'])) {
                $household = $_GET['deleteidpbl'];
            }
                if($household!=null){
                $sql="SELECT * FROM $pd where hh=$household and Location in ('$selected_location')";
            }else{
                echo "<script type='text/javascript'>
                                    alert('household cannot be empty!')
                               </script>";
            }
            if($_GET['selection']==1){
                $sql=" select * from $pd where pbl='$household';";
            }
            if(isset($_GET['addidpbl'])){
                $household=$_GET['addidpbl'];
                $sql="SELECT * FROM $pd WHERE pbl=$household";
            }
            if(isset($sql)){
                $result=$con->query($sql);
            }
            $_distribuation_state="undone";
            if($household!=null){
                if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                        $st=$row['status'];
                        switch ($st){
                            case 0:
                                $table_background_string='';
                                break;
                            case 1:
                                $table_background_string='color:red;';break;

                            case 3:
                                $table_background_string='background-color:red;color:white;'; break;
                            default:
                                $table_background_string='background-color:white;color:black;';
                        }
                            $fathername=$row['father_name'];
                        echo "<table border='2' id='tablechanging'  style='
                          font-size: 16pt;background-color:white; ".$table_background_string."width:100%;height:100px;
                          text-align: center; border-color:white'><tr>
                                        <td><b>PBL</b></td>
                                        <td><b>Household</b></td>
                                        <td><b>Name</b></td>
                                        <td><b>Last Name</b></td>
                                        <td><b>Document Number</b></td>
                                        <td><b>Phone Number</b></td>
                                        <td><b>Alternate Name</b></td>
                                        <td><b>Alternate Document</b></td>
                                        <td><b>Guzar</b></td>
                                        </tr>            
                                        <tr style='font-size: 14pt'>";
                        $hh=$row['hh'];
                        $location=$row['Location'];
                        $pbl=$row['pbl'];
                        if($row['status']!=3) {
                            echo "<td> $pbl </td>";
                        }else{
                            echo "<td> Refer to Admin</td>";
                        }
                        //Remove this for Nahia unrestriction
//                            if($location=='Nahia_12 010112'){
                        if(isset($row['alternate_name']) && isset($row['alternate_document'])){
                            $alternate_name=$row['alternate_name'];
                            $alternate_document=$row['alternate_document'];
                        }else{
                            $alternate_name='';
                            $alternate_document='';

                        }
                        echo "<td>".$row['hh_ful']."</td>
                                        <td>".$row['first_name']."</td>
                                        <td>".$fathername."</td>
                                        <td>".$row['document_number']."</td>
                                        <td>".$row['phone_number']."</td>
                                        <td>".$alternate_name."</td>
                         <td>" . $alternate_document . "</td>
                         <td>".$row['address']."</td>";
//                            }
                    if($logininfo=='abdullah') {
                        if($row['status']==0){
                            echo"<button class='receivebutton' style='font-size:16pt;' onclick='receivedButton(".$row['pbl'].");'>Received</button>";
                            echo "<script>document.getElementById('household').disabled=true</script>";
                        }
                        ?>
                        <script>
                            document.addEventListener('keydown',function(event) {
                                if (event.shiftKey && event.key==='S') {
                                    receivedButton(<?php echo $row['pbl']?>);
                                }
                            });

                            function receivedButton(pbl){
                                document.getElementById('household').disabled='false';
                                window.location.assign("highlight.php?addid="+ <?php echo $row['hh'] ;?> + "& addidpbl=" + pbl + " & household="+ <?php echo $row['hh'] ;?>+"&selection=1");
                            }
                        </script>

                        <!-- Not this one button -->
                    <?php
                    if($row['status']==0){
                    echo"<button style='font-size:16pt;cursor:pointer; float:right;' onclick='wrongHH();'>Wrong HH?</button>";
                    ?>
                        <script>
                            document.addEventListener('keydown',function(event) {
                                if (event.shiftKey && event.key==='W') {
                                    wrongHH();
                                }
                            });
                            function wrongHH(){
                                var wrongHH=confirm("Are you sure?");
                                if(wrongHH) {
                                    window.location.assign("highlight.php?notthisone=on");
                                }

                            }
                        </script>
                    <?php
                    }else if($row['status']==1){
                        echo "<button class='receivebutton' onclick='deleteButton(".$row['pbl'].");' style='cursor:pointer ;background-color: red;color:white;font-size:16pt;'>Delete</button>";
                        $_distribuation_state="done";
                    }}
                    ?>
                        <script>
                            function deleteButton(pbl){
                                var deletesure=window.confirm("delete the household from highlight?");
                                if(deletesure) {
                                    window.location.assign("highlight.php?deleteidpbl="+pbl+" & household=<?php echo $row['hh']?>"+"& selection=1");

                                }
                            }
                        </script>

                    <?php
                    if($logininfo=='abdullah' && $row['status']==3) {
                        echo"<button style='font-size:16pt; cursor:pointer' class='receivebutton' 
                            onclick=\"document.getElementById('household').disabled='false'\">
                            <a href='highlight.php?addid=".$row['hh']." & addidpbl=".$row['pbl']."& household=".$row['hh']."&problem_remove' 
                             style='text-decoration: none'>Received</a></button>";
                    }
                    if($logininfo=='abdullah'){
                    echo"<button class='receivebutton' onclick='problem();'>Problem</button>";
                    ?>
                        <!--Javascript for problem button -->
                        <script>
                            function problem(){
                                document.getElementById('household').disabled='false';
                                var reason = prompt("Please Enter The Reason!");
                                document.cookie = "reason="+reason;
                                var problemsure=confirm("are you sure you want to put the person on the problem");
                                if(problemsure==true){
                                    <?php
                                    echo "window.location.assign('highlight.php?addid=".$row['hh']."& problem=".$row['pbl']."& household=".$row['hh']."');";
                                    ?>
                                }else{
                                    alert("Not Added To Problem");
                                }
                            }
                        </script>
                        <?php
                    }
                        echo" </tr>";
                        echo "</table>";
                        if( $_distribuation_state == "done" ){
                            $_distribuation_state=="";
                        }
                    }

                }
            }
        }

        ?>

    </div>

</section>
<div class="total">
    <div class="first">
        <h1 align="center" style="font-size:40pt;color:black;">
            <?php
            $sql="SELECT * FROM received where user_id=$user_id and TIMESTAMP(time) like '%$date%'";
            $result=$con->query($sql);
            echo $result->num_rows;
            ?>
        </h1>

    </div>
    <div class="second">
        <h2>Today</h2>
    </div>
</div>
</body>
</html><?php ?>
