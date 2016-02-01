<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 11/26/2015
 * Time: 5:11 PM
 */

header('Access-Control-Allow-Origin: *');
include_once "../../../lib/common.php";
$cn = connectDB();

$info = $_REQUEST['info'];
$role_id = $info['role'];

$arrayInput = array();

$query = "SELECT `id`,`name` FROM menus WHERE `status`='active'";

$result = Sql_exec($cn, $query);
if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}
$data = array();
$i = 0;
while ($row = Sql_fetch_assoc($result)) {
    $j = 0;
    $menu_id = Sql_Result($row, "id");
    $qry = "SELECT `permissions` FROM role_menus WHERE `rule_id`='$role_id' AND `menu_id`='$menu_id'";
    $res = Sql_exec($cn, $qry);
    $dt = Sql_fetch_assoc($res);
    $permissions = $dt['permissions'];
    $permissions_obj = json_decode($permissions,false);

    $data[$i][$j++] =   $menu_id ;
    $data[$i][$j++] = Sql_Result($row, "name");
    if(isset($permissions_obj) && !empty($permissions_obj)){

        if($permissions_obj->add === "yes"){
            $data[$i][$j++] =  '<input type="checkbox" name="" value="" checked>';
        }else{
            $data[$i][$j++] =  '<input type="checkbox" name="" value="">';
        }

        if($permissions_obj->edit === "yes"){
            $data[$i][$j++] =  '<input type="checkbox" name="" value="" checked>';
        }else{
            $data[$i][$j++] =  '<input type="checkbox" name="" value="">';
        }

        if( $permissions_obj->delete === "yes" ){
            $data[$i][$j++] =  '<input type="checkbox" name="" value="" checked>';
        }else{
            $data[$i][$j++] =  '<input type="checkbox" name="" value="">';
        }

        if( $permissions_obj->view === "yes" ){
            $data[$i][$j++] =  '<input type="checkbox" name="" value="" checked>';
        }else{
            $data[$i][$j++] =  '<input type="checkbox" name="" value="" >';
        }

    }else{
        $data[$i][$j++] =  '<input type="checkbox" name="" value="" >';
        $data[$i][$j++] =  '<input type="checkbox" name="" value="" >';
        $data[$i][$j++] =  '<input type="checkbox" name="" value="" >';
        $data[$i][$j++] =  '<input type="checkbox" name="" value="" >';
    }



    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
