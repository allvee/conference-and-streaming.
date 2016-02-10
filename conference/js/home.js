/**
 * Created by Mazhar on 3/10/2015. Edited by Talemul, Monir
 *
 */

function defaultViewController() {

    var cms_auth = checkSession('cms_auth');
    if (cms_auth == null) {
        // login page
        showUserMenu('login');
    } else {
        // login page
        showUserMenu('index');// after log in index
    }
}

function set_brust_change() {
    var data = $("#bwc_info_Brust").val();

    if (data == "0") {
        $("#brust_bw").hide();
        dropdown_chosen_style();
    } else {

        $("#brust_bw").show();
    }
}

function set_group_brust_change() {
    var data = $("#bwc_group_Brust").val();

    if (data == "0") {
        $("#brust_bw").hide();
        dropdown_chosen_style();
    } else {
        $("#brust_bw").show();
    }
}
var superUser;
function showUserMenu(field_name) {

    $.get(cms_url['rcportal_firewall_check_if_superuser'], function (data) {
        var if_super_user = $.parseJSON(data);
        //console.log('permission', permission);
        if (if_super_user.super_user == 'yes') {
            superUser = true;
        } else
            superUser = false;
    });

    $('#tab_view').html('');
    message_clear();
    $('#id_loading_image').show();
    /* pages available before logging in */

    if (field_name == 'login') {
        displayContent("1812", "#cmsData", "#contentListLayout", "ContentID");
    }

    /* pages available after logged in */

    var cms_auth = checkSession('cms_auth');
    if (cms_auth != null) {
        $('#id_loading_image').hide();

        $("#nav-navbar-collapse-1").removeClass("in");
        if (field_name == 'index') {
            $('#id_loading_image').hide();
            displayContent("1810", "#cmsData", "#contentListLayout", "ContentID");
            default_menu();
            version_check();
        }

        else if (field_name == 'signOut') {
            destroySession('cms_auth');
            connectServer(cms_url['site_host_destroy'], null, false);
            window.location.assign(cms_url['MarketplaceURL'] + "marketplace/destroy_server_session.php");
            //cmsLogout(site_host);
        }


        else if (field_name == 'enterprise_conference') {

            // $('.tabtitle').hide();
            // $("#set_title").html(' <span style="font-weight:bold;">Enterprise Conference</span>');

            var inputarray = [["Conference", "enterprise_conference", "active"]];
            tab_custom(inputarray, "tab_view");
            display_content_custom('1817', '#modalData');
            table_initialize_conference_list();
            report_menu_start_conference_list();
        }

        else if (field_name == 'new_conference') {
            display_content_custom('1811', '#modalData');
            $('.tabtitle').hide();
            $("#set_title").html('<img width="3%" src="conference/img/icon-setting.png"> <span style="font-weight:bold;">Conference </span>');

            var inputarray = [["Conference", "enterprise_conference", "active"]];
            tab_custom(inputarray, "tab_view");
            from_backend();
        }


        else if (field_name == 'edit_conference') {
            display_content_custom('1818', '#modalData');
            //$('.tabtitle').hide();
            $("#set_title").html(' <span style="font-weight:bold;">Edit Conference</span>');

            var inputarray = [["Conference", "enterprise_conference", "active"]];
            tab_custom(inputarray, "tab_view");
            from_backend();
        }


        else if (field_name == 'participants_list') {
            //$('.tabtitle').hide();
            //$("#set_title").html(' <span style="font-weight:bold;">Participants List</span>');

            var inputarray = [["Participants", "participants_list", "active"]];
            tab_custom(inputarray, "tab_view");

            display_content_custom('1819', '#modalData');
            table_initialize_participant_list();
            report_menu_start_participant_list();

        }

        else if (field_name == 'add_new_participant') {
            display_content_custom('1820', '#modalData');
            $('.tabtitle').hide();
            $("#set_title").html(' <span style="font-weight:bold;">Add New Participant</span>');

            var inputarray = [["Participants", "participants_list", "active"]];
            tab_custom(inputarray, "tab_view");
            Participant_from_backend();
        }

        else if (field_name == 'edit_participant') {
            display_content_custom('1821', '#modalData');
            $('.tabtitle').hide();
            $("#set_title").html(' <span style="font-weight:bold;">Edit Participant</span>');

            var inputarray = [["Participants", "participants_list", "active"]];
            tab_custom(inputarray, "tab_view");
            Participant_from_backend();
        }

 	 else if (field_name == 'download_list') {
            display_content_custom('1822', '#modalData');
            //$('.tabtitle').hide();
            $("#set_title").html(' <span style="font-weight:bold;">Download record</span>');

            var inputarray = [["Conference", "enterprise_conference", "active"]];
            tab_custom(inputarray, "tab_view");
            table_initialize_download_list();
            report_menu_start_download_list();

        }

        else if (field_name == 'alert_mgt_config_email') {
           // write_activity_log('EMAIL_CONFIG', 'Email Configuration', cms_url['activity_log']);
            display_content_custom('1824', '#modalData');
           /* var permission;
            permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Configuration');
            if (permission.add_permission != 'yes') {
                $('#hidden_btn_when_not_permitted').hide();
            } else {
                $('#hidden_div_when_not_permitted').show();
            }*/
            var inputarray = [["Email", "alert_mgt_config_email", "active"], ["SMS", "alert_mgt_config_sms", "deactive"]];
            tab_custom(inputarray, "tab_view");
            //display_alert_email();
            $("#set_title").html('<span style="font-weight:bold;">Email Configuration</span>');
        }

        else if (field_name == 'alert_mgt_config_sms') {
            //write_activity_log('SMS_CONFIG', 'SMS Configuration', cms_url['activity_log']);
            display_content_custom('1825', '#modalData');
           /* var permission;
            permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Configuration');
            if (permission.add_permission != 'yes') {
                $('#hidden_btn_when_not_permitted').hide();
            } else {
                $('#hidden_div_when_not_permitted').show();
            }*/
            var inputarray = [["Email", "alert_mgt_config_email", "deactive"], ["SMS", "alert_mgt_config_sms", "active"]];
            tab_custom(inputarray, "tab_view");
           // display_alert_sms();
            $("#set_title").html('<span style="font-weight:bold;">SMS Configuration</span>');
        }

        /////////////////////////*** Role Management Start ******/

        else if (field_name == 'firewall_organization_view') {
            write_activity_log('Organization', 'FIREWALL ORGANIZATION', cms_url['activity_log']);
            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "active"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
                tab_custom(inputarray, "tab_view");
                table_initialize_firewall_organization();
                report_menu_start_firewall_organization();
            } else {
                var inputarray = [["Role", "firewall_role_view", "active"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
                tab_custom(inputarray, "tab_view");
                table_initialize_firewall_role();
                report_menu_start_firewall_role();
                var permission;
                permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Role Management');
                //console.log('permission:', permission);
                if (permission.add_permission != 'yes') {
                    $('#add_button').html('');
                }
            }
        } else if (field_name == 'firewall_user_view') {
            write_activity_log('Organization_User', 'FIREWALL ORGANIZATION USER', cms_url['activity_log']);
            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
            } else {
                var inputarray = [["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
            }

            tab_custom(inputarray, "tab_view");
            table_initialize_firewall_user();
            report_menu_start_firewall_user();
            var permission;
            permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Role Management');
            //console.log('permission:', permission);
            if (permission.add_permission != 'yes') {
                $('#add_button').html('');
            }

            /*$.get(cms_url['rcportal_firewall_add_user_permission'], function(data) {
             var permission = $.parseJSON(data);
             //console.log('permission', permission);
             if(permission.add_permission != 'yes') {
             $('#add_button').html('');
             }
             });*/
        } else if (field_name == 'firewall_role_view') {
            write_activity_log('Organization_Role', 'FIREWALL ORGANIZATION ROLE', cms_url['activity_log']);
            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "active"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
            } else {
                var inputarray = [["Role", "firewall_role_view", "active"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
            }

            tab_custom(inputarray, "tab_view");
            table_initialize_firewall_role();
            report_menu_start_firewall_role();
        } else if (field_name == 'firewall_user_role_association') {
            write_activity_log('Organization_User_Role', 'FIREWALL ORGANIZATION USER ROLE', cms_url['activity_log']);
            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "active"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
            } else {
                var inputarray = [["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "active"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
            }
            tab_custom(inputarray, "tab_view");
            table_initialize_firewall_user_role_association();
            report_menu_start_firewall_user_role_association();

        } else if (field_name == 'firewall_role_menu_association') {
            write_activity_log('Organization_User_Role_Menu_Association', 'FIREWALL ORGANIZATION USER ROLE MENU ASSOCIATION', cms_url['activity_log']);

            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "active"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
            } else {
                var inputarray = [["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "active"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
            }

            tab_custom(inputarray, "tab_view");
            $("#role_menu").html('<div class="frmLblNameAcc col-md-3"></div>' +
                '<div class="frmLblNameAcc col-md-3">Choose Role</div>' +
                '<div class="frmFldAcc col-md-3"><select id="choose_role_id" class="chosen-select" onchange="load_menu_of_current_role();" style="width: 100%;" name="choose_role_id"></select></div>' +
                '<div class="frmLblNameAcc col-md-3"></div>');

            fetchDropDownOption("#choose_role_id", cms_url['rcportal_firewall_get_roles'], '');



        } else if (field_name == 'org_user') {
            display_content_custom("100", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "active"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "deactive"]];
            } else {
                var inputarray = [["Org User", "org_user", "active"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "inactive"]];
            }

            tab_custom(inputarray, "tab_view");
            table_initialize_firewall_org_user();
            report_menu_start_firewall_org_user();

        } else if (field_name == 'role_mgmt_sync_status_log') {
            write_activity_log('ROLE_SYNC_LOG', 'ROLE SYNC LOG', cms_url['activity_log']);
            display_content_custom("150", "#modalData");
            if (superUser) {
                var inputarray = [["Organization", "firewall_organization_view", "inactive"], ["Org User", "org_user", "inactive"], ["Role", "firewall_role_view", "inactive"], ["User Role ", "firewall_user_role_association", "inactive"], ["Role Menu", "firewall_role_menu_association", "inactive"],["Sync Log", "role_mgmt_sync_status_log", "active"]];
            } else {
                var inputarray = [["Role", "firewall_role_view", "deactive"], ["User Role ", "firewall_user_role_association", "deactive"], ["Role Menu", "firewall_role_menu_association", "deactive"], ["Sync Log", "role_mgmt_sync_status_log", "active"]];
            }
            tab_custom(inputarray, "tab_view");
            table_initialize_role_mngmt_sync_log();
            report_menu_start_role_mngmt_sync_log();
        }


        /////////////////////////*** Role Management END ******/

        else if(field_name == 'view_report'){
            write_activity_log('view_report', 'FIREWALL ORGANIZATION USER ROLE MENU ASSOCIATION', cms_url['activity_log']);
            display_content_custom("100", "#modalData");
            $("#role_menu").html('<div class="frmLblNameAcc col-md-3"></div>' +
                '<div class="frmLblNameAcc col-md-3">Choose Conference</div>' +
                '<div class="frmFldAcc col-md-3"><select id="choose_conference_id" class="chosen-select" onchange="load_current_conference_list();" style="width: 100%;" name="choose_conference_id"></select></div>' +
                '<div class="frmLblNameAcc col-md-3"></div>');

            fetchDropDownOption("#choose_conference_id", cms_url['conference_get_view_report_list'], '');
        }


        /*

         else if (field_name == 'enterprise_admin') {
         display_content_custom('1813', '#modalData');
         //$('.tabtitle').hide();
         $("#set_title").html(' <span style="font-weight:bold;">User Role Management</span>');

         var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "active"], ["Log Off", "enterprise_logoff", "deactive"]];
         tab_custom(inputarray, "tab_view");

         table_initialize_user_list();
         report_menu_start_user_list();
         }

         else if (field_name == 'enterprise_logoff') {
         display_content_custom('150', '#modalData');
         //$('.tabtitle').hide();
         $("#set_title").html('<img width="3%" src="conference/img/icon-setting.png"> <span style="font-weight:bold;">Log Off </span>');

         var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "deactive"], ["Log Off", "enterprise_logoff", "active"]];
         tab_custom(inputarray, "tab_view");
         }

         else if (field_name == 'new_user') {
         display_content_custom('1814', '#modalData');
         //$('.tabtitle').hide();
         $("#set_title").html(' <span style="font-weight:bold;">User Role Management</span>');

         var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "active"], ["Log Off", "enterprise_logoff", "deactive"]];
         tab_custom(inputarray, "tab_view");
         }


         else if (field_name == 'edit_user') {
         display_content_custom('1816', '#modalData');
         //$('.tabtitle').hide();
         $("#set_title").html(' <span style="font-weight:bold;">User Role Management</span>');

         var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "active"], ["Log Off", "enterprise_logoff", "deactive"]];
         tab_custom(inputarray, "tab_view");
         }


         else if (field_name == 'new_group') {
         display_content_custom('1815', '#modalData');
         //$('.tabtitle').hide();
         $("#set_title").html(' <span style="font-weight:bold;">User Role Management</span>');

         var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "active"], ["Log Off", "enterprise_logoff", "deactive"]];
         tab_custom(inputarray, "tab_view");
         }
         */


        // dropdown_chosen_style();

        setTimeout(function () {
            showDashboardInfo();
            //loadGraph();
        }, 1000);
        setTimeout(function () {
            dropdown_chosen_style()
        }, 1500);

        //setTimeout(function() {


        // highcharts_custom('#container11', 'column','URL');
        //highcharts_custom('#container21', 'spline','URL');
        //highcharts_custom('#container31', 'pie','URL');
    }

    $('#id_loading_image').hide();


}
