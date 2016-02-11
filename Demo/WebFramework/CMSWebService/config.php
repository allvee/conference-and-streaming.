<?php

include_once "utils.php";
error_reporting(0);
mysql_connect("45.125.222.163", "root", "nopass") or die(mysql_error());
mysql_select_db("ocmportal_cms_conference_demo") or die(mysql_error());
