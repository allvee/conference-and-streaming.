/**
 * Created by Plabon Dutta on 22-Nov-15.
 */


function table_initialize_firewall_organization() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_firewall_organization_form(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');
    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_organization" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}


function report_menu_start_firewall_organization() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_organization'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_organization(dataSet);

    data_table_responsive();
}


function table_data_firewall_organization(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_organization').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Name", "class": "center"},
            {"title": "Parent Organization", "class": "center"},
            {"title": "Master Organization", "class": "center"},
            /*{"title": "IP Addresses", "class": "center"},
            {"title": "MAC Addresses", "class": "center"}, */
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
    $('th').css("white-space", "200px");
}


/* =====================================================
 * edit function. for read all row
 * =====================================================*/
function edit_firewall_organization(obj, action_id) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_organization');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 5; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    display_content_custom('1574', '#modalData');
    $('#table_title').html('Edit Organization');
    fetchDropDownOption('#parent_id', cms_url['get_organizations'], '');

    $('#organization_name').focus();
    $('#action').val('update');
    $('#action_id').val(action_id);
    $('#organization_name').val(dataArray[0]);

    var parent = dataArray[1];
    $("#parent_id option").filter(function() {
        return this.text == parent;
    }).attr('selected', true);

    var master_company = dataArray[2];
    $("#master_company_id option").filter(function() {
        return this.text == master_company;
    }).attr('selected', true);

   // $('#organization_ip').val(dataArray[3]);
   // $('#organization_mac').val(dataArray[4]);

    $("#parent_id").trigger("chosen:updated");
    dropdown_chosen_style();
}

function firewall_organization_onsbmt() {

    var form_id = "form_firewall_organization";
    var response = connectServerWithForm(cms_url['save_organization'], form_id);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_firewall_organization();
        report_menu_start_firewall_organization();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }
}


function delete_firewall_organization(obj, action_id) {

    confirmMessage(this, 'firewall_organization_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_organization_yes').click({id: arrayInput}, delete_confirm_firewall_organization);

}
function delete_confirm_firewall_organization(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['deleted_id'] = arrayInput[1];
    var response = connectServer(cms_url['save_organization'], dataInfo);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', 'response.message');
        display_content_custom("100", "#modalData");
        table_initialize_firewall_organization();
        report_menu_start_firewall_organization();
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }

}


function show_firewall_organization_form() {
    write_activity_log('SHOW_ORGANIZATION_FORM', 'SHOW_ORGANIZATION_FORM', cms_url['activity_log']);
    display_content_custom('1574', '#modalData');
    $('#table_title').html('New Organization');
    fetchDropDownOption('#parent_id', cms_url['get_organizations'], '');
    dropdown_chosen_style();
}


function cancel_form_firewall_organization() {
    display_content_custom("100", "#modalData");
    table_initialize_firewall_organization();
    report_menu_start_firewall_organization();

}



