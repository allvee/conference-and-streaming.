/**
 * Created by Anik on 11/25/2015.
 */
function table_initialize_firewall_user_role_association() {
    var permission;
    permission = has_menu_permission(cms_url['firewall_has_menu_permission'], 'Role Management');
    if (permission.add_permission != 'yes') {
        $('#add_button').html('');
    } else {
        $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
            '<div class=" frmFldAcc col-md-2">' +
            '<button type="button" class="btn btn-primary btn-test" style="background-image:url(conference/img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_firewall_user_role_association_form(); return false;">' +
            '</button> </div>' +
            '<div class="frmFldAcc col-md-5"></div>');
    }

    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_user_role_association" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

    $('#dataTables_firewall_user_role_association').after('<div class=" frmFldAcc col-md-5"></div><div class="frmFldAcc col-md-5"><button type="button" class="" style="margin-right: 25%;" onclick="user_role_sync();return false;"><span id="remane_button_wa">Sync</span></button></div>');
}

function report_menu_start_firewall_user_role_association() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_firewall_user_role_association'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_user_role_association(dataSet);

    data_table_responsive();
}

function table_data_firewall_user_role_association(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_user_role_association').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "User Name", "class": "center"},
            {"title": "Role Name", "class": "center"},
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

function show_firewall_user_role_association_form() {
    display_content_custom('1578', '#modalData');
    $("#table_title").html("Add User Role Association");
    //fetchDropDownOption("#user_role_association_full_name", cms_url['user_role_association_full_name_dropdown'], '');
    fetchDropDownOption("#user_role_association_full_name", cms_url['dropdoen_org_user_name'], '');
    fetchDropDownOption("#user_role_association_role_name", cms_url['user_role_association_role_name_dropdown'], '');
    dropdown_chosen_style();
}


function cancel_form_firewall_usre_role_association() {
    display_content_custom("100", "#modalData");
    table_initialize_firewall_user_role_association();
    report_menu_start_firewall_user_role_association();

}


function firewall_user_role_association_onsubmit(){

    var form_id = "form_firewall_user_role_association";
    var response = connectServerWithForm(cms_url['save_firewall_user_role_association'], form_id);

    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_firewall_user_role_association();
        report_menu_start_firewall_user_role_association();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}


function edit_firewall_user_role_association(obj, action_id){

    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_user_role_association');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 2; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }


    display_content_custom('1578', '#modalData');
    $("#user_role_association_role_name").removeAttr("multiple");
    $("#table_title").html("Edit User Role Association");
    // fetchDropDownOption("#user_role_association_full_name", cms_url['user_role_association_full_name_dropdown'], '');
    fetchDropDownOption("#user_role_association_full_name", cms_url['dropdoen_org_user_name'], '');
    fetchDropDownOption("#user_role_association_role_name", cms_url['user_role_association_role_name_dropdown'], '');

    $('#action').val('update');
    $('#action_id').val(action_id);
    $("#user_role_association_full_name option").filter(function() {
        return this.text == dataArray[0];
    }).attr('selected', true);

    $("#user_role_association_role_name option").filter(function() {
        return this.text == dataArray[1];
    }).attr('selected', true);


    $('#submit').html('Update');
    dropdown_chosen_style();


}

function delete_firewall_user_role_association(obj, action_id){

    confirmMessage(this, 'firewall_user_rule_association_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_user_rule_association_yes').click({id: arrayInput}, delete_confirm_firewall_user_role_association);
}


function delete_confirm_firewall_user_role_association(event){

    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

    var response = connectServer(cms_url['save_firewall_user_role_association'], dataInfo);
    if (response.status) {
        alertMessage(this, 'green', '', response.message);

    } else {
        alertMessage(this, 'red', '', response.message);
    }
    table_initialize_firewall_user_role_association();
    report_menu_start_firewall_user_role_association();
}



function user_role_sync(){

    $.ajax({
        type: 'POST',
        url: "conference/webservices/conference/role_management/sync_user_role.php",
        async: false,

        success: function (response) {

            var res = JSON.parse(response);
            if (res.status) {
                alertMessage(this, 'green', 'Successful', res.message);
                display_content_custom("100", "#modalData");
                table_initialize_firewall_user_role_association();
                report_menu_start_firewall_user_role_association();

            } else {
                alertMessage(this, 'red', 'Unsuccessful', res.message);
            }

        }
    });

}