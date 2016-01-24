<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/21/2016
 * Time: 4:47 PM
 */

include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_participant";
$participant_conference_name = $_SESSION['conf_name'];
$conference_id = $_SESSION['conf_id'];
$arrayInput = array();
$query = "SELECT  participant_name, msisdn, email FROM $tbl where conference_ID ='$conference_id'";
$result = Sql_exec($cn, $query);
/*if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}*/
$data = array();
$i = 0;
while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "participant_name");
    $data[$i][$j++] = Sql_Result($row, "msisdn");
    $data[$i][$j++] = Sql_Result($row, "email");
    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
//$json_data = json_encode($data);

if ($is_error == 0) {
    $return_data = array('status' => true, "data" => $data);
} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);
