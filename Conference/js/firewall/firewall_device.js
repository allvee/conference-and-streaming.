/**
 * Created by Monir Hossain on 5/06/2015.
 */


/* =====================================================
 * Table Initialize
 * =====================================================*/

function table_initialize_firewall_device() {
    $('#table_title').html('Firewall Device');
    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_device_form(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_device" width="100%"><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table>');

}
function show_device_form(){
    display_content_custom('95', '#modalData');
  //  fetchDropDownOption("#org_name", cms_url['firewall_org_options'], '');
}

function table_firewall_device_dataset(dataSet) {
    //alert(dataSet);
    $('#dataTables_firewall_device').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "Divice Name", "class": "center"},
            {"title": "IP", "class": "center"},
            {"title": "User", "class": "center"},
            {"title": "Password", "class": "center"},
            //{"title": "Organization", "class": "center"},
            {"title": "Action", "class": "center"},
        ],
        /*"order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "rcportal/img/datatable/swf/copy_csv_xls_pdf.swf",
            "sRowSelect": "multi",
            "aButtons": [

                {
                    "sExtends": "xls",
                    "sFileName": "*.xls"
                }
            ],
            "filter": "applied"
        }*/
    });
}

function firewall_device_controller() {
    var action = $('#action').val();
    //alert(action);
    var form_id = "firewall_device_form";
    var group_name = $('#group_name').val();
    //alert(group_name);
    var re = /^__[a-zA-Z0-9]/;

    var flag = true;
    //flag = flag && re.test(group_name);
    if (flag) {
        var response = connectServerWithForm(cms_url['firewall_device_info_add'], form_id);
        if (response == 0 || response.trim() === '0') {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
            if (action == 'insert') {
                showUserMenu('firewall_device_view');
            } else {
                showUserMenu('firewall_device_view');
            }

        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }
}



function  firewall_device_view(obj,action_id) {
    //alert();
    var dataSet = [[]];
    var cid = action_id;
    //alert(cid);
    //dataInfo['uid'] = 'test@test.com';

    dataSet = connectServer(cms_url['firewall_device_info_view'], cid);
   // alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_initialize_firewall_device();
    table_firewall_device_dataset(dataSet);

    //console.log("dana");
}


function edit_input_form_firewall_device(obj, action_id) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_device');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 5; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    showUserMenu('firewall_device_add');

    $('#action').val('update');
    $('#action_id').val(action_id);

    $('#name').val(dataArray[0]);

    $('#ip').val(dataArray[1]);
    $('#login_id').val(dataArray[2]);
    $('#password').val(dataArray[3]);
    $('#organization').val(dataArray[4]);

    $('#submit').html('Update');

    dropdown_chosen_style();

}
function delete_firewall_device(obj, action_id) {

    confirmMessage(this, 'firewall_device_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_device_yes').click({id: arrayInput}, delete_confirm_firewall_device);

}

function delete_confirm_firewall_device(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

    // var response = connectServer(cms_url['bwc_timepackage_save_action'], dataInfo,false);
    //var response = connectServerWithForm(cms_url['firewall_time_profile_table_add'], form_id);
    var response = connectServer(cms_url['firewall_device_info_add'], dataInfo,false);
    if (parseInt(response) == 0) {
        alertMessage(this, 'green', '', 'Successfully Deleted.');
        showUserMenu('firewall_device_view');
    } else {
        alertMessage(this, 'red', '', 'Failed.');
    }
}
function public_checkbox_controller() {

    if ($('#public_checkbox').is(':checked')) {
        $('#public_checkbox').val("1");

    } else {
        $('#public_checkbox').val("0");
    }
}

function cancel_form_firewall_device() {
    display_content_custom("150", "#modalData");
    firewall_device_view();

}



