
<?php
if(isset($_GET['operator'])){
    $operator=$_GET['operator'];
    $filename=$operator." ".date("d-m-y");
    if($operator=='roshan'){
        $startswith=array(9379,9372);
    }
    if($operator=='etisalat'){
        $startswith=array(9378);
    }
    if($operator=='awec'){
        $startswith=array(9370);
    }
    if($operator=='mtn'){
        $startswith=array(9377,9376);
    }
    if($operator=='salaam'){
        $startswith=array(9374);
    }if($operator=='all'){
        $startswith=array('roshan'=>array(9379,9372),
            'etisalat'=>array(9378),
            'awec'=>array(9370),
            'mtn'=>array(9377,9376),
            'salaam'=>array(9374));
        print_r($startswith);
    }

    include_once '../dbconnection.php';
    $con=openconnection();
    $sqlstatus="SELECT status from select_db";
    $resultstatus=$con->query($sqlstatus);
    while($row=$resultstatus->fetch_assoc()) {
        $pd = $row['status'];
    }
    $i=0;
    foreach ($startswith as $value) {
        $sql = "SELECT pbl,hh_ful,first_name,father_name,document_number,phone_number,
                alternate_name,alternate_document FROM $pd where status='ntn' and phone_number like '$value%'";
        $result = $con->query($sql);
        $items = array();
        $columnheader = '';
        $columnheader = "PBL" . "\t" . "Household"
            . "\t" . "Name"
            . "\t" . "Father Name"
            . "\t" . "Document Number"
            . "\t" . "Phone Number"
            . "\t" . "Alternate Name"
            . "\t" . "Alternate Document";
        $setData = '';
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $rowData = '';
                foreach ($row as $value) {
                    $value = '"' . $value . '"' . "\t";
                    $rowData .= $value;
                }
                $setData .= trim($rowData) . "\n";
            }

        }
        if($i==0){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=$pd.$filename.xls");
        header("Pragma:no-cache");
        header("Expires:0");
            $i++;
        }
        echo ucwords($columnheader) . "\n" . $setData . "\n";
    }


    if(isset($_GET['operator'])){
        $operator=$_GET['operator'];
        if($operator=='roshan'){
            $startswith=array(9379,9372);
        }
        if($operator=='etisalat'){
            $startswith=array(9378);
        }
        if($operator=='awec'){
            $startswith=array(9370);
        }
        if($operator=='mtn'){
            $startswith=array(9377,9376);
        }
        if($operator=='salaam'){
            $startswith=array(9374);
        }if($operator=='all'){
            $startswith=array('roshan'=>array(9379,9372),
                'etisalat'=>array(9378),
                'awec'=>array(9370),
                'mtn'=>array(9377,9376),
                'salaam'=>array(9374));
            print_r($startswith);
        }

        if($operator=='all'){
            foreach($startswith as $key=>$valuee){

            $filename=$operator." ".date("d-m-y");
            $operator=$_GET['operator'];


            $sqlstatus="SELECT status from select_db";
            $resultstatus=$con->query($sqlstatus);
            while($row=$resultstatus->fetch_assoc()) {
                $pd = $row['status'];
            }
                $i=0;
                foreach ($valuee as $value) {
                $sql = "SELECT pbl,hh_ful,first_name,father_name,document_number,phone_number,
                alternate_name,alternate_document FROM $pd where status='ntn' and phone_number like '$value%'";
                $result = $con->query($sql);
                $items = array();
                $columnheader = '';
                $columnheader = "PBL" . "\t" . "Household"
                    . "\t" . "Name"
                    . "\t" . "Father Name"
                    . "\t" . "Document Number"
                    . "\t" . "Phone Number"
                    . "\t" . "Alternate Name"
                    . "\t" . "Alternate Document";
                $setData = '';
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rowData = '';
                        foreach ($row as $value) {
                            $value = '"' . $value . '"' . "\t";
                            $rowData .= $value;
                        }
                        $setData .= trim($rowData) . "\n";
                    }

                }
                if($i==0){
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: attachment; filename=$pd.$filename.xls");
                    header("Pragma:no-cache");
                    header("Expires:0");
                    $i++;
                }
                echo ucwords($columnheader) . "\n" . $setData . "\n";
            }

        }
    }}
}
?>