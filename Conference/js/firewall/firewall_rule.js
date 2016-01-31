/**
 * Created by Monir Hossain on 5/06/2015.
 */

/* =====================================================
 * Table Initialize
 * =====================================================*/

function table_initialize_firewall_rule() {
    $('#table_title').html('Firewall Rule');
    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_rule_form(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');


     $('#tbl_view_table').html('<form id = "firewall_send_rule_form" onsubmit="send_rule_form(); return false;" <div> <table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" form ="firewall_send_rule_form" onsubmit="send_rule_form(); return false;" id="dataTables_firewall_rule" width="100%"  ><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table> <div class="frmFldAcc  col-md-5"></div>' +
         '<div class=" frmFldAcc col-md-3">' +
        // '<div id= "firewall_mac"></div>' +
         '<button type="submit" class="" style="margin-top: 19%;" > <span id="remane_button_wa">Apply Rules </span></button>'+
         '<div class="frmFldAcc col-md-5"></div> </form>');
}
function show_rule_form(){

    write_activity_log('SHOW_RULE_FROM', 'SHOW_RULE_FROM', cms_url['activity_log']);
    var parental_firewall_service = connectServer(cms_url['firewall_service']);
    if(parental_firewall_service == 1)
        display_content_custom('1583', '#modalData');
    else
        display_content_custom('32', '#modalData');

    fetchDropDownOption("#time_profile_name", cms_url['time_profile_name_dropdown'], '');
    dropdown_chosen_style();

}

function send_rule_form(){
    //write_activity_log('SEND_PATCH_RULE', 'SEND_PATCH_RULE', cms_url['activity_log']);
    var dataInfo = "send";
    var form_id = "firewall_send_rule_form";
    var response = connectServerWithForm(cms_url['rcportal_firewall_rule_send'], form_id);

     if (response == 0 || response.trim()== '0') {
        alertMessage(this, 'green', '', 'Successfully Send.');
        showUserMenu('firewall_rules_view');
    } else if (response == 1 || response.trim()== '1'){
        alertMessage(this, 'red', '', 'Mac address not found. Please set your organization mac address.');
        showUserMenu('firewall_organization_view');
    }else if (response == 2 || response.trim()== '2'){
        alertMessage(this, 'red', '', 'Gateway not found. Please Check your organization mac address.');
        showUserMenu('firewall_organization_view');
    }else if (response == 3 || response.trim()== '3'){
        alertMessage(this, 'red', '', 'Device not configured properly. Please contact your system administrator.');
    }else if (response == 4 || response.trim()== '4'){
        alertMessage(this, 'red', '', 'Please select at least one row.');
    }else if (response == 5 || response.trim()== '5'){
         alertMessage(this, 'red', '', 'Please select mac address for selected rules.');
     }else{
        alertMessage(this, 'red', '', 'Not Found.');
    }
}

function report_menu_start_firewall_rule() {
//alert();
    var dataSet = [[]];
    var dataInfo = {};
    //dataInfo['uid'] = 'test@test.com';
    dataSet = connectServer(cms_url['rcportal_firewall_rule'], dataInfo);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_firewall_rule(dataSet);

    data_table_responsive();
}


function table_data_firewall_rule(dataSet) {

    $('#dataTables_firewall_rule').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Selected Row", "class": "center"},
            {"title": "Rule Name", "class": "center"},
            {"title": "Source Address", "class": "center"},
            {"title": "Dest. Address", "class": "center"},
            {"title": "Port", "class": "center"},
            {"title": "Protocol", "class": "center"},
            {"title": "TimeProfile Name", "class": "center"},
            {"title": "Action", "class": "center"},
            {"title": "Operation", "class": "center"}
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
function edit_input_form_firewall_rule(obj, action_id,public,src_group_type,dst_group_type,action_name,profile_id) {


    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_rule');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 8; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    showUserMenu('firewall_rules_add');
    $('#action').val('update');
    $('#action_id').val(action_id);
    $('#rule_name').val(dataArray[1]);
    $('#source_address').val(dataArray[2]);
    $('#destination_address').val(dataArray[3]);
    $('#port').val(dataArray[4]);
    $("#protocol option[value='" + dataArray[5] + "']").attr('selected', true);
    $("#rule_action option[value='" + action_name + "']").attr('selected', true);
    if (public==1) {
        document.getElementById("public_checkbox").checked = true;
    }
    else{
        document.getElementById("public_checkbox").checked = false;
    }
    if (src_group_type == "ip") {
        document.getElementById("source_checkbox").checked = true;
    }
    else if(src_group_type == "mac"){
        document.getElementById("mac_checkbox").checked = true;
    }

    if (dst_group_type =="ip") {
        document.getElementById("destination_checkbox").checked = true;
    }
    else if(dst_group_type =="host"){
        document.getElementById("host_checkbox").checked = true;
    }

    fetchDropDownOption("#time_profile_name", cms_url['time_profile_name_dropdown'], '');
    $("#time_profile_name option[value='" + profile_id + "']").attr('selected', true);

    $('#submit').html('Update');

}






function firewall_rule_controller() {
    var action = $('#action').val();
    var form_id = "firewall_rule_form";
    var flag = true;

    if (flag) {
        var response = connectServerWithForm(cms_url['rcportal_firewall_rule_submit'], form_id);
        if (response == 0 || response.trim()== '0') {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
            if (action == 'insert') {
                showUserMenu('firewall_rules_view');
            } else {
                showUserMenu('firewall_rules_view');
            }

        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }
}


function source_checkbox_controller() {
    $('#mac_checkbox').prop('checked', false);
    var dropdown_html = '';
    dropdown_html += '<select id="source_address" class="chosen-select form-control" required="required" name="source_address" style="width: 100%">';
    dropdown_html += '</select>';

    var text_html = '';
    text_html = '<input type="text" id="source_address" class="form-control" name="source_address" style="width: 100%" value="" placeholder="Enter Source" required="required">';

    $('#source_address').remove();

    if ($('#source_checkbox').is(':checked')  && !$('#mac_checkbox').is(':checked')) {
        $('#source_checkbox').val("1");
        $('#source_parent').html(dropdown_html);
        fetchDropDownOption('#source_address', cms_url['rcportal_firewall_group_ip'], '');
    } else {
        $('#source_parent').html(text_html);
    }
    dropdown_chosen_style();
}

function mac_checkbox_controller() {
    $('#source_checkbox').prop('checked', false);
    var dropdown_html = '';
    dropdown_html += '<select id="source_address" class="chosen-select form-control" required="required" name="source_address" style="width: 100%">';
    dropdown_html += '</select>';

    var text_html = '';
    text_html = '<input type="text" id="source_address" class="form-control" name="source_address" style="width: 100%" value="" placeholder="Enter Source" required="required">';

    $('#source_address').remove();

    if ($('#mac_checkbox').is(':checked') && !$('#source_checkbox').is(':checked')) {
        $('#mac_checkbox').val("1");
        $('#source_parent').html(dropdown_html);
        fetchDropDownOption('#source_address', cms_url['rcportal_firewall_group_mac'], '');
    } else {
        $('#source_parent').html(text_html);
    }
    dropdown_chosen_style();
}

function destination_checkbox_controller() {
    $('#host_checkbox').prop('checked', false);
    var dropdown_html = '';
    dropdown_html += '<select id="destination_address" class="chosen-select form-control" required="required" name="destination_address" style="width: 100%">';
    dropdown_html += '</select>';

    var text_html = '';
    text_html = '<input type="text" id="destination_address" class="form-control" name="destination_address" style="width: 100%" value="" placeholder="Enter Destination" required="required">';

    $('#destination_address').remove();

    if ($('#destination_checkbox').is(':checked') && !$('#host_checkbox').is(':checked')) {
        $('#destination_checkbox').val("1");
        $('#destination_parent').html(dropdown_html);
        fetchDropDownOption('#destination_address', cms_url['rcportal_firewall_group_ip'], '');
    } else {
        $('#destination_parent').html(text_html);
    }
    dropdown_chosen_style();
}

function host_checkbox_controller() {
    $('#destination_checkbox').prop('checked', false);
    var dropdown_html = '';
    dropdown_html += '<select id="destination_address" class="chosen-select form-control" required="required" name="destination_address" style="width: 100%">';
    dropdown_html += '</select>';

    var text_html = '';
    text_html = '<input type="text" id="destination_address" class="form-control" name="destination_address" style="width: 100%" value="" placeholder="Enter Destination" required="required">';

    $('#destination_address').remove();

    if ($('#host_checkbox').is(':checked') && !$('#destination_checkbox').is(':checked')) {
        $('#host_checkbox').val("1");
        $('#destination_parent').html(dropdown_html);
        fetchDropDownOption('#destination_address', cms_url['rcportal_firewall_group_host'], '');
    } else {
        $('#destination_parent').html(text_html);
    }
    dropdown_chosen_style();
}



/*============== delete operation===========================
 * delete edited by Talemul for added confirmation.
 * =========================================================*/
function delete_firewall_rule(obj, action_id) {

    confirmMessage(this, 'firewall_rule_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_rule_yes').click({id: arrayInput}, delete_confirm_firewall_rule);

}
function delete_confirm_firewall_rule(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];
    var response = connectServer(cms_url['rcportal_firewall_rule_submit'], dataInfo);
    if (response == 0 || response.trim()== '0') {
        alertMessage(this, 'green', '', 'Successfully Deleted.');
        showUserMenu('firewall_rules_view');
    } else {
        alertMessage(this, 'red', '', 'Failed.');
    }

}

function cancel_form_firewall_rule() {
    display_content_custom("150", "#modalData");
    table_initialize_firewall_rule();
    report_menu_start_firewall_rule();

}

function save_bulk_rules() {
    var form_id = "firewall_bulk_upload";
    var fileName = $("#firewal_rule_file").val();
    var fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
    if (fileExtension.toLowerCase() === "xls") {
        var response = connectServerWithForm(cms_url['firewall_bulk_upload_rule'], form_id, false);
        response = JSON.parse(response);
        if (response.status) {
            alertMessage(this, 'green', '', response.message);
            showUserMenu('firewall_rules_bulk_upload');
        }
        else {
            alertMessage(this, 'red', '', response.message);
        }
    }


}


