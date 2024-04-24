<?php
$selected_location = "Nahia_08 010108";
session_start();
include_once 'dbconnection.php';
$con = openconnection();
$logininfo = $_SESSION['logged_in'];
$pd = 'data';
$date = '20' . date('y-m-d');
$sql_user = "SELECT id FROM users WHERE username='$logininfo'";
$result_user = $con->query($sql_user);
$row_user = $result_user->fetch_assoc();
$user_id = $row_user['id'];

//select the location from the file
$filePath = 'files/locations.txt';

if (file_exists($filePath)) {
    // Read the contents of the file and explode into an array
    $selectedLocations = explode(',', file_get_contents($filePath));
} else {
    $selectedLocations = [];
}
$selectedLocationsString = implode("','", $selectedLocations);

//end location selection from the fil


?>
<html>
<!--           GETS METHODS       -->
<?php
if (isset($_GET['notthisone'])) {
    $status = $_GET['notthisone'];
    if ($status == 'on') {
        echo "<script>document.getElementById('household').disabled=false</script>";
    }
}

if (isset($_GET['problem'])) {
    $addid = $_GET['problem'];
    echo "<script>document.getElementById('household').disabled=false</script>";
    echo "<script>document.getElementById('household').autofocus=true</script>";
    $sql = "UPDATE $pd set status=3 WHERE pbl=$addid";
    $con->query($sql);
}

if (isset($_GET['addidpbl_remain'])) {
    $addid = $_GET['addidpbl_remain'];
    $sql = "SELECT pbl from remain where pbl='$addid'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        header("location:home.php?Already Received");
    } else {
        $sql = "INSERT INTO remain (pbl,user_id) VALUES ($addid,$user_id)";
        $result = $con->query($sql);
    }
}
if (isset($_GET['fingerissuebpl'])) {
    $addid = $_GET['fingerissuebpl'];
    $sql = "SELECT pbl from remain where pbl='$addid'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        header("location:home.php?Already Received");
    } else {
        $sql = "INSERT INTO remain (pbl,user_id) VALUES ($addid,$user_id)";
        $result = $con->query($sql);
    }
}

if (isset($_GET['addidpbl_exclude'])) {
    $addid = $_GET['addidpbl_exclude'];
    $sql = "SELECT pbl from exclude where pbl='$addid'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        header("location:home.php?Already Received");
    } else {
        $sql = "INSERT INTO exclude (pbl,user_id) VALUES ($addid,$user_id)";
        $result = $con->query($sql);
    }
}

if (isset($_GET['addidpbl'])) {
    $addid = $_GET['addidpbl'];
    $sql = "SELECT pbl from received where pbl='$addid'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        header("location:home.php?Already Received");
    } else {
        $sql = "INSERT INTO received (pbl,user_id) VALUES ($addid,$user_id)";
        $result = $con->query($sql);
    }
    $sql = "UPDATE $pd SET status=1 WHERE pbl=$addid";
    $result = $con->query($sql);
    $filename = "files/data.txt";
    if (file_exists($filename)) {
        $file = fopen($filename, 'a');
        $write = "$addid, $logininfo,$date;\n";
        fwrite($file, $write);
    } else {
        echo " <script>alert('file does not exist')</script>";
    }
}

if (isset($_GET['deleteidpbl'])) {
    $deleteid = $_GET['deleteidpbl'];
    $sql = "DELETE FROM received WHERE pbl=$deleteid";
    $result = $con->query($sql);
    $sql = "UPDATE $pd SET status=0 WHERE pbl=$deleteid";
    $result = $con->query($sql);
    $pd_delete = 'data_delete';
    $filename = "files/$pd_delete";
    if (file_exists($filename)) {
        $file = fopen($filename, 'a');
        $write = "$deleteid, $logininfo,$date;\n";
        fwrite($file, $write);
    } else {
        echo " <script>alert('file does not exist')</script>";
    }
}
?>
<head>
    <title>Home</title>
    <?php
    if (!$_SESSION['logged_in']) {
        header("location:index.php");
    } else if ($_SESSION['logged_in'] == 'highlight') {
        header("location:highlightF.php");
    }
    ?>
    <link rel="stylesheet" href="css/homeStyle.css">
