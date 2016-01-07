/**
 * Created by Al-Amin on 1/5/2016.
 */
function add_new_user(){

    showUserMenu('new_user');
}

function add_new_group(){

    showUserMenu('new_group');
}

function edit_user(){

    showUserMenu('edit_user');
}

function create_user() {
    form_id = "create_user";

   // alert("before php Hit js");

    var response = connectServerWithForm(cms_url['admin_user_info'], form_id);


    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful message from js', response.message);
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}


function create_group() {
    form_id = "create_group";

    alert("before php Hit at group js");

    var response = connectServerWithForm(cms_url['admin_group_info'], form_id);

    alert("after php Hit js");

    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful message from js', response.message);
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}



function table_initialize_user_list() {

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_user_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}


function report_menu_start_user_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['user_list'], dataInfo);
     // alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_user_list(dataSet);

}


function table_data_user_list(dataSet) {

    $('#dataTables_user_list').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "ID", "class": "center"},
            {"title": "User Name", "class": "center"},
            {"title": "Type", "class": "center"},
            {"title": "Create Date", "class": "center"},
            {"title": "Group name", "class": "center"},
            {"title": "Status", "class": "center"},
            {"title": "Edit/Delete", "class": "center"},
        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sConferencePath": "conference/img/datatable/conf/copy_csv_xls_pdf.conf",
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


function edit_user_list(obj, info) {

    showUserMenu('edit_user');

    var data = info.split("|");
    $('#action_id').val(data[0]);
    $('#action').val("update");

    $('#user_name').val(data[1]);
    $('#user_type').val(data[2]);
    $('#create_date').val(data[3]);
    $('#group_name').val(data[4]);
    $('#status').val(data[5]);

    dropdown_chosen_style();

}


function delete_user_list(obj, action_id) {

    confirmMessage(this, 'user_list', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#user_list').click({id: arrayInput}, delete_confirm_user_list);

}


function delete_confirm_user_list(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];

    var response = connectServer(cms_url['admin_user_info'], dataInfo);
    response =JSON.parse(response);

    if (response.status) {
        showUserMenu('enterprise_admin');
        alertMessage(this, 'green', 'Successful', response.message);
    }else {
        alertMessage(this, 'red', '', 'Failed.');
    }

}
