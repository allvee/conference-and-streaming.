/**
 * Created by Monir Hossain on 5/06/2015.
 */


/* =====================================================
 * Table Initialize
 * =====================================================*/

function table_initialize_firewall_group() {
    $('#table_title').html('Firewall Group');
    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%;  margin-left: -150%; font-size: 17px; background-position: center center" onclick="show_group_form(); return false;">' +
        '</button> </div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="" style=" margin-top: 7%;  margin-left: 25%;" onclick="firewall_group_sync();return false;"> <span id="remane_button_wa">Synchronize</span>'+
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" id="dataTables_firewall_group" width="100%"  ><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table>');

  }

function show_group_form(){
    write_activity_log('VIEW_GROUP_FROM', 'VIEW_GROUP_FROM', cms_url['activity_log']);
    display_content_custom('31', '#modalData');
}

function report_menu_start_firewall_group() {
//alert();
    var dataSet = [[]];
    var dataInfo = {};
    //dataInfo['uid'] = 'test@test.com';
    dataSet = connectServer(cms_url['rcportal_firewall_group'], dataInfo);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_firewall_group(dataSet);

    data_table_responsive();
}


function table_data_firewall_group(dataSet) {
    $('#dataTables_firewall_group').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Group", "class": "center"},
            {"title": "Group Name", "class": "center"},
            {"title": "Group Content", "class": "center"},
            {"title": "Action", "class": "center"},

        ],
       /* "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "rcportal/img/datatable/swf/copy_csv_xls_pdf.swf",
            "sRowSelect": "multi",
            "aButtons": [

                {

                }
            ],
            "filter": "applied"
        }*/
    });
}




/* =====================================================
 * edit function. for read all row
 * =====================================================*/
function edit_input_form_firewall_group(obj, action_id,public) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_group');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 4; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    showUserMenu('firewall_group_add');
    $('#action').val('update');
    $('#action_id').val(action_id);
    $("#group_type option[value='" + dataArray[0] + "']").attr('selected', true);
    $('#group_name').val(dataArray[1]);
    $('#group_content').val(dataArray[2]);
    $('#submit').html('Update');

 //  alert(public);
   if (public==1) {
       document.getElementById("public_checkbox").checked = true;
   }
    else{
       document.getElementById("public_checkbox").checked = false;
   }


    $('#sync').show();

    dropdown_chosen_style();
    if (type.trim() == 'r') {
        $("#group_name").prop({
            'disabled': false,
            'readonly': true
        });
        $("#group_content").prop({
            'disabled': false,
            'readonly': true
        });
    }
}


 

function firewall_group_controller() {

    var action = $('#action').val();
    //alert(action);
    var form_id = "firewall_group_form";
    var group_name = $('#group_name').val();
    //alert(group_name);
    var re = /^__[a-zA-Z0-9]/;

    var flag = true;
    //flag = flag && re.test(group_name);
    if (flag) {
        var response = connectServerWithForm(cms_url['rcportal_firewall_group_submit'], form_id);
        if (response == 0 || response.trim() === '0') {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
            if (action == 'insert') {
                showUserMenu('firewall_group_view');
            } else {
                showUserMenu('firewall_group_view');
            }

        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }
}

function firewall_group_sync() {
  /*  var dataInfo = {};
    dataInfo['group_name'] = $('#group_name').val();
    var sync_content = connectServer(cms_url['rcportal_firewall_sync_content'], dataInfo);
    sync_content = sync_content.trim();
   // $('#group_content').val(sync_content);
*/
    write_activity_log('SYNC_GROUP', 'SYNC_GROUP', cms_url['activity_log']);
    display_content_custom('96', '#modalData');
    fetchDropDownOption("#group_name", cms_url['rcportal_firewall_sync_content'], '');
    //fetchDropDownOption("#group_name", $dir_get_firewall_groups);
}


/*============== delete operation===========================
 * delete edited by Talemul for added confirmation.
 * =========================================================*/
function delete_firewall_group(obj, action_id) {

    confirmMessage(this, 'firewall_group_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_group_yes').click({id: arrayInput}, delete_confirm_firewall_group);

}
function delete_confirm_firewall_group(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

    var response = connectServer(cms_url['rcportal_firewall_group_submit'], dataInfo);
    if (response == 0 || response.trim() == '0') {
        alertMessage(this, 'green', '', 'Successfully Deleted.');
        showUserMenu('firewall_group_view');
    } else {
        alertMessage(this, 'red', '', 'Failed.');
    }

}


function view_group_content(obj,action_id) {
    write_activity_log('SHOW_GROUP_CONTENT', 'SHOW_GROUP_CONTENT', cms_url['activity_log']);
    window.status_group_id = action_id;
    client_timer = setInterval(view_content(window.status_group_id), 10000);
}

function view_content(action_id) {
    var dataSet = [[]];
    var cid = action_id;
    dataSet = connectServer(cms_url['firewall_view_group_content'], cid);
    dataSet = JSON.parse(dataSet);
    display_content_custom('99', '#modalData');
    table_initialize_firewall_content_view();
    table_firewall_content_view_dataset(dataSet);

}

function cancel_form_firewall_group() {
    display_content_custom("150", "#modalData");
    table_initialize_firewall_group();
    report_menu_start_firewall_group();

}

function firewall_sync_group_content() {

    var action = $('#action').val();
    //alert(action);
    var form_id = "firewall_syn_group_form";

    var re = /^__[a-zA-Z0-9]/;

    var flag = true;
    //flag = flag && re.test(group_name);
    if (flag) {
        var response = connectServerWithForm(cms_url['firewall_view_sync_group_content'], form_id);
        if (response == 0 || response.trim() === '0') {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
            if (action == 'insert') {
                showUserMenu('firewall_group_view');
            } else {
                showUserMenu('firewall_group_view');
            }

        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }
}

function cancel_form_firewall_sync_group() {
    display_content_custom("150", "#modalData");
    table_initialize_firewall_group();
    report_menu_start_firewall_group();

}



 