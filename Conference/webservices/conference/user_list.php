<?php

include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_user_management";

$arrayInput = array();
$query = "SELECT 	ID, Name, Type, Create_Date, Group_Name, Status FROM $tbl";
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
    $data[$i][$j++] = Sql_Result($row, "Name");
    $data[$i][$j++] = Sql_Result($row, "Type");
    $data[$i][$j++] = Sql_Result($row, "Create_Date");
    $data[$i][$j++] = Sql_Result($row, "Group_Name");
   	$data[$i][$j++] = Sql_Result($row, "Status");

	 $info = '' . Sql_Result($row, "ID") . '|' . Sql_Result($row, "Name") .'|' .Sql_Result($row, "Type") . '|' . Sql_Result($row, "Create_Date") . '|' . Sql_Result($row, "Group_Name") .  '|' . Sql_Result($row, "Status") ;

    $data[$i][$j++] = '<span onclick="edit_user_list(this,\'' . Sql_Result($row, "ID") . '\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_user_list(this,' . Sql_Result($row, "ID") . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="conference/img/cancel.png" ></span>';


    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);

?>
