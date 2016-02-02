<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/2/2016
 * Time: 8:24 PM
 */
include_once "../lib/common.php";
$cn = connectDB();

$tbl = "tbl_conference_recorded_file";

$msisda=
$arrayInput = array();
$query = "SELECT `record_file_path` FROM tbl_conference_recorded_file ";
$result = Sql_exec($cn, $query);

$data = array();
$name="";
$i=0;
while ($row = Sql_fetch_array($result)) {
    $j=0;

    $name= Sql_Result($row, "record_file_path");
    $date_wav = explode('/', $name);
$dir='/cs/Demo/Conference/webservices/conference/download.php';
    $data[$i][$j++] = '<a href="'.$dir.'?name='.$date_wav[6].'">' . $date_wav[6].'\'</a>';


    $i++;
}
Sql_Free_Result($result);

ClosedDBConnection($cn);
echo json_encode($data);

?>
