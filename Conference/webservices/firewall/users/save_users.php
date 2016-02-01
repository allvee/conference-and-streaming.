<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 16-Nov-15
 * Time: 1:18 PM
 */


require_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/functions.php";

$cn = connectDB();

$tbl = 'users';

$action = mysql_real_escape_string(htmlspecialchars($_REQUEST['action']));


$data_info = isset($_REQUEST['info']) ? $_REQUEST['info'] : 'action';

if ($data_info != 'action') {
    $action = $data_info['action'];
    $deleted_id = $data_info['deleted_id'];
}

$action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));
$full_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_full_name']));
$user_name = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_id']));
$password = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_password']));
$email = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_email']));
$status = mysql_real_escape_string(htmlspecialchars($_REQUEST['status']));
$user_type = mysql_real_escape_string(htmlspecialchars($_REQUEST['user_user_type']));

if($_SESSION['firewall']['user_type'] == 'Super User') {
    $parent_user_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['parent_userid']));
} else
    $parent_user_id = $_SESSION['firewall']['id'];



if (isset($_REQUEST['user_orgs'])) {
    $i = 0;
    foreach ($_REQUEST['user_orgs'] as $organizations) {
        $orgs[$i++] = $organizations;
    }

}

$no_of_orgs = count($orgs);
$orgs_string = '';
for ($i = 0; $i < $no_of_orgs; $i++) {
    if ($i != ($no_of_orgs - 1)) {
        $orgs_string = $orgs_string . $orgs[$i] . ',';
    } else {
        $orgs_string = $orgs_string . $orgs[$i];
    }

}


$is_error = 0;
$last_updated = date('Y-m-d H:i:s');
$created_by = $_SESSION["UserID"];


if ($action == 'delete') {
    if ($deleted_id != '') {
        $action_id = $deleted_id;
    }

    /*  $options['cn'] = $cn;
      $options['page_name'] = "Firewall Users";
      $options['action_type'] = $action;
      $options['table'] = "users";
      $options['id_value'] = $action_id;
      setHistory($options);*/


    $qry = "update  `users` set `status`='inactive', last_updated='$last_updated', created_by='$created_by'";
    $qry .= " where id='$action_id'";

} else if ($action == 'update') {
    $action_id = mysql_real_escape_string(htmlspecialchars($_REQUEST['action_id']));

    /*  $options['cn'] = $cn;
      $options['page_name'] = "Firewall Users";
      $options['action_type'] = $action;
      $options['table'] = "users";
      $options['id_value'] = $action_id;
      setHistory($options);*/

    $qry = "update `users` set `Name` = '$full_name',login_id = '$user_name',email = '$email',user_type = '$user_type',parent_user_id = '$parent_user_id',org_ids='$orgs_string',last_updated='$last_updated', created_by='$created_by', `status`='active'";
    $qry .= " where id='$action_id'";

} else {
    $qry = "insert into `users` (`Name`,login_id,`password`,email,user_type,parent_user_id,org_ids,last_updated,created_by,`status`)";
    $qry .= " values ('$full_name','$user_name',md5('$password'),'$email','$user_type','$parent_user_id','$orgs_string','$last_updated','$created_by','active')";
}

try {
    $res = Sql_exec($cn, $qry);
    /*   if (($action != 'update') && ($action != 'delete')) {
           $action_id = Sql_insert_id($cn);
           $action = 'add';
           $options['page_name'] = "Firewall Users";
           $options['action_type'] = $action;
           $options['table'] = "users";
           $options['id_value'] = $action_id;
           setHistory($options);
       }*/
} catch (Exception $e) {
    $is_error = 1;
}


if ($action == "insert") {
    $id_from_users_tbl = Sql_insert_id($cn);

    foreach ($orgs as $org_id) {

        $query = "INSERT INTO `org_users` (org_id, user_id) VALUES ('$org_id','$id_from_users_tbl'); ";
        try {
            $result = Sql_exec($cn, $query);
            mysql_free_result($result);
        } catch (Exception $e) {
            $is_error = 1;
        }

    }
} else if ($action == "update") {
    $dlt_qry = "DELETE FROM `org_users` WHERE user_id = '$action_id';";
    try {
        $result = Sql_exec($cn, $dlt_qry);
        mysql_free_result($result);
    } catch (Exception $e) {
        $is_error = 1;
    }
    foreach ($orgs as $org_id) {
        $insrt_qry = "INSERT INTO `org_users` (org_id, user_id) VALUES ('$org_id','$action_id');";
        try {
            $result = Sql_exec($cn, $insrt_qry);
            mysql_free_result($result);
        } catch (Exception $e) {
            $is_error = 1;
        }

    }


} else if ($action=="delete") {

    $dlt_qry = "DELETE FROM `org_users` WHERE user_id = '$action_id';";
    try {
        $result = Sql_exec($cn, $dlt_qry);
        mysql_free_result($result);
    } catch (Exception $e) {
        $is_error = 1;
    }

}


if ($is_error == 0) {
    $return_data = array('status' => true, 'message' => 'Successful.');
} else {
    $return_data = array('status' => false, 'message' => ' Unsuccessful');
}

echo json_encode($return_data);
ClosedDBConnection($cn);