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
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(gcportal/img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_rule_form(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');



     $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" id="dataTables_firewall_rule" width="100%"  ><tr><td  align="center"><img src="gcportal/img/31.gif"></td></tr></table>');

     $('#send_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-3">' +
        '<button type="button" name="Apply" class="btn btn-primary btn-test" style="background-image:url(img/btn31.png); margin-top:7%; font-size: 17px; background-position: center center" onclick="send_rule_form(); return false;">' +
        '  <span id="remane_button_wa"> <!--<i class="fa fa-plus"></i>--> Patch Rules </span> ' +
         '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');


}
function show_rule_form(){
    display_content_custom('32', '#modalData');
    $(function () {
        $('#start_time').datetimepicker({
            language: 'en',
            datepicker:false,
            format:'H:i'
        });
    });

    $(function () {
        $('#end_time').datetimepicker({
            language: 'en',
            datepicker:false,
            format:'H:i'
        });
    });
}

function send_rule_form(){
    var dataInfo = "send";
    var response = connectServer(cms_url['rcportal_firewall_rule_send'], dataInfo);

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
            {"title": "Rule Name", "class": "center"},
            {"title": "Source Address", "class": "center"},
            {"title": "Dest. Address", "class": "center"},
            {"title": "Port", "class": "center"},
            {"title": "Protocol", "class": "center"},
            {"title": "Start Time", "class": "center"},
            {"title": "End Time", "class": "center"},
            {"title": "Action", "class": "center"},
            {"title": "Operation", "class": "center"}
        ],
       /* "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "gcportal/img/datatable/swf/copy_csv_xls_pdf.swf",
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
function edit_input_form_firewall_rule(obj, action_id,public,src_group_type,dst_group_type) {


    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_rule');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 7; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    showUserMenu('firewall_rules_add');
    $('#action').val('update');
    $('#action_id').val(action_id);
    $('#rule_name').val(dataArray[0]);
    $('#source_address').val(dataArray[1]);
    $('#destination_address').val(dataArray[2]);
    $('#port').val(dataArray[3]);
    $("#protocol option[value='" + dataArray[4] + "']").attr('selected', true);
    $('#start_time').val(dataArray[5]);
    $('#end_time').val(dataArray[6]);
    $("#rule_action option[value='" + dataArray[7] + "']").attr('selected', true);

    if (public==1) {
        document.getElementById("public_checkbox").checked = true;
    }
    else{
        document.getElementById("public_checkbox").checked = false;
    }
    if (src_group_type == "ip") {
      //  alert(src_group_type);
        document.getElementById("source_checkbox").checked = true;
    }
    else if(src_group_type == "mac"){
      //  alert(src_group_type);
        document.getElementById("mac_checkbox").checked = true;
    }

    if (dst_group_type =="ip") {
      //  alert(dst_group_type);
        document.getElementById("destination_checkbox").checked = true;
    }
    else if(dst_group_type =="host"){
       // alert(dst_group_type);
        document.getElementById("host_checkbox").checked = true;
    }
    $('#submit').html('Update');
    dropdown_chosen_style();
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


