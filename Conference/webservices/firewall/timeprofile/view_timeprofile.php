<?php
//session_start();
header('Access-Control-Allow-Origin: *');
require_once "../../lib/common.php";

$cn = connectDB();
$user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];

if($user_type == "Super User")
    $query = "SELECT * FROM time_profileinfo where status='active'";
else if($user_type == "Administrator")
    $query = "SELECT * FROM time_profileinfo where status='active' AND( public = '1' OR org_id IN ($org_id)) ";
else
    $query = "SELECT * FROM time_profileinfo where status='active' AND (public = '1' OR user_id ='$user_id')";

//$qry = "select * from `time_profileinfo` where `status`='active'";
$rs = Sql_exec($cn,$query);

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Time Profile'], true);

$data = array();
$i=0;
while($row = Sql_fetch_array($rs)){

    $j=0;
    $data[$i][$j++] = Sql_Result($row, "name");
    $dins = Sql_Result($row, "days");
    $din ='';
    $flag = 0;
    $days = explode(",",$dins);
    foreach($days as $day) {
        $day = trim($day);

        if ($flag == 1)
            $din .= ',';

        if ($day == 0)
            $din .= 'sunday';
        else if ($day == 1)
            $din .= 'monday';
        else if ($day == 2)
            $din .= 'tuesday';
        else if ($day == 3)
            $din .= 'wednesday';
        else if ($day == 4)
            $din .= 'thursday';
        else if ($day == 5)
            $din .= 'friday';
        else
            $din .= 'saturday';

        if ($flag == 0) {
            $flag = 1;
        }

    }

    $data[$i][$j++] = $din;
    $data[$i][$j++] = Sql_Result($row, "start_time");
    $data[$i][$j++] = Sql_Result($row, "end_time");

    // $data[$i][$j++] = '<span onclick="edit_input_form_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".","."'".Sql_Result($row, "public")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>'.'&nbsp&nbsp'.'<span onclick="delete_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';


    $action_data = '';
    if($is_super_admin == false && $permission_array['edit'] == 'yes') {
        $action_data = '<span onclick="edit_input_form_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".","."'".Sql_Result($row, "public")."'".","."'".Sql_Result($row, "days")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data = '<span onclick="edit_input_form_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".","."'".Sql_Result($row, "public")."'".","."'".Sql_Result($row, "days")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>';
    }

    if($is_super_admin == false && $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_timeprofile(this,'."'".Sql_Result($row, "id")."'".'); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';
    }
    if(empty($action_data))
        $action_data = '';

    $data[$i][$j++] = $action_data;


    $i++;
}

echo json_encode($data);
ClosedDBConnection($cn);


?>