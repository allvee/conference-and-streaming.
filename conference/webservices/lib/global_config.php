<?php
/**
 * Created by PhpStorm.
 * User: Monowar
 * Date: 5/5/2015
 * Time: 2:05 PM
 */
$protocol = '';
if(isset($_SERVER['HTTPS'])) {
    $protocol = "https";
} else{
    $protocol = 'http';
}
$localhost = $_SERVER['HTTP_HOST'];
$baseURL = $protocol.'://'.$_SERVER['HTTP_HOST'];
$CURRENT_FILE_HOSTING_PATH = dirname(dirname(dirname(dirname ( __FILE__ )))).DIRECTORY_SEPARATOR;

$file_dir = "/tmp/" ;
$dir_firewall_backup_file = $CURRENT_FILE_HOSTING_PATH."backup/";
$dir_firewall_upload_dir = $CURRENT_FILE_HOSTING_PATH.'backup/uploaded/';
//http://marketplace.dozeinternet.com/webservices/req_doze_marketplace/user_list.php
$baseURL_1 = $protocol.'://'.'marketplace.dozeinternet.com';
//Local MarketPlace Dashboard Integration
define('Marketplace_Login_USER', $baseURL.'/marketplace/SubscriptionServices/services/cgwAuth/UserLogin.php');
define('Marketplace_USER_LIST', $baseURL_1.'/webservices/req_doze_marketplace/user_list.php');

//define('Marketplace_Login_USER', $baseURL.'/doze_internet_new_site/webservices/request_doze/UserLogin.php');
//define('Marketplace_USER_LIST', $baseURL.'/doze_internet_new_site/webservices/request_doze/user_list.php');

define('Marketplace_Add_ORG_API','/firewall/rcportal/webservices/firewall/role_sync/save_sync_organization.php');
define('Marketplace_Add_ROLE_API','/firewall/rcportal/webservices/firewall/role_sync/save_sync_user_role.php');
define('Marketplace_Add_ROLE_MENUS_API','/firewall/rcportal/webservices/firewall/role_sync/save_sync_role_menu.php');


define('VERSION_UPDATE_SERVER', '192.168.245.40');
$version_check_url = 'http://'.VERSION_UPDATE_SERVER.'/version_checker/?';
define('VERSION_CHECK_URL', $version_check_url);

define('CP_DIR_FOR_UPDATE', 'firewall_as_service/*');
define('DB_FILE_NAME', 'firewall_as_service/db/firewall_as_service.sql');
define('DB_NAME', 'firewall_service');

define('Synchronize','http://192.168.245.34/group_server/get_firewall_groups.php');

$get_group_content = "http://192.168.245.34/group_server/get_firewall_group_content.php?group_name=";
$get_group_description = "http://192.168.245.34/group_server/get_firewall_group_description.php?group_name=";
$get_gatewayFromMac = "http://192.168.245.40/ocmportal/rcportal/webservices/api/get_gateway.php?mac=";

$dest_file_dir = "/mnt/BWP/fireWall/";
$dir_config_file="/ocmp/app/firewall_as_service/";
$firewall_app_port = 3448;
$parental_firewall_service = 0;



