/**
 * Created by Plabon Dutta on 23-Nov-15.
 */


function table_initialize_firewall_user() {
    var permission;
    permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Role Management');
    if (permission.add_permission != 'yes') {
        $('#add_button').html('');
    } else {
        $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
            '<div class=" frmFldAcc col-md-2">' +
            '<button type="button" class="btn btn-primary btn-test" style="background-image:url(conference/img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_firewall_user_form(); return false;">' +
            '</button> </div>' +
            '<div class="frmFldAcc col-md-5"></div>');
    }

    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_user" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}


function report_menu_start_firewall_user() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_users'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_user(dataSet);

    data_table_responsive();
}


function table_data_firewall_user(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_user').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Name", "class": "center"},
            {"title": "Login ID", "class": "center"},
            {"title": "Email", "class": "center"},
            {"title": "User Type", "class": "center"},
            {"title": "Parent", "class": "center"},
            {"title": "Organization", "class": "center"},
            {"title": "Action", "class": "center"}
        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "conference/img/datatable/swf/copy_csv_xls_pdf.swf",
            "sRowSelect": "multi",
            "aButtons": [
                "copy", "csv",
                {
                    "sExtends": "xls",
                    "sFileName": "*.xls"
                }
            ],
            "filter": "applied"
        }
    });
    $('th').css("white-space", "nowrap");
    $('th').css("width", "200px");
}


/* =====================================================
 * edit function. for read all row
 * =====================================================*/
function edit_firewall_users(obj, action_id) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_user');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 6; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    display_content_custom('1584', '#modalData');
    $('#table_title').html('Edit User');
    $("#hidden_div_for_pw").hide();
    $('#user_password').prop("disabled", true);

    fetchDropDownOption('#user_user_type', cms_url['get_user_type'], '');
    fetchDropDownOption('#user_orgs', cms_url['get_organizations'], '');
    $.get(cms_url['rcportal_firewall_check_if_superuser'], function(data) {
        var if_super_user = $.parseJSON(data);
        //console.log('permission', permission);
        if(if_super_user.super_user == 'yes') {
            $('#hidden_parent_div').show();
        } else
            $('#hidden_parent_div').hide();
    });
    fetchDropDownOption('#parent_userid', cms_url['get_users'], '');

    $('#user_full_name').focus();
    $('#action').val('update');
    $('#action_id').val(action_id);
    $('#user_full_name').val(dataArray[0]);
    $('#user_id').val(dataArray[1]);
    $('#user_email').val(dataArray[2]);
    $('#user_user_type').val(dataArray[3]);
    var parent = dataArray[4];
    $("#parent_userid option").filter(function () {
        return this.text == parent;
    }).attr('selected', true);

    //$('#parent_userid').val(dataArray[5]);
    var org_names = dataArray[5];
    var org_names_splited = org_names.split(",");
    for(var i=0; i<org_names_splited.length; i++) {
        $("#user_orgs option").filter(function() {
            return this.text == org_names_splited[i];
        }).attr('selected', true);
    }

    dropdown_chosen_style();
}

function firewall_users_onsbmt() {

    var form_id = "form_firewall_users";
    var response = connectServerWithForm(cms_url['save_users'], form_id);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_firewall_user();
        report_menu_start_firewall_user();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }
}


function delete_firewall_users(obj, action_id) {

    confirmMessage(this, 'firewall_user_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_user_yes').click({id: arrayInput}, delete_confirm_firewall_user);

}
function delete_confirm_firewall_user(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['deleted_id'] = arrayInput[1];
    var response = connectServer(cms_url['save_users'], dataInfo);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', 'response.message');
        display_content_custom("100", "#modalData");
        table_initialize_firewall_user();
        report_menu_start_firewall_user();
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }

}


function show_firewall_user_form() {
    display_content_custom('1584', '#modalData');
    $('#table_title').html('New User');
    fetchDropDownOption('#user_user_type', cms_url['get_user_type'], '');
    fetchDropDownOption('#user_orgs', cms_url['get_organizations'], '');


    $.get(cms_url['rcportal_firewall_check_if_superuser'], function(data) {
        var if_super_user = $.parseJSON(data);
        //console.log('permission', permission);
        if(if_super_user.super_user == 'yes') {
            $('#hidden_parent_div').show();
        } else
            $('#hidden_parent_div').hide();
    });
    fetchDropDownOption('#parent_userid', cms_url['get_users'], '');
    dropdown_chosen_style();
}


function cancel_form_firewall_user() {
    display_content_custom("100", "#modalData");
    table_initialize_firewall_user();
    report_menu_start_firewall_user();

}



