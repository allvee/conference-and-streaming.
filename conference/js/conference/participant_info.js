/**
 * Created by Al-Amin on 1/19/2016.
 */


function participant_add_edit(){

    form_id = "participant_add_edit";


    alert("before php Hit js");

    var response = connectServerWithForm(cms_url['participant_info'], form_id);

    console.log("get: "+response +" found");

    response = JSON.parse(response);
    alert("after php Hit js: "+response.status);

    var notice="<br/>Participant Name    : "+response.participant_name +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        +" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"Conference Admin  : "+ response.admin
        +"<br/>Mobile Number     : " + response.msisdn +"<br/>Email  : "+ response.participant_email
        +"<br/>Listed to Conference    : " + response.participant_conference_name;

    if (response.status) {

        alertMessage(this, 'green', 'Participant Conformation',notice );
        showUserMenu('participants_list');
    }

    else
    {
        alertMessage(this, 'red', 'Unsuccessful' , response.message);
    }
}

function add_new_participant() {
    showUserMenu('add_new_participant');

}


function table_initialize_participant_list() {

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_participant_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}


function report_menu_start_participant_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['participant_list'], dataInfo);
    //alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_participant_list(dataSet);

}

function table_data_participant_list(dataSet) {

    $('#dataTables_participant_list').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "ID", "class": "center"},
            {"title": "Name", "class": "center"},
            {"title": "Mobile Number", "class": "center"},
            {"title": "Email", "class": "center"},
            {"title": "Organization", "class": "center"},
            {"title": "Conference Name", "class": "center"},
            {"title": "Edit/Delete", "class": "center"},


        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "conference\img\datatable\swf\copy_csv_xls_pdf.swf",
            "sRowSelect": "multi",
            "aButtons": [
                "copy", "csv",
                {
                    "sExtends": "xls",
                    "sFileName": "*.xls"
                }
            ],
            "filter": "applied"
        },

        /* "aoColumnDefs": [
         { "bSearchable": false, "bVisible": false, "aTargets": [ 4 ] },
         { "bSearchable": false, "bVisible": false, "aTargets": [ 5 ] }
         ]*/

    });
}


function edit_participant_list(obj, info, conference_name) {

    var data = [];
    var table = document.getElementById('dataTables_participant_list');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 6; i++)
        data[i] = table.rows[index].cells[i].innerHTML;

    showUserMenu('edit_participant');
    //document.getElementById("conference_id").textContent=data[0];

    console.log(data[0],data[1],data[2],data[3],data[4],data[5] );

    $('#action').val("update");
    $('#action_id').val(data[0]);
    $('#participant_name').val(data[1]);
    $('#participant_msisdn').val(data[2]);
    $('#participant_email').val(data[3]);
    $('#participant_conference_name').val(data[4]);
    $('#participant_organization').val(data[5]);
    dropdown_chosen_style();


}

