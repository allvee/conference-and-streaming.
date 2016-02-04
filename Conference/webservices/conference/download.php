<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/2/2016
 * Time: 5:49 PM
 */


$file=trim($_GET['name']);
include "common.php";

$file_location_test = '//ismp/shared/test/recordings/test_asterisk/'.$file;
$file_location = '//ismp/shared/test/recordings/record_conference/'.$file;


header('Content-disposition: attachment; filename='.$file.'');
header('Content-type: application/wav');
header('Content-Length: ' . filesize($file_location_test));
readfile('/ismp/shared/test/recordings/test_asterisk/'.$file);

?>

