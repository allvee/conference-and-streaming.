<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/19/2016
 * Time: 6:37 PM
 */

include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_participant";
$participant_conference_name = $_SESSION['conf_name'];

$arrayInput = array();
$query = "SELECT ID, participant_name, msisdn, email, conference_name, organization, participant_type FROM $tbl where conference_name='$participant_conference_name'";
$result = Sql_exec($cn, $query);
if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}
$data = array();
$i=0;
while ($row = Sql_fetch_array($result)) {
    $j=0;
    $data[$i][$j++] = Sql_Result($row, "ID");
    $data[$i][$j++] = Sql_Result($row, "participant_name");
    $data[$i][$j++] = Sql_Result($row, "msisdn");
    $data[$i][$j++] = Sql_Result($row, "email");
    $data[$i][$j++] = Sql_Result($row, "participant_type");
   // $data[$i][$j++] = Sql_Result($row, "conference_name");
   // $data[$i][$j++] = Sql_Result($row, "organization");

    $data[$i][$j++] = '<span onclick="edit_participant_list(this,  \'' . Sql_Result($row, "ID") .'\', \''.Sql_Result($row, "conference_name") . '\', \''.Sql_Result($row, "organization") . '\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_participant_list(this,  \'' . Sql_Result($row, "ID") .'\', \''.Sql_Result($row, "conference_name") . '\', \'' . Sql_Result($row, "organization") .'\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';


    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);

?>
