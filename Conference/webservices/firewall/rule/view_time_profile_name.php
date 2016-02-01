<?php
include_once "../../lib/common.php";
require_once "../../lib/functions.php";

$cn = connectDB();
$org_id = $_SESSION["firewall"]["org_ids"];

$query = "SELECT * FROM time_profileinfo where status='active' AND org_id='".$org_id."'";
$result = Sql_exec($cn, $query);
$option = '';

while($row = Sql_fetch_array($result)) {
    $time_profile_id = Sql_Result($row, "id");
    $time_profile_name = Sql_Result($row, "name");
    $options .= '<option value="' . $time_profile_id . '">' . $time_profile_name . '</option>';
}

echo $options;