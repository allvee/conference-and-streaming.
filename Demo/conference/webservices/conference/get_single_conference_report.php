<?php
/**
 * Created by IntelliJ IDEA.
 * User: Shiam
 * Date: 2/2/2016
 * Time: 6:26 PM
 */
include_once "../lib/common.php";
$cn = connectDB();

$info = $_REQUEST['info'];
$conference_id = $info['conference_id'];

$arrayInput = array();
$UserID = $_SESSION['conference']['id'];
$query = "SELECT conference.ID, cdr1.ANo, conference.Conf_Name,cdr1.startTime,cdr1.endTime,conference.Conference_Duration AS Conference_Total_Duration
FROM $Database.tbl_conference AS conference, $Call_Handler_DB.cdr AS cdr1
WHERE conference.long_number= cdr1.BNo and conference.ID = '$conference_id'";

$result = Sql_exec($cn, $query);


$data = array();

$i=0;
while ($row = Sql_fetch_array($result)) {
    $j=0;
    $data[$i][$j++] = Sql_Result($row, "ID");
    $data[$i][$j++] = Sql_Result($row, "ANo");
    $data[$i][$j++] = Sql_Result($row, "Conf_Name");
    $data[$i][$j++] = Sql_Result($row, "startTime");
    $data[$i][$j++] = Sql_Result($row, "endTime");
    $data[$i][$j++] = Sql_Result($row, "Conference_Total_Duration");
    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);



