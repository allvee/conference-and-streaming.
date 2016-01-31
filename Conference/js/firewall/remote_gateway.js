/**
 * Created by Plabon Dutta on 29-Dec-15.
 */

function table_initialize_remote_gateway() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_form_firewall_remote_gw(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');
    $('#table_title').html('Remote Gateway');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_remote_gw" width="100%"><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table>');

}


function report_menu_start_remote_gateway() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_remote_gw'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_remote_gw(dataSet);

    data_table_responsive();
}


function table_data_firewall_remote_gw(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_remote_gw').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "IP Address", "class": "center"},
            {"title": "Action", "class": "center"}
        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "rcportal/img/datatable/swf/copy_csv_xls_pdf.swf",
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




function firewall_remote_gateway(){

    var form_id = "form_firewall_remote_gw";
    var response = connectServerWithForm(cms_url['save_remote_gw'], form_id);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_remote_gateway();
        report_menu_start_remote_gateway();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }

}


function delete_remote_gateway(obj, data) {
    confirmMessage(this, 'delete_remote_gw', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, data);
    $('#delete_remote_gw').click({id: arrayInput}, delete_confirm_remote_gateway);

}

function delete_confirm_remote_gateway(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['deleted_id'] = arrayInput[1];
    var response = connectServer(cms_url['save_remote_gw'], dataInfo);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', 'response.message');
        display_content_custom("100", "#modalData");
        table_initialize_remote_gateway();
        report_menu_start_remote_gateway();
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }

}


function edit_remote_gateway(obj, data) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_remote_gw');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 2; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    display_content_custom('1596', '#modalData');
    $('#table_title').html('Edit Gateway');

    $('#remane_button_wa').html('Update');
    $('#ip_address').focus();
    $('#action').val('update');
    $('#action_id').val(data);
    $('#ip_address').val(dataArray[0]);


}


function show_form_firewall_remote_gw() {
    display_content_custom('1596', '#modalData');
    $('#table_title').html('New Gateway');

}


function cancel_form_firewall_remote_gw() {
    display_content_custom("100", "#modalData");
    table_initialize_remote_gateway();
    report_menu_start_remote_gateway();

}
