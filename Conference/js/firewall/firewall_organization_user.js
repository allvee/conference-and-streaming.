/**
 * Created by Anik on 11/30/2015.
 */

function table_initialize_firewall_org_user() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
    '<div class=" frmFldAcc col-md-2">' +
    '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_firewall_org_user(); return false;">' +
    '</button> </div>' +
    '<div class="frmFldAcc col-md-5"></div>');
    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_org_user" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');
    $('#dataTables_firewall_org_user').after('<div class=" frmFldAcc col-md-5"></div><div class="frmFldAcc col-md-5"><button type="button" class="" style="margin-right: 25%;" onclick="organization_sync();return false;"><span id="remane_button_wa">Sync</span></button></div>');

}

function report_menu_start_firewall_org_user() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_organization_user'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_org_user(dataSet);

    data_table_responsive();
}

function table_data_firewall_org_user(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_org_user').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "User Name", "class": "center"},
            {"title": "Organization Name", "class": "center"},
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



function show_firewall_org_user() {
    write_activity_log('SHOW_ORGANIZATION_USER_FORM', 'SHOW_ORGANIZATION_USER_FORM', cms_url['activity_log']);
    display_content_custom('1580', '#modalData');
    $("#table_title").html("Add Organization User");
    fetchDropDownOption("#organization_user_name", cms_url['dropdoen_org_user_name'], '');
    fetchDropDownOption("#organization_user_organization_name", cms_url['dropdown_org_user_organization_name'], '');
    dropdown_chosen_style();
}




function cancel_form_firewall_organization_user() {
    display_content_custom("100", "#modalData");
    table_initialize_firewall_org_user();
    report_menu_start_firewall_org_user();

}

function save_firewall_organization_user(){
    var form_id = "form_firewall_organization_user";
    var response = connectServerWithForm(cms_url['save_organization_user'], form_id);

    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_firewall_org_user();
        report_menu_start_firewall_org_user();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}





function edit_firewall_organization_user(obj, action_id){

    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_org_user');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 2; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }


    display_content_custom('1580', '#modalData');
    $("#table_title").html("Edit Organization User");
    fetchDropDownOption("#organization_user_name", cms_url['dropdoen_org_user_name'], '');
    fetchDropDownOption("#organization_user_organization_name", cms_url['dropdown_org_user_organization_name'], '');
    

    $('#action').val('update');
    $('#action_id').val(action_id);

    $("#organization_user_name option").filter(function() {
        return this.text == dataArray[0];
    }).attr('selected', true);


    $("#organization_user_organization_name option").filter(function() {
        return this.text == dataArray[1];
    }).attr('selected', true);



    $('#submit').html('Update');

dropdown_chosen_style();

}

function delete_firewall_organization_user(obj, action_id){

    confirmMessage(this, 'firewall_user_rule_association_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_user_rule_association_yes').click({id: arrayInput}, delete_confirm_firewall_organization_user);
}


function delete_confirm_firewall_organization_user(event){

    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];
  

    var response = connectServer(cms_url['save_organization_user'], dataInfo);
    if (response.status) {
        alertMessage(this, 'green', '', response.message);

    } else {
        alertMessage(this, 'red', '', response.message);
    }
    table_initialize_firewall_org_user();
    report_menu_start_firewall_org_user();
}

function organization_sync(){

    $.ajax({
        type: 'POST',
        url: "conference/webservices/firewall/role_sync/sync_organization.php",
        async: false,

        success: function (response) {

            var res = JSON.parse(response);
            if (res.status) {
                alertMessage(this, 'green', 'Successful', res.message);
                display_content_custom("100", "#modalData");
                table_initialize_firewall_org_user();
                report_menu_start_firewall_org_user();

            } else {
                alertMessage(this, 'red', 'Unsuccessful', res.message);
            }

        }
    });

}