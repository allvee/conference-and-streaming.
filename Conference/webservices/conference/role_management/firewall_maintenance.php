
<?php
//system("sudo sh /ismp/test/vsdp/callhandler/runCallhandler.sh");
header('Access-Control-Allow-Origin: *');

$info = $_REQUEST["info"];
$cmd = $info['cmd']; 

$dir_name ="/ocmp/script/firewall/";


if( $cmd == "stop" )
  system("sudo " . $dir_name . "stop.sh");
else if($cmd == "start"){
  $output = exec('sudo -u root /ocmp/script/firewall/start.sh');
  echo "<pre>". $output ."</pre>";
}else if($cmd == "restart"){
  $output = exec('sudo -u root /ocmp/script/firewall/restart.sh');
  echo "<pre>". $output ."</pre>";

}else{
   echo "<pre>". "Usage:: stop|start|restart" ."</pre>";

}

?>
