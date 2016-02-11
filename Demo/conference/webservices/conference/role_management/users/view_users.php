<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 16-Nov-15
 * Time: 5:23 PM
 */


include_once "../../../lib/common.php";
$cn = connectDB();
$query = "SELECT * FROM `users` WHERE status = 'active';";
$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
$permission_array = json_decode($firewall_session['rules']['Role Management'], true);
$data = array();
$i = 0;

while ($row = Sql_fetch_array($result)) {
    $j = 0;
    $str_org_ids = Sql_Result($row, "org_ids");
    if(!empty($str_org_ids)){
        $org_id_user_table = explode(",",$str_org_ids);
    }

    $data[$i][$j++] = Sql_Result($row, "Name");
    $data[$i][$j++] = Sql_Result($row, "login_id");
    $data[$i][$j++] = Sql_Result($row, "email");
    $data[$i][$j++] = Sql_Result($row, "user_type");
    $parent_id = Sql_Result($row, "parent_user_id");

    if(!empty($parent_id)){
        $qry_par = "SELECT * FROM `users` WHERE `id`='$parent_id';";
        $res_par = Sql_exec($cn, $qry_par);
        while ($rows_par = Sql_fetch_assoc($res_par)) {
            $parent_name = Sql_Result($rows_par, "Name");
        }
    }
    $data[$i][$j++] = $parent_name;

    $org_names = "";
    if(!empty($org_id_user_table)) {

        foreach($org_id_user_table as $org_id) {
            $qry = "SELECT * FROM `organization` WHERE `id`='$org_id'; ";
            $res = Sql_exec($cn, $qry);
            while ($rows = Sql_fetch_array($res)) {
                if($org_names==""){
                    $org_names = $org_names . Sql_Result($rows, "name");
                } else {
                    $org_names = $org_names .",". Sql_Result($rows, "name");
                }

            }
        }

    }


    $data[$i][$j++] = $org_names;

    $action_data = '';
    if($is_super_admin == false && $permission_array['edit'] == 'yes') {
        $action_data = '<span onclick="edit_firewall_users(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/pen.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data = '<span onclick="edit_firewall_users(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/pen.png" ></span>';
    }

    if($is_super_admin == false && $permission_array['delete'] == 'yes') {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_users(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/cancel.png" ></span>';
    } else if($is_super_admin == true) {
        $action_data .= '&nbsp&nbsp' . '<span onclick="delete_firewall_users(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/cancel.png" ></span>';
    }
    if(empty($action_data))
        $action_data = '';

    $data[$i][$j++] = $action_data;

    //. '&nbsp&nbsp' . '<span onclick="delete_firewall_users(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="vpn/img/cancel.png" ></span>';
    /*
        $data[$i][$j++] = '<button style="background-color: blue; margin: 2px;" onclick="edit_input_form_vpn_l2tp_server(this,\''.$info.'\'); return false;" class="btn btn-primary" type="button"> <i class="fa fa-pencil-square-o"></i> Edit
    </button>'.'<button style="background-color: #FF0000;margin: 2px;   " onclick="delete_vpn_l2tp_server(this,'.Sql_Result($row, "id").'); return false;" class="btn btn-primary" type="button"> <i class="fa fa-times"></i> Delete
    </button>';
       */
    $i++;
}


Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);