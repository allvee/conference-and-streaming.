<?php 
 //  echo phpinfo();

   echo session_save_path();
   session_start();
   echo "<pre>";
   print_r($_SESSION);



?>