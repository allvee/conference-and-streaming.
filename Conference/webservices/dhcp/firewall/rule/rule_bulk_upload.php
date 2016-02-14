<?php
include_once "../../lib/common.php";
require_once "../../lib/filewriter.php";
require_once "../../lib/excel_reader2.php";
require_once "../../lib/functions.php";

$target_file = $dir_firewall_upload_dir.$_FILES["firewal_rule_file"]["name"];
$connection = connectDB();

$last_updated = date('Y-m-d H:i:s');
$last_updated_by = $_SESSION["firewall"]["id"];
$org_id = $_SESSION["firewall"]["org_ids"];

/*$log_data_arr['user'] = $_SESSION['firewall']['login_id'];
$log_data_arr['component'] = 'BULK UPLOAD';
$log_data_arr['message'] = UPLOAD_BULK.json_encode($_FILES);
write_activity_log_data($cn, $log_data_arr);
*/

if (move_uploaded_file($_FILES["firewal_rule_file"]["tmp_name"], $target_file)) {
    $ext = pathinfo($target_file, PATHINFO_EXTENSION);
    if($ext == 'xls') {
        $data = new Spreadsheet_Excel_Reader($target_file);
        $sheetData = $data->sheets[0]['cells'];
        unset($sheetData[1]);

        foreach($sheetData as $result) {

            $rule_name = mysql_real_escape_string(htmlspecialchars(trim($result['1'])));
            $source_address = mysql_real_escape_string(htmlspecialchars(trim($result['2'])));
            $destination_address = mysql_real_escape_string(htmlspecialchars(trim($result['3'])));
            $port = mysql_real_escape_string(htmlspecialchars(trim($result['4'])));
            $protocol = mysql_real_escape_string(htmlspecialchars(trim($result['5'])));
            $action = mysql_real_escape_string(htmlspecialchars(trim($result['6'])));
            if($action == "reject")
                $action =0;
            else
                $action = 1;
            $time_profile_name = mysql_real_escape_string(htmlspecialchars(trim($result['7'])));

            $status = "active";

            $check_src_group = strpos($source_address, "__");

            if ($check_src_group !== false) {
                $pieces_src = explode("__", $source_address);
                $checkSrcGroupIsExistsQuery = "SELECT * FROM groups WHERE name = '$pieces_src[1]' AND status='active' LIMIT 1;";
                $resultSrcGroupIsExists = Sql_exec($connection, $checkSrcGroupIsExistsQuery);
                $row_1 = Sql_fetch_array($resultSrcGroupIsExists);
                $countSrcGroupIsExists = Sql_Result($row_1, "id");
                $src_type = Sql_Result($row_1, "type");
                if ($countSrcGroupIsExists < 1) {
                    echo '{"status":false,"message":"Sorry, source group file is not exits."}';
                    exit;
                }
            }else{

                $src_type = "none";

            }

            $check_dst_group = strpos($destination_address, "__");

            if ($check_dst_group !== false) {
                $pieces_dst = explode("__", $destination_address);
                $checkDstGroupIsExistsQuery = "SELECT * FROM groups WHERE status='active' AND name = '$pieces_dst[1]' LIMIT 1;";
                $resultDstGroupIsExists = Sql_exec($connection, $checkDstGroupIsExistsQuery);
                $row_2 = Sql_fetch_array($resultDstGroupIsExists);
                $countDstGroupIsExists = Sql_Result($row_2, "id");
                $dst_type = Sql_Result($row_1, "type");
                   if ($countDstGroupIsExists< 1) {
                    echo '{"status":false,"message":"Sorry, destination group file is not exits."}';
                    exit;
                }
            }else{
                $dst_type = "none";
            }

            $checkTimeProfileIsExistsQuery = "SELECT * FROM time_profileinfo WHERE name = '$time_profile_name' AND status='active' LIMIT 1;";
            $resultTimeProfileIsExists = Sql_exec($connection, $checkTimeProfileIsExistsQuery);
            $row_3 = Sql_fetch_array($resultTimeProfileIsExists);
            $countTimeProfileIsExists = Sql_Result($row_3, "id");

            if ($countTimeProfileIsExists < 1) {
                echo '{"status":false,"message":"Sorry, time profile file is not exits."}';
                exit;
            }

            $checkRuleIsExistsQuery = "SELECT * FROM rules WHERE rule_name = '$rule_name' AND status='active' LIMIT 1;";
            $resultRuleIsExists = Sql_exec($connection, $checkRuleIsExistsQuery);
            $row_4 = Sql_fetch_array($resultRuleIsExists);
            $countRuleIsExists = Sql_Result($row_4, "id");

            if ($countRuleIsExists > 0) {
                echo '{"status":false,"message":"Sorry, your Rule is already exits."}';
                exit;
            } else {
                $queryRuleInsert = "insert into rules (source_group_type,dest_group_type,profile_id, rule_name, source_address, destination_address,port,protocol,action,last_updated,created_by,status,public,org_id,applied)";
                $queryRuleInsert .= " values ('$src_type','$dst_type','$countTimeProfileIsExists','$rule_name', '$source_address', '$destination_address', '$port','$protocol','$action', '$last_updated', '$last_updated_by', '$status','0','$org_id','send')";

                $resultRule = Sql_exec($connection, $queryRuleInsert);
                $lastInsertID = Sql_insert_id($connection);

            }


            if ($resultRule) {
                $status = true;
            }
        }

        if($is_error == 0) {
            $status = true;
        }

        if($status) {
            echo '{"status":true,"message":"Data Inserted Successfully."}';
            exit;
        }

    } else {
        echo '{"status":false,"message":"Invalid file format. Upload only xls file."}';
        exit;
    }

} else {
    echo '{"status":false,"message":"Sorry, there was an error uploading your file."}';
    exit;
}