</head>
<body>
<header>
    <div class="container-1100">
        <p style="display:inline"><b id="ochr">OCHR</b></p>
        <p style="display:inline">Organization for coordination of humanitarian relief</p>
        <div class="dashboard">
            <?php
            $logininfo = $_SESSION['logged_in'];
            if ($logininfo == 'abdullah') {
                echo "<a href='dashboard.php' class='login_as_admin'>Dashboard</a>";
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
            <input type="text" autofocus
                <?php
                if (isset($_GET['addid'])) {
                    echo 'autofocus';
                }
                ?>
                   autocomplete="off" name="household" id="household"/>
            <select name="selection" style="font-size:20pt;margin-bottom:20px;">
                <?php if (isset($_GET['selection'])) {
                    $selection = $_GET['selection'];
                } ?>
                <option value="1" <?php
                if (!isset($_GET['selection'])) {
                    $selection = 1;
                }
                if ($selection == 1) {
                    echo "selected";
                }
                if ($logininfo != 'tarin')
                    echo "selected"; ?> selected>Household</option>
                <option value="2" <?php if ($selection == 2 && $logininfo != 'tarin') {
                    echo "";
                } ?> >Tazkira Number</option>
                <option value="3" <?php if ($selection == 3 && $logininfo != 'tarin') {
                    echo "selected";
                }
                if ($logininfo == 'tarin')
                    echo ""; ?> >Current BPL</option>
                <option value="4"<?php if ($selection == 4 && $logininfo != 'tarin') {
                    echo "selected";
                } ?>>Name</option>
                <option value="5" <?php if ($selection == 5 && $logininfo != 'tarin') {
                    echo "selected";
                } ?>>Phone Number</option>
                <option value="6" <?php if ($selection == 6 && $logininfo != 'tarin') {
                    echo "selected";
                } ?>>FatherName</option>
            </select>
            <script type="text/javascript">
                <?php
                if (isset($_GET['household'])) {
                    $household = $_GET['household'];
                }
                ?>
            </script>
            <button type="submit" class="green-btn">Search</button>
        </form>
    </div>
    <div class="display_data">
        <?php
        if ($con->connect_error) {
            die("connection error");
        }
        if (isset($_GET['household']) || isset($_GET['addid']) || isset($_GET['deleteid'])) {
            if (isset($_GET['addid'])) {
                $household = $_GET['addid'];
            } elseif (isset($_GET['household'])) {
                $household = $_GET['household'];
                if (!($selection == 4 || $selection == 6)) {
                    if ($household != null && $household != '') {
                        $sql = "UPDATE $pd set searchedby='$logininfo' WHERE hh=$household";
                        $con->query($sql);
                        $date = date("d-m-y");
                        $sql2 = "UPDATE $pd set searcheddate='$date' WHERE hh=$household";
                        $con->query($sql2);
                    }
                }
            } elseif (isset($_GET['deleteid'])) {
                $household = $_GET['deleteid'];
            }
            if (isset($_GET['selection'])) {
                $selection = $_GET['selection'];
            }

            if ($household != null) {
                $sql = "SELECT * FROM $pd WHERE hh = $household AND Location IN ('$selectedLocationsString')";
                if ($logininfo == 'abdullah') {
                    $sql = "SELECT * FROM $pd WHERE hh = $household AND Location IN ('$selectedLocationsString')";
                }
            } else {
                echo "<script type='text/javascript'>
                                    alert('household cannot be empty!')
                               </script>";
            }
            if ($selection == 2) {
                $sql = " select * from $pd where document_number like '%$household%' AND Location in ('$selected_location');";
            }
            if ($selection == 3) {
                $sql = " select * from $pd where pbl='$household';";
            }
            if ($selection == 4) {
                $sql = " select * from $pd where first_name like '%$household%';";
            }
            if ($selection == 5) {
                $sql = " select * from $pd where phone_number like '%$household%';";
            }
            if ($selection == 6) {
                $sql = " select * from $pd where father_name like '%$household%';";
            }
            if (isset($_GET['addidpbl'])) {
                $household = $_GET['addidpbl'];
                $sql = "SELECT * FROM $pd WHERE pbl=$household";
            }
            if (isset($sql)) {
                $result = $con->query($sql);
            }
            $_distribuation_state = "undone";
            if ($household != null) {

                if ($result->num_rows > 0) {
                    $i = 0;
                    $count = 0;
                    while ($row = $result->fetch_assoc()) {

                        $st = $row['status'];
                        switch ($st) {
                            case 0:
                                $table_background_string = '';
                                break;
                            case 1:
                                $table_background_string = 'color:red;';
                                break;

                            case 3:
                                $table_background_string = 'background-color:red;color:white;';
                                break;
                            default:
                                $table_background_string = 'background-color:white;color:black;';
                        }
                        $pbl = $row['pbl'];
                        if($pbl>11335){
                                $table_background_string = 'background-color:blue;color:black;';
                        }

                        $fathername = $row['father_name'];
                        echo "<table border='2' id='tablechanging'  style='
                          font-size: 16pt;background-color:white; " . $table_background_string . "width:100%;height:100px;
                          text-align: center; border-color:white'><tr>
                                        <td><b>PBL</b></td>
                                        <td><b>Household</b></td>
                                        <td><b>Name</b></td>
                                        <td><b>Last Name</b></td>
                                        <td><b>Document Number</b></td>
                                        <td><b>Phone Number</b></td>
                                        <td><b>Alternate Name</b></td>
                                        <td><b>Alternate Document</b></td>
                                        <td><b>Location</b></td>
                                        <td><b>Guzar</b></td>";
                        echo "</tr>            
                                        <tr style='font-size: 14pt'>";
                        $hh = $row['hh'];
                        $location = $row['Location'];
                        if ($row['status2'] == 3) {
                            echo "<td style='background-color:red; color:white'> $pbl </td>";
                        } else {
                            if ($row['status'] != 3) {
                                echo "<td> $pbl </td>";
                            } else {
                                echo "<td> Refer to Admin</td>";
                            }
                        }

                        //Remove this for Nahia unrestriction
//                            if($location=='Nahia_12 010112'){
                        if (isset($row['alternate_name']) && isset($row['alternate_document'])) {
                            $alternate_name = $row['alternate_name'];
                            $alternate_document = $row['alternate_document'];
                        } else {
                            $alternate_name = '';
                            $alternate_document = '';

                        }
                        echo "<td>" . $row['hh_ful'] . "</td>
                                        <td>" . $row['first_name'] . "</td>
                                        <td>" . $fathername . "</td>
                                        <td>" . $row['document_number'] . "</td>
                                        <td>" . $row['phone_number'] . "</td>
                                        <td>" . $alternate_name . "</td>
                         <td>" . $alternate_document . "</td>
                         <td>" . $row['address'] . "</td>
                         <td>" . $row['Location'] . "</td>";
                        //                            }
                        if ($logininfo == 'abdullah' || $row['status'] != 3) {
                            if ($row['status'] == 0 && $logininfo != 'tarin') {
                                echo "<button class='receivebutton' style='font-size:16pt;' onclick='receivedButton(" . $row['pbl'] . ");'>Received</button>";

                                echo "<script>document.getElementById('household').disabled=true</script>";
                            }
                            ?>
                                                                                    <script>
                                                                                        <?php
                                                                                        if ($result->num_rows == 1) {
                                                                                            ?>
                                                                                                    document.addEventListener('keydown',function(event) {
                                                                                                        if (event.shiftKey && event.key==='S') {
                                                                                                            receivedButton(<?php echo $row['pbl'] ?>);
                                                                                                        }
                                                                                                        if(event.shiftKey && event.key==='D'){
                                                                                                        FingerIssueBPL(<?php echo $row['pbl'] ?>);
                                                                                                        }
                                                                                                    });
                                                                                                    <?php
                                                                                        }
                                                                                        ?>
                                                                                        function receivedButton(pbl){
                                                                                            document.getElementById('household').disabled='false';
                                                                                            window.location.assign("home.php?addid="+ <?php echo $row['hh']; ?> + "& addidpbl=" + pbl + " & household="+ <?php echo $row['hh']; ?>);
                                                                                        }
                                                                                    </script>

                                                                                    <!-- Not this one button -->
                                                                    <?php
                                                                    if ($row['status'] == 0 && $logininfo != 'tarin') {
                                                                        echo "<button style='font-size:16pt;cursor:pointer; float:right;' onclick='wrongHH();'>Wrong HH?</button>";
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
                                                                                                            window.location.assign("home.php?notthisone=on");
                                                                                                        }

                                                                                                    }


                                                                                                </script>
                                                                                            <?php
                                                                    } else if ($row['status'] == 1 && $logininfo != 'tarin') {
                                                                        echo "<button class='receivebutton' onclick='deleteButton(" . $row['pbl'] . ");' style='cursor:pointer ;background-color: red;color:white;font-size:16pt;'>Delete</button>";
                                                                        $_distribuation_state = "done";
                                                                    }
                        }
                        if ($logininfo == 'tarin') {
                            $pbl = $row['pbl'];
                            $sqlFinger = "SELECT * FROM remain WHERE pbl=$pbl";
                            $resultFinger = $con->query($sqlFinger);
                            if (!$resultFinger->num_rows > 0) {
                                echo "<button class='receivebutton' onclick='FingerIssueBPL(" . $row['pbl'] . ");' style='cursor:pointer ;background-color: red;color:white;font-size:16pt;'>Finger ISSUE</button>";
                            }
                        }
                        ?>
                                                                        <script>
                                                                            function deleteButton(pbl){var deletesure=window.confirm("delete the household from highlight?");
                                                                                if(deletesure) {
                                                                                    window.location.assign("home.php?deleteidpbl="+pbl+" & household=<?php echo $row['hh'] ?>");

                                                                                }
                                                                            }

                                                                            function FingerIssueBPL(pbl){
                                                                                        window.location.assign("home.php?fingerissuebpl=" + pbl + " & household=<?php echo $row['hh'] ?>");
                                                                            }
                                                                        </script>

                                                                    <?php
                                                                    if ($logininfo == 'abdullah' && $row['status'] == 3) {
                                                                        echo "<button style='font-size:16pt; cursor:pointer' class='receivebutton' 
                            onclick=\"document.getElementById('household').disabled='false'\">
                            <a href='home.php?addid=" . $row['hh'] . " & addidpbl=" . $row['pbl'] . "& household=" . $row['hh'] . "&problem_remove' 
                             style='text-decoration: none'>Received</a></button>";
                                                                    }
                                                                    if ($logininfo == 'abdullah') {
                                                                        echo "<button class='receivebutton' onclick='problem();'>Problem</button>";
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
                                                                                                echo "window.location.assign('home.php?addid=" . $row['hh'] . "& problem=" . $row['pbl'] . "& household=" . $row['hh'] . "');";
                                                                                                ?>
                                                                                            }else{
                                                                                                alert("Not Added To Problem");
                                                                                            }
                                                                                        }
                                                                                    </script>
                                                                                    <?php
                                                                    }
                                                                    echo " </tr>";
                                                                    echo "</table>";
                                                                    if ($_distribuation_state == "done") {
                                                                        $_distribuation_state == "";
                                                                    }
                    }

                } else {
                    // SQL query to select everything from the "error_report" table
                    $sql = "SELECT * FROM error_report WHERE hh=$household";
                    $result = $con->query($sql);

                    // Check if there are rows in the result
                    if ($result->num_rows > 0) {
                        // Start creating the HTML table
                        echo "<table style='color:black; border-radius:5px; ;background-color:white;text-align:center' border='1'><tr><th>Household</th><th>First Name</th><th>Last Name</th><th>Error</th></tr>";

                        // Output data of each row
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["Household Name"] . "</td>";
                            echo "<td>" . $row["First Name"] . "</td>";
                            echo "<td>" . $row["Last Name"] . "</td>";
                            echo "<td style='font-weight:bold;color:red'>" . $row["Error"] . "</td>";
                            echo "</tr>";
                        }

                        // Close the table
                        echo "</table>";
                    } else {
                        $sql = "SELECT * FROM data WHERE hh=$household";
                        $result = $con->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // echo '<div class="alert alert-info" role="alert">The Result Found in an Unsupported Location</div>';
                                echo '<div style="padding: 15px; margin-bottom: 20px; border: 1px solid #bce8f1;
                             border-radius: 4px; color: #31708f; background-color: #d9edf7; text-align:center;
                             " role="alert"><b>Name:'
                                    . $row['first_name'] .
                                    ', Father Name: '
                                    . $row['father_name'] .
                                    '</b> Record is currently <span style="color:red">inActive</span> </div>';
                            }
                        } else {
                            echo '<div style="width:90%;margin:auto; border-radius:4px; box-shadow:3px 3px 3px rgba(0,0,0,0.3) ; background-color:red; color:white; padding:1vh 2vh; text-align:center;font-weight:bolder">No matching record found . . .</div>';

                        }
                    }

                    // Close the database connection
        
                    ?>
                                                        <!-- <h1>Not Found</h1> -->
                                                        <?php
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
            $date = '20' . date('y-m-d');
            $sql = "SELECT * FROM received where user_id=$user_id and TIMESTAMP(time) like '%$date%'";
            $result = $con->query($sql);
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
<script>
    document.addEventListener('keydown',function(event){
        if(event.ctrlKey && event.shiftKey && event.key==){

        }
    })
</script>