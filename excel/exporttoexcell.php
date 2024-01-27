<?php
include_once '../dbconnection.php';
$con=openconnection();
    $pd = 'data';
$sql="SELECT data.pbl,hh_ful,first_name,father_name,document_number,phone_number,Location,address,received.time,received.user_id FROM $pd RIGHT JOIN received on $pd.pbl=received.pbl";
$result=$con->query($sql);
$items = array();
$columnheader='';
$columnheader="PBL"."\t"."Household"
    ."\t"."Name"
    ."\t"."Father Name"
    ."\t"."Document Number"
    ."\t"."Phone Number"
    ."\t"."Nahia"
    ."\t"."Location"
    ."\t"."Date And Time"
    ."\t"."User ID"
;
$setData='';
if($result->num_rows>0){
while($row = $result->fetch_assoc()){
    $rowData='';
    foreach($row as $value){
        $value='"'.$value.'"'."\t";
        $rowData.=$value;
    }
    $setData.=trim($rowData)."\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=myfile.xls");
header("Pragma:no-cache");
header("Expires:0");
echo ucwords($columnheader). "\n" .$setData."\n";
}
?>