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
$participant_conference_name = $_SESSION['conference']['conf_name'];

$conference_id=null;

if (isset($_REQUEST['info'])) {
    $conference_id = $_REQUEST['info'];
} else {
    $conference_id = $_SESSION['conference']['conf_id'];
}


$arrayInput = array();
$query = "SELECT  participant_name, msisdn, email FROM $tbl where conference_ID ='$conference_id'";
$result = Sql_exec($cn, $query);
//exit(__LINE__."$query");
/*if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}*/

//echo __FILE__.__LINE__;
$data = array();
$i = 0;
while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "participant_name");
    $data[$i][$j++] = Sql_Result($row, "msisdn");
    $data[$i][$j++] = Sql_Result($row, "email");
    $i++;
    //print_r($_SESSION);
    if ($_SESSION['conference']['notification']['IVR'] == true) {
        $participant_name = $row['participant_name'];
        $msisdn = $row['msisdn'];
        $long_code = $_SESSION['conference']['long_code'];

        $qry = "insert into $Call_Handler_DB.outdialque set MSISDN = '$msisdn',DisplayAno = '$long_code',OriginalAno = '2008',
ServiceId = 'OBD_Test', OutDialStatus = 'QUE', RetTryCount='1',UserId = '$conference_id', OutDialTime = NOW()";
        //echo $qry.__LINE__.__FILE__."\n";
        //logcats("Query: ".$qry);
        $ret = Sql_exec($cn,$qry);
        //logcats("Insert: ".$ret);
        //echo $ret.__LINE__.__FILE__."\n";
        Sql_Free_Result($ret);

    }
}

Sql_Free_Result($result);
ClosedDBConnection($cn);
//$json_data = json_encode($data);
//echo __FILE__.__LINE__;
if ($is_error == 0) {
    $return_data = array('status' => true, 'data' => $data);
} else {
    $return_data = array('status' => false, 'message' => 'Data Not Send.');
}

echo json_encode($return_data);
