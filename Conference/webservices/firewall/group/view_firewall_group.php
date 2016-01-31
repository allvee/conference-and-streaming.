<?php

header('Access-Control-Allow-Origin: *');
include_once "../../lib/common.php";
$cn = connectDB();

$user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];

$arrayInput = array();

if($user_type == "Super User")
    $query = "SELECT * FROM groups where status='active'";
else if($user_type == "Administrator")
    $query = "SELECT * FROM groups where status='active' AND( public = '1' OR org_id IN ($org_id)) ";
else
    $query = "SELECT * FROM groups where status='active' AND (public = '1' OR user_id ='$user_id')";

$result = Sql_exec($cn, $query);
if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Group'], true);


$data = array();
$i = 0;
while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $data[$i][$j++] = Sql_Result($row, "type");
    $group_name = Sql_Result($row, "name");
    $group_name = str_replace("__", "", $group_name);
    $data[$i][$j++] = $group_name;

    $read_only = Sql_Result($row, "read_only");
    if($read_only)
        $data[$i][$j++] = "";
    else
        $data[$i][$j++] = Sql_Result($row, "content");


    $action_data = '';
    $action_data .= '<span onclick="view_group_content(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/view.png" ></span>';
    if($read_only){
      $action_data .= '';
    }
    else if($is_super_admin == false && $permission_array['edit'] == 'yes') {
        $action_data .= '<span onclick="edit_input_form_firewall_group(this,' . "'" . Sql_Result($row, "id") . "'".","."'".Sql_Result($row, "public")."'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '<span onclick="edit_input_form_firewall_group(this,' . "'" . Sql_Result($row, "id") . "'".","."'".Sql_Result($row, "public")."'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    }

    if($is_super_admin == false && $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_group(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_group(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    }
    if(empty($action_data))
        $action_data .= '';

    $data[$i][$j++] = $action_data;


    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
?>