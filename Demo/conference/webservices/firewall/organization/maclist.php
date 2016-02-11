<?php
/**
 * Created by PhpStorm.
 * User: Anik
 * Date: 11/16/2015
 * Time: 12:59 PM
 */

include_once "../../lib/common.php";


$user_type = $_SESSION["firewall"]["user_type"];
$user_id = $_SESSION["firewall"]["id"];

$cn = connectDB();
$tbl='organization';

if($user_type == "Super User")
    $query = "SELECT * FROM $tbl WHERE `status` = 'active'";
else
    $query = "SELECT * FROM $tbl WHERE `status` = 'active' and id in (select org_id from org_users where user_id='$user_id')";


$result = Sql_exec($cn, $query);

if (!$result) {
    echo "err+" . $query . " in line " . __LINE__ . " of file" . __FILE__;
    exit;
}

$options = '<select id="firewall_mac" multiple="multiple" class="chosen-select" name="firewall_mac[]" style="width: 82%" value="" placeholder="Enter Mac Address">';
$i=0;
while ($row = Sql_fetch_array($result)) {
    $macadresses = array_filter(explode(",", $row['mac_addresses']));
    foreach($macadresses as $mac){
        $options .='<option value="' . $mac . '">' . $mac . '</option>';
    }
}
$options .='</select>';

Sql_Free_Result($result);
ClosedDBConnection($cn);
echo $options;