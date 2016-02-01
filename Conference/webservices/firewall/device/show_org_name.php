<?php
require_once  "../../lib/common.php";

$cn = connectDB();

$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$created_by = $_SESSION["firewall"]["id"];
$user_type = $_SESSION["firewall"]["user_type"];

if($user_type == 'Super User'){
        $qry = "SELECT `id`,`name`
		FROM `organization`
		WHERE `status`='active'
		ORDER BY `name` ASC";
}
else{
    $qry = "SELECT `id`,`name`
		FROM `organization`
		WHERE `status`='active' AND id IN ($org_id)
		ORDER BY `name` ASC";
}

$res = Sql_exec($cn,$qry);

$name = "";
while($dt = Sql_fetch_array($res)){

    $id = $dt['id'];
    $org_name = $dt['name'];
    $name  .= '<option value="'.$id.'">'.$org_name.'</option>';
    //$name  .= '<option value ="'.$package_id.'">'.$package_name.'</option>';
}

ClosedDBConnection($cn);
echo $name;

?>