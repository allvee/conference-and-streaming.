/**
 * Created by Al-Amin on 1/4/2016.
 */
var conference_notice;
var conference_name;
var conference_id;
var No_of_participants;

var minDuration=30;
var d = new Date,
    dformat = [
            d.getFullYear(),
            (d.getMonth()+1),
            d.getDate(),
            ].join('/')+
        ' ' +
        [ d.getHours(),
            d.getMinutes()].join(':');

    month = d.getMonth()+1;
    day = d.getDate();
    hour = d.getHours();
    minute = d.getMinutes()+minDuration;
if(minute >= 60)
{
    minute = minute % 60;
    hour = hour + 1;

    if(hour >= 24)
    {
        hour = hour % 24;
        day = day+1;

        if(day >= 31)
        {
            day = day % 31;
            month = month+1;
        }
    }
}


lastDate = [
        d.getFullYear(),
        (d.getMonth()+1),
        day, ].join('/')

    + ' ' + [ hour,  minute].join(':');

console.log(dformat);


function check_box_value_changed(){

    if($("#meet_now").is(":checked"))
    {
        $('#start_time').val(dformat);
        $('#end_time').val(lastDate);
     }

    else
    {
        $('#start_time').val("");
        $('#end_time').val("");
    }


    console.log(lastDate);


}


function add_new_conference() {
    showUserMenu('new_conference');

}

function from_backend(){
    var field = document.getElementById("user_id");
    field.value = $.parseJSON( sessionStorage.getItem('cms_auth')).UserID;
    document.getElementById("user_id").textContent=field.value;
    console.log(field.value);
}


function conference_create_edit() {
    form_id = "conference_create_edit";


    alert("before php Hit js");

    var response = connectServerWithForm(cms_url['conference_info'], form_id);
    alert("after php Hit js");
    console.log("get: "+response +" found");

    alert("after php Hit js");

    response = JSON.parse(response);
    alert("after php Hit js: "+response.status);

    conference_name=response.Name;
    No_of_participants=response.No_of_Participants;

    conference_id = response.conf_id;

    alert("conference_id:"+conference_id);

    conference_notice="<br/>Conference Name    : "+response.Name +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        +"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
        +" &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"+"UserID    : "+ response.UserID
    +"<br/>Long Number     : " + response.Long_Number +"<br/>Web Link    : "+ response.Web_Link
    +"<br/>Code    : "+ response.Code +"<br/>Start Time     : " + response.Start_Time
    +"<br/>End Time    : "+ response.End_Time +"<br/>Conference Duration     : " +response.Conference_Duration.h+" : "+ response.Conference_Duration.i
    +"<br/>Recording     : " + response.Recording +"<br/>Stats   : "+ response.Stats +"<br/>Notification Channel     : " + response.Notification_Channel
    +"<br/>Schedule Conf   : "+ response.Schedule_Conf
    +"<br/><b>Participants :</b> <br/>";

    if (response.status) {

       // alertMessage(this, 'green', '           Conference Conformation', conference_notice );
        showUserMenu('participants_list');
    }

    else
    {
        alertMessage(this, 'red', 'Unsuccessful' , response.message);
    }
}

function cancel_form_create_conference(){

    display_content_custom('1817', '#modalData');
    table_initialize_conference_list();
    report_menu_start_conference_list();
}

function table_initialize_conference_list() {


    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="margin-top: 7%; font-size: 17px; background-position: center center" onclick="add_new_conference(); return false;">' +
        '<b>New </b>' + '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');

    $('#table_title').html('View');
    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_conference_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}



function report_menu_start_conference_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['conference_list'], dataInfo);
    // alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert(dataSet);
    table_data_conference_list(dataSet);

}


function table_data_conference_list(dataSet) {

    $('#dataTables_conference_list').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "ID", "class": "center"},
            {"title": "Conf Name", "class": "center"},
            {"title": "User", "class": "center"},
            {"title": "Start Time", "class": "center"},
            {"title": "End Time", "class": "center"},
            {"title": "Participants", "class": "center"},
            {"title": "Recording", "class": "center"},
            {"title": "Notification Channel", "class": "center"},
            {"title": "Status", "class": "center"},
            /*{"title": "Room Number", "class": "center"},
            {"title": "Web Link", "class": "center"},*/
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
            { "bSearchable": false, "bVisible": false, "aTargets": [ 9 ] },
            { "bSearchable": false, "bVisible": false, "aTargets": [ 10 ] }
        ]*/

    });
}

function edit_conference_list(obj, info, room_number, weblink) {

    var data = [];
    var table = document.getElementById('dataTables_conference_list');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 9; i++)
        data[i] = table.rows[index].cells[i].innerHTML;

    showUserMenu('edit_conference');
    document.getElementById("conference_id").textContent=data[0];
    conference_id =data[0];
    console.log(data[0],data[1],data[2],data[3],data[4],data[5],data[6],data[7],data[8], room_number, weblink );

     $('#action').val("update");
     $('#action_id').val(data[0]);
     $('#demo_name').val(data[1]);
     $('#user_id').val(data[2]);
     $('#start_time').val(data[3]);
     $('#end_time').val(data[4]);
     $('#demo_participants').val(data[5]);
     $('#demo_recording').val(data[6]);
     $('#notification_channel').val(data[7]);
     $('#status').val(data[8]);
     $('#room_number').val(room_number);
     $('#weblink').val(weblink);
     dropdown_chosen_style();


}


function delete_conference_list(obj, action_id, room_number) {

    confirmMessage(this, 'conference_list', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id, room_number);
    $('#conference_list').click({id: arrayInput}, delete_confirm_conference_list);

}


function delete_confirm_conference_list(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];
    dataInfo['room_number'] = arrayInput[2];

    var response = connectServer(cms_url['conference_info'], dataInfo);


    alert("after php get response: "+ response +"  b4json");
    response =JSON.parse(response);

    alert("after php"+"//"+response.status);

    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        showUserMenu('enterprise_conference');
    }
    else {
        alertMessage(this, 'red', 'Sorry!', 'Failed.');
    }

}

