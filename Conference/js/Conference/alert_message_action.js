/**
 * Created by Al-Amin on 2/10/2016.
 */

function alert_msg_add_event() {

    var form_id = 'alert_message_event_add';
    var response_of_user_info = connectServerWithForm(cms_url['alert_msg_event_add'], form_id);

    if (response_of_user_info == 1) {
        alertMessage(this, 'red', '', 'fail !');
    } else {
        alertMessage(this, 'green', '', 'Success');

        if ($('#action').val() == "update") {
            display_content_custom("150", "#modalData");
            table_initialize_alert_event();
            report_menu_alert_event();
        }

    }
}

function edit_alert_msg_event(obj, info) {

    var data = info.split("|");

    display_content_custom("81", "#modalData");

    $('#action_id').val(data[0]);
    $('#action').val("update");
    $('#event_name').val(data[1]);
    $('#event_msg').val(data[2]);
}

function table_initialize_alert_event() {

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_rcportal_alert_evt" width="100%"><tr><td  align="center" style="text-align:center"><img src="rcportal/img/31.gif"></td></tr></table>');

}


function report_menu_alert_event() {
//alert();
    var dataSet = [[]];
    var dataInfo = {};
    //dataInfo['uid'] = 'test@test.com';
    dataSet = connectServer(cms_url['alert_msg_event_view'], dataInfo);
    //  alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_alert_event(dataSet);

}


function table_data_alert_event(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_rcportal_alert_evt').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "ID", "class": "center"},
            {"title": "Event name", "class": "center"},
            {"title": "Message", "class": "center"},
            {"title": "MANAGE", "class": "center"},
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
}

function display_alert_email()
{
    $.ajax({
        url: cms_url['alert_msg_email_data'],
        type: 'POST',
        success: function (result) {
            if (result != "" && result != null) {
                var data = JSON.parse(result);
                $('#email_address').val(data['email']);
                $('#password').val(data['password']);
                $('#smtp_account').val(data['smtp_account']);
                $('#smtp_port').val(data['smtp_port']);
                $('#email_subject').val(data['email_subject']);
                $('#email_body').val(data['email_body']);
            }
        }
    });
}

function save_alert_mail() {

    var form_id = 'alert_email_config';
    var response = connectServerWithForm(cms_url['alert_msg_email_add'], form_id);
     alert(response);
     var response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }
}

function display_alert_sms() {

    $.ajax({
        url: cms_url['alert_msg_sms_data'],
        type: 'POST',
        success: function (result) {
            // alert(result);
            if (result != "" && result != null) {
                var data = JSON.parse(result);
                $('#api_url').val(decodeURIComponent(data['api_url']));
                $('#user_name').val(data['user_name']);
                $('#password').val(data['password']);
                $('#mask').val(data['mask']);
                $('#sms_text').val(data['sms_text']);
            }
        }
    });
}

function display_client_api() {
    $.ajax({
        url: cms_url['get_client_data'],
        type: 'POST',
        success: function (result) {
            // alert(result);
            if (result != "" && result != null) {
                var data = JSON.parse(result);

                $("#api_url").html(data['client_api']);
                $("#api_url").val($("#api_url").text());
                $('#report_type').val(data['report_type']);

            }
        }
    });
}

function save_user_api_config() {
    var api_url = $('#api_url').val();
    var report_type = $('#report_type').val();

    $.ajax({
        url: cms_url['save_client_api_data'],
        type: 'POST',
        data: {api_url: api_url, report_type: report_type},
        success: function (data) {
            var response = JSON.parse(data);
            if (response.status) {
                alertMessage(this, 'green', 'Successful', response.message);
            } else {
                alertMessage(this, 'red', 'Unsuccessful', response.message);
            }
        }
    });

}

function save_alert_sms() {

    // var form_id = 'alert_sms_config';
    // var response_of_user_info = connectServerWithForm(cms_url['alert_msg_sms_add'], form_id);

    var api_url = $('#api_url').val();
    var user_name = $('#user_name').val();
    var password = $('#password').val();
    var mask = $('#mask').val();
    var sms_text = $('#sms_text').val();
    //console.log(sms_text);

    //api_url = encodeURIComponent(api_url);
    api_url = api_url;

    $.ajax({
        url: cms_url['alert_msg_sms_add'],
        type: 'POST',
        data: {api_url: api_url, user_name: user_name, password: password, mask: mask, sms_text: sms_text},
        success: function (data) {
            var response = JSON.parse(data);
            if (response.status) {
                alertMessage(this, 'green', 'Successful', response.message);
            } else {
                alertMessage(this, 'red', 'Unsuccessful', response.message);
            }
        }
    });


}



/*============== delete operation===========================
 * delete edited by Talemul for added confirmation.
 * =========================================================*/
function delete_alert_msg_event(obj, action_id) {

    confirmMessage(this, 'alert_msg_event_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#alert_msg_event_yes').click({id: arrayInput}, delete_confirm_alert_msg_event);

}
function delete_confirm_alert_msg_event(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

    var response = connectServer(cms_url['alert_msg_event_add'], dataInfo);
    response = JSON.parse(response);
    if (response.status) {
        showUserMenu('alert_mgt_event_view');
        alertMessage(this, 'green', 'Successful', response.message);
    } else {
        alertMessage(this, 'red', '', 'Failed.');
    }

}


function email_subject_send(id) {
    
   console.log(id);
    //alert(id);

   // console.log("Body:"+$("input#body").prop("checked"));
   // console.log("Subject:"+$("input#subject").prop("checked"));
    if ( $("input#subject").prop("checked") === true ) {
        
        var read = $('#email_subject').val();
        var set = "[" + $('#' + id).val() + "] ";
        $('#email_subject').val(read + set);
    }
   
    
    if(  $("input#body").prop("checked") === true  ) {
        //console.log('body');
        var read = $('#email_body').val();
        var set = "[" + $('#' + id).val() + "] ";
        $('#email_body').val(read + set);

    }


}

function sms_text_send(id) {

    var read = $('#sms_text').val();
    var set = "[" + $('#' + id).val() + "] ";
    $('#sms_text').val(read + set);

}





