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
$query = "SELECT conference.ID, cdr1.ANo,cdr1.BNo, conference.Conf_Name,cdr1.startTime,cdr1.endTime,conference.Start_Time AS Conference_Strat,conference.End_Time AS Conference_End,conference.Conference_Duration AS Conference_Total_Duration
FROM conference_demo.tbl_conference AS conference, vsdp_2_1_1.cdr AS cdr1
WHERE cdr1.ANo IN(
SELECT msisdn 
FROM conference_demo.tbl_participant
WHERE conference_ID ='$conference_id')";

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
	date_default_timezone_set('Asia/Dhaka');
	$start= Sql_Result($row, "startTime");
    $dteStart = new DateTime($start);
    $dteEnd = new DateTime(Sql_Result($row, "endTime"));
    $dteDiff = $dteStart->diff($dteEnd);
    $duration = (string)$dteDiff->format("%H:%I:%S");
    $data[$i][$j++] = $duration;
    //$data[$i][$j++] = Sql_Result($row, "Conference_Total_Duration");
    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);



