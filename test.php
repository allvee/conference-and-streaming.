<?php 
 //  echo phpinfo();

   session_start();
   echo "<pre>";
   print_r($_SESSION);
   echo( $_SESSION['conference']['rules']);


?>