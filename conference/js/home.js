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

function set_brust_change()
 {
	var data = $("#bwc_info_Brust").val();

	if(data == "0")
         	{
			$("#brust_bw").hide();
                         dropdown_chosen_style();
		}else
			{

		  	$("#brust_bw").show();
			}
 }

function set_group_brust_change()
 {
	var data = $("#bwc_group_Brust").val();

	if(data == "0")
         	{
			$("#brust_bw").hide();
                         dropdown_chosen_style();
		}else
			{

		  	$("#brust_bw").show();
			}
 }
function showUserMenu(field_name) {
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
            cmsLogout(site_host);
        }


else if (field_name == 'enterprise_conference') {
            display_content_custom('1811', '#modalData');
            //$('.tabtitle').hide();
            $("#set_title").html('<img width="3%" src="conference/img/icon-setting.png"> <span style="font-weight:bold;">Conference </span>');

           var inputarray = [["Conference", "enterprise_conference", "active"], ["Admin", "enterprise_admin", "deactive"], ["Log Off", "enterprise_logoff", "deactive"]];
            tab_custom(inputarray, "tab_view");
        }

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


else if (field_name == 'new_group') {
    display_content_custom('1815', '#modalData');
    //$('.tabtitle').hide();
    $("#set_title").html(' <span style="font-weight:bold;">User Role Management</span>');

    var inputarray = [["Conference", "enterprise_conference", "deactive"], ["Admin", "enterprise_admin", "active"], ["Log Off", "enterprise_logoff", "deactive"]];
    tab_custom(inputarray, "tab_view");
}
		// dropdown_chosen_style();

		setTimeout(function() {
			showDashboardInfo();
                     //loadGraph();
		}, 1000);
		setTimeout(function() {
			dropdown_chosen_style()
		}, 1500);

		//setTimeout(function() {


		// highcharts_custom('#container11', 'column','URL');
            //highcharts_custom('#container21', 'spline','URL');
            //highcharts_custom('#container31', 'pie','URL');
	}

	$('#id_loading_image').hide();


}
