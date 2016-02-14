<?php
include_once "../../lib/common.php";
//require_once "../lib/filewriter.php";
require_once "../../lib/excel_reader2.php";
$target_file = $dir_firewall_upload_dir.$_FILES["uploadFile"]["name"];
$connection = connectDB();

$status = false;
if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_file)) {
   $ext = pathinfo($target_file, PATHINFO_EXTENSION);
    if($ext == 'xls') {
        $data = new Spreadsheet_Excel_Reader($target_file);
        $sheetData = $data->sheets[0]['cells'];
        unset($sheetData[1]);

        foreach($sheetData as $result) {

            $group_name = mysql_real_escape_string(htmlspecialchars(trim($result['1'])));
            $group_type = mysql_real_escape_string(htmlspecialchars(trim($result['2'])));
            $content_type = mysql_real_escape_string(htmlspecialchars(trim($result['3'])));
            $content = mysql_real_escape_string(htmlspecialchars(trim($result['4'])));
            $status = "active";
            $last_updated = date('Y-m-d H:i:s');
            $last_updated_by = $_SESSION["UserID"];



                $checkGroupIsExistsQuery = "SELECT * FROM groups WHERE name = '$group_name' AND status='active' LIMIT 1;";
                $resultGroupIsExists = Sql_exec($connection, $checkGroupIsExistsQuery);
                $countGroupIsExists = Sql_fetch_assoc($resultGroupIsExists);


                if($countGroupIsExists['id'] > 0) {
                    echo '{"status":false,"message":"Sorry, your file is already exits."}';
                } else {
                    $queryGroupInsert = "insert into groups (name, group_type, type, content, last_updated,created_by,status)";
                    $queryGroupInsert .= " values ('$group_name', '$group_type', '$content_type', '$content', '$last_updated', '$last_updated_by', '$status')";

                    $resultGroup = Sql_exec($connection, $queryGroupInsert);
                    $lastInsertID = Sql_insert_id($connection);

                }


                if($resultGroup) {
                    $status = true;
                }



        }


        if($is_error == 0) {
            $status = true;
        }

        if($status) {
            echo '{"status":true,"message":"Data Inserted Successfully."}';
        }

    } else {
        echo '{"status":false,"message":"Invalid file format. Upload only xls file."}';
    }

} else {
    echo '{"status":false,"message":"Sorry, there was an error uploading your file."}';
}