<?php
/**
 * Created by PhpStorm.
 * User: L440-User
 * Date: 12/6/2015
 * Time: 1:20 PM
 */

include_once "../lib/common.php";


//print_r($_SESSION);
//exit;

$cn = connectDB();
$query = "SELECT * FROM `menus` WHERE `parent_id`= 0 AND  status = 'active';";
$result = Sql_exec($cn, $query);
$vpn_session = $_SESSION['conference'];
$is_super_admin = false;
if( trim($vpn_session['user_type']) == "Super User" )
    $is_super_admin = true;



function show_nested_menu($cn,$parent_id,$is_super=false){
    $qry = "SELECT * FROM `menus` WHERE `parent_id`= '$parent_id' AND  status = 'active';";
    $result = Sql_exec($cn, $qry);
    $row_nums = Sql_Num_Rows($result);
    if( $row_nums > 0 ){
        echo '<ul>';
        while( $row = Sql_fetch_assoc($result) ){
            global $vpn_session;

            $permission_array = json_decode($vpn_session['rules'][$row['name']], true);
            if( $is_super == false && trim($permission_array['view']) == "yes" ) {
                echo '<li>';
                echo '<a data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\'' . $row['url'] . '\')" href="#" content_id="3">' . $row['name'] . '</a>';

                // echo $row['name']. "\n";
                show_nested_menu($cn, $row['id'],$is_super);
                echo '</li>';
            }elseif( $is_super == true){
                echo '<li>';
                echo '<a data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\'' . $row['url'] . '\')" href="#" content_id="3">' . $row['name'] . '</a>';

                // echo $row['name']. "\n";
                show_nested_menu($cn, $row['id'],$is_super);
                echo '</li>';
            }
        }
        echo '</ul>';
    }else{
        return;
    }
}

echo '<ul>';

while( $row = Sql_fetch_assoc($result) ) {


    $permission_array = json_decode($vpn_session['rules'][$row['name']], true);

    if ( $is_super_admin == false && trim($permission_array['view']) == "yes" ) {
        echo '<li>';
        if(trim($row['name']) == 'Show Configuration') {
            echo '<a style="width: 178px;" href="#" onclick="show_configuration()">'.$row['name'].'</a>';
        } else {
            if(!empty($row['url']))
                echo '<a style="width: 178px;" data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\'' . $row['url'] . '\')" href="#" content_id="3">' . $row['name'] . '</a>';
            else
                echo '<span style="float: left;margin-top: 5px;margin-left: 4px;color: #FFF;"><i class="fa fa-arrow-circle-left"></i></span><a style="width: 161px;" href="javascript:void(0)">' . $row['name'] . '</a>';
        }        show_nested_menu($cn, $row['id']);
        echo '</li>';
    } else if ($is_super_admin == true) {
        echo '<li>';
        if(trim($row['name']) == 'Show Configuration') {
            echo '<a style="width: 178px;" href="#" onclick="show_configuration()">'.$row['name'].'</a>';
        } else {
            if(!empty($row['url']))
                echo '<a style="width: 178px;" data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\'' . $row['url'] . '\')" href="#" content_id="3">' . $row['name'] . '</a>';
            else
                echo '<span style="float: left;margin-top: 5px;margin-left: 4px;color: #FFF;"><i class="fa fa-arrow-circle-left"></i></span><a style="width: 161px;" href="javascript:void(0)">' . $row['name'] . '</a>';
        }        show_nested_menu($cn, $row['id'],true);
        echo '</li>';
    }

}

echo '</ul>';

ClosedDBConnection($cn);