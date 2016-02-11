<?php
include_once "../lib/common.php";
$cn = connectDB();
$query = "SELECT * FROM `menus` WHERE status = 'active';";
$result = Sql_exec($cn, $query);
$firewall_session = $_SESSION['firewall'];
$is_super_admin = false;
if($firewall_session['user_type'] == 'Super User')
    $is_super_admin = true;
echo '<ul>';
while($row = Sql_fetch_assoc($result)) {
    $permission_array = json_decode($firewall_session['rules'][$row['name']], true);
    if($is_super_admin == false && $permission_array['view'] == 'yes') {
        if(trim($row['name']) == 'Show Configuration') {
            echo '<li>
                  <a href="#" onclick="firewall_config()">'.$row['name'].'</a>
              </li>';
        } else {
            echo '<li>
                  <a data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\''.$row['url'].'\')" href="#" content_id="3">'.$row['name'].'</a>
              </li>';
        }

    } else if($is_super_admin == true) {
        if(trim($row['name']) == 'Show Configuration') {
            echo '<li>
                  <a href="#" onclick="firewall_config()">'.$row['name'].'</a>
              </li>';
        } else {
            echo '<li>
                  <a data-target="#myModal" data-toggle="modal" onclick="showUserMenu(\''.$row['url'].'\')" href="#" content_id="3">'.$row['name'].'</a>
              </li>';
        }
    }
}
//echo '<li content_id="3">
 //           <a href="#" onclick="showUserMenu(\'signOut\')" content_id="3"> Logout</a>
//        </li>';
echo '</ul>';
?>