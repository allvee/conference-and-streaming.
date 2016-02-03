<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/2/2016
 * Time: 5:49 PM
 */

$file=trim($_GET['name']);

include "common.php";

$file_location = '/ismp/shared/test/recordings/record_conference/'.$file;
//$data = file_get_contents($file_location);
header('Content-disposition: attachment; filename='.$file.'');
header('Content-type: application/octet-stream');
header('Content-Length: ' . filesize($file_location));
readfile('../ismp/shared/test/recordings/record_conference/'.$file);
//echo $data;octet-stream
?>
