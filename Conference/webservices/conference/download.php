<?php
/**
 * Created by PhpStorm.
 * User: Al-Amin
 * Date: 2/2/2016
 * Time: 5:49 PM
 */

echo "sadfas";
$file=trim($_GET['name']);

include "common.php";
echo $file;
$file_location = '/ismp/shared/test/recordings/record_conference/'.$file;
//$data = file_get_contents($file_location);
header('Content-disposition: attachment; filename='.$file.'');
header('Content-type: application/octet-stream');
header('Content-Length: ' . filesize($file_location));
readfile('../ismp/shared/test/recordings/record_conference/'.$file);
//echo $data;octet-stream
?>

<!--/ismp/shared/test/recordings/record_conference/conference__09111550217pm2002198063.wav
E:\VisualStudioTeam\Conference and Streaming\WebApplication\Demo\Conference\webservices\conference\download.php-->