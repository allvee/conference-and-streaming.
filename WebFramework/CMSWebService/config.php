<?php

include_once "utils.php";
error_reporting(0);
mysql_connect("192.168.245.46", "root", "nopass") or die(mysql_error());
mysql_select_db("ocmportal_cms_conference_demo") or die(mysql_error());
