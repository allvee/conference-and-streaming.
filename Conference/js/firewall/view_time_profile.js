/**
 * Created by Rakibul on 5/13/2015.
 */

function table_initialize_firewall_time_profile() {

    $('#table_title').html('Firewall Time Profile');
    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_timeprofile_form(); return false;">' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');
    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_time_profile" width="100%"><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table>');

}

function show_timeprofile_form(){
    write_activity_log('SHOW_TIME_PROFILE_FROM', 'SHOW_TIME_PROFILE_FROM', cms_url['activity_log']);
    display_content_custom('94', '#modalData');
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

function table_firewall_time_profile_dataset(dataSet) {
     //alert(dataSet);
    $('#dataTables_firewall_time_profile').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "Time Profile Name", "class": "center"},
            {"title": "Days", "class": "center"},
            {"title": "Start Time", "class": "center"},
            {"title": "End Time", "class": "center"},
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

function  firewall_time_profile_view(obj,action_id) {
   // alert();
    var dataSet = [[]];
    var cid = action_id;
    //alert(cid);
    //dataInfo['uid'] = 'test@test.com';

    dataSet = connectServer(cms_url['firewall_time_profile_table_view'], cid);
     //alert(dataSet);
    dataSet = JSON.parse(dataSet);
   // alert(dataSet);
    table_initialize_firewall_time_profile();
    table_firewall_time_profile_dataset(dataSet);

    //console.log("dana");
}


function save_firewall_time_package() {
    var action = $('#action').val();
    var form_id = "edit_timepackage_info";
   // var group_name = $('#group_name').val();
    var re = /^__[a-zA-Z0-9]/;

    var flag = true;
    //flag = flag && re.test(group_name);
    if (flag) {

        var response = connectServerWithForm(cms_url['firewall_time_profile_table_add'], form_id);
        if (response == 0 || response.trim() === '0') {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
            if (action == 'insert') {
                showUserMenu('firewall_time_profile_view');
            } else {
                showUserMenu('firewall_time_profile_view');
            }

        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }
}

function edit_input_form_firewall_timeprofile(obj, action_id, public,days) {

    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_time_profile');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 4; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    showUserMenu('firewall_time_profile_add');

    $('#action').val('update');
    $('#action_id').val(action_id);

    $('#time_package_Name').val(dataArray[0]);

    var track_array = days.split(',');

    for (var i = 0; i < track_array.length; i++) {
        $("#firewall_timepackage option[value='" + track_array[i] + "']").attr('selected', true);
    }

    $('#start_time').val(dataArray[2]);
    $('#end_time').val(dataArray[3]);

    if (public == 1) {
        document.getElementById("public_checkbox").checked = true;
    }
    else{
        document.getElementById("public_checkbox").checked = false;
    }

    dropdown_chosen_style();
    $('#submit').html('Update');



}
function delete_firewall_timeprofile(obj, action_id) {

    confirmMessage(this, 'bwc_timepackage_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#bwc_timepackage_yes').click({id: arrayInput}, delete_confirm_firewall_timeprofile);

}
function delete_confirm_firewall_timeprofile(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

   // var response = connectServer(cms_url['bwc_timepackage_save_action'], dataInfo,false);
    //var response = connectServerWithForm(cms_url['firewall_time_profile_table_add'], form_id);
    var response = connectServer(cms_url['firewall_time_profile_table_add'], dataInfo,false);
    if (parseInt(response) == 0) {
        alertMessage(this, 'green', '', 'Successfully Deleted.');
        showUserMenu('firewall_time_profile_view');
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
function cancel_form_firewall_timeprofile() {
    display_content_custom("150", "#modalData");
    firewall_time_profile_view();

}

