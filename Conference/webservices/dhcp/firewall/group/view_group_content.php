<?php

header('Access-Control-Allow-Origin: *');
include_once "../../lib/common.php";
$cn = connectDB();

$user_type = $_SESSION["firewall"]["user_type"];
$org_id = $_SESSION["firewall"]["org_ids"];
$user_id = $_SESSION["firewall"]["id"];
$action_id = mysql_real_escape_string(htmlspecialchars($_POST['info']));

$arrayInput = array();

    $query = "SELECT read_only, content FROM groups where status='active' AND id ='".$action_id."'";
//echo $query;

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
    $read_only = Sql_Result($row, "read_only");
    if($read_only)
        $data[$i][$j++] = "";
    else
        $data[$i][$j++] = Sql_Result($row, "content");
    $i++;
}
Sql_Free_Result($result);
ClosedDBConnection($cn);
echo json_encode($data);
?>