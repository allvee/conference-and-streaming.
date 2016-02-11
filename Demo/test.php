<?php 
 //  echo phpinfo();

   echo session_save_path();
   session_start();
   echo "<pre>";
   print_r($_SESSION);

echo __LINE__."</br>";

require_once "./conference/webservices/lib/common.php";

echo __LINE__."</br>";

$cn = connectDB();
echo __LINE__."</br>";
$qry = "insert  into `tbl_participant`(`participant_name`,`msisdn`,`email`,`conference_ID`,`conference_name`,`long_code`,`organization`,`participant_type`,`conference_status`,`conference_start_time`,`conference_end_time`) 
values ('alamin','345346346','345@jdfgs.com',36,' abcd','3103','ssd-tech','Member',NULL,NULL,NULL)";
$result = Sql_exec($cn, $qry);
echo __LINE__.":".$result;

ClosedDBConnection($cn);

?>