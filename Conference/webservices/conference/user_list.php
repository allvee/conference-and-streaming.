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


/*
include_once "../lib/config.php";


$file_name = $dir_softswitch_ippbx_config . "dialplan.ini";

$lines = file($file_name);
$latest_line = count($line) - 1;


$data = array();

if (count($lines)>0) {


    //
    $i = 0;
    $j = 0;
    $context = "";
    foreach ($lines as $index => $val) {


        if(preg_match("/\[.*\]/",$val)){

            //$data[$i][$j++] = $val;
            $context = $val;
           // echo $val."\n";

        }else{
            $j=0;
            //$arr = preg_split("/[\s]+/", $val);
            $arr = explode(" ", $val);
            $data[$i][$j++] = htmlspecialchars($context);
            $data[$i][$j++] = $arr[0];
            $data[$i][$j++] = $arr[1];
            $data[$i][$j++] = $arr[2];
            $data[$i][$j++] = '<span onclick="edit_input_form_dialplan_info(this,\'' . Sql_Result($row, "id") . '\'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="softswitch/img/pen.png" ></span>'
                . '&nbsp&nbsp' . '<span onclick="delete_dialplan_info(this,' . Sql_Result($row, "id") . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="softswitch/img/cancel.png" ></span>';
$i++;
        }


    }


}

//fclose($fl);

echo json_encode($data);




*/
?>
