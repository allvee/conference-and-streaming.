<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 1/23/2016
 * Time: 3:52 PM
 */

include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_participant";
$participant_conference_name = $_SESSION['conf_name'];
$conference_id = $_SESSION['conf_id'];


$query="SELECT COUNT(ID) as cnt FROM tbl_participant WHERE conference_ID='$conference_id'";

$result = Sql_exec($cn, $query);

while ($row = Sql_fetch_array($result))
{
    $count = $row['cnt'];
}

Sql_Free_Result($result);
ClosedDBConnection($cn);

echo json_encode($count);

?>