<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/2/2016
 * Time: 8:24 PM
 */
include_once "../lib/common.php";

$file_location = '/ismp/shared/test/recordings/record_conference/';
$file_location_test='/ismp/shared/test/recordings/test_asterisk/';

$dir='/cs/Demo/conference/webservices/conference/download.php';


$data = array();
$a = scandir($file_location_test,1);

    for($i=0; $i<(count($a)-2);$i++)
    {
    $j=0;
    $data[$i][$j] = '<a style="color:green;" href="'.$dir.'?name='.$a[$i].'">' .$a[$i].'</a>';
    $j++;
    }

echo json_encode($data);

?>
