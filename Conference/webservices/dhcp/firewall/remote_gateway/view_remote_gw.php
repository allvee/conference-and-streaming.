<?php
/**
 * Created by PhpStorm.
 * User: Plabon Dutta
 * Date: 29-Dec-15
 * Time: 2:06 PM
 */


include_once "../../lib/common.php";

$cn = connectDB();
$tbl = 'tbl_host_ip_address';

$query = "SELECT * FROM $tbl WHERE `is_active` = 'active' ";

$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$data = array();
$i=0;

while ($row = Sql_fetch_array($result)) {
    $j=0;
    $data[$i][$j++] = Sql_Result($row, "ip_address");

    $data[$i][$j++] = '<span onclick="edit_remote_gateway(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/pen.png" ></span>'
        . '&nbsp&nbsp' . '<span onclick="delete_remote_gateway(this,' . "'" . Sql_Result($row, "id") . "'" . '); return false;">&nbsp;<img style="position: relative; cursor: pointer; top: 4px" width="16" height="16" border="0" src="rcportal/img/cancel.png" ></span>';

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

?>