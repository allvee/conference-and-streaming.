/**
 * Created by Al-Amin on 1/19/2016.
 */

function conference_done_popup()
{
    $('#action').val('retrieve');

   // alert("before php Hit action:" );

    var dataSet = [[]];
    var participant= [];
    var dataInfo = {};
    dataSet = connectServer(cms_url['retrieve_participant_info'], dataInfo);
  //  alert(dataSet);
    dataSet = JSON.parse(dataSet);
	
      //  alert(dataSet.data.length);
    len=0;
    if(dataSet.status){
        for(i=0;i<dataSet.data.length; i++)
        {
            console.log(dataSet.data[i][0]+": "+dataSet.data[i][1]+": "+dataSet.data[i][2]);
            participant[i] = dataSet.data[i][0]+"  ||  "+dataSet.data[i][1]+"  ||  "+dataSet.data[i][2];
            len=i;
        }
        notice=" ";
        for(i=0;i<=len; i++)
        {
            notice = notice+ participant[i]+ "</br> ";
            if (len==0 && notice==" ")
            notice = "";
        }


    } else {
       alert("No Data");
    }
    console.log(len+notice);

    custom_alertMessage(this, 'green', 'Conference Details',conference_notice+notice);
    showUserMenu('enterprise_conference');
}

function Participant_from_backend(){

    document.getElementById("conference_name").textContent=conference_name;
    $('#conference_id').val(conference_id);

    //alert("conference id:"+conference_id);
    console.log("conf_Name:"+conference_name+"and conf_id:"+conference_id);
}

function participant_add_edit(){

    form_id = "participant_add_edit";

    if($("#participant_name").val().trim()=='') {
        alert("Enter participant Name");
    } else if($("#participant_msisdn").val().trim()=='' ||$("#participant_msisdn").val().trim().length < 4 ) {
        alert("Enter participant mobile number correctly (Max 13 digit and Min 4 digit)");
    } else if($("#participant_email").val().trim()=='') {
        alert("Enter participant email");
    }else if($("#participant_type").val()=='') {
        alert("Select participant type");
    }
    else {

        $('#conference_id').val(conference_id);
        var response = connectServerWithForm(cms_url['participant_info'], form_id);
        //alert("after php Hit js: "+response + "   found");

        console.log("get: " + response + " found");

        response = JSON.parse(response);
        //alert("after php Hit js: "+response.status);

        notice = "<br/>Participant Name    : " + response.participant_name + "<br/>Mobile Number     : " + response.msisdn + "<br/>Email  : " + response.participant_email
            + "<br/>Participant Type : " + response.participant_type + "<br/>Listed to Conference    : " + response.participant_conference_name;

        if (response.status) {

            alertMessage(this, 'green', 'Participant Conformation', notice);
            notice = " ";
            showUserMenu('participants_list');
        }

        else {
            alertMessage(this, 'red', 'Unsuccessful', response.message);
        }

    }

}

function add_new_participant() {

    var dataInfo = {};
    var count_response=[];

    count_response = connectServer(cms_url['participant_count'], dataInfo);

    //alert("No_of_participants:"+No_of_participants +" And I find count:"+count);

    count_response = JSON.parse(count_response);

   // alert("After parse:"+count_response);


    if(No_of_participants<=count_response)
    {
        //alert("No_of_participants:"+No_of_participants +" And I find count:"+count_response);
        alertMessage(this, 'red', "   Sorry!!!", "Number of Participants of this Conference is Limited as: "+No_of_participants+"</br> Please Increase the Number of Participants !!");
        showUserMenu('participants_list');
    }
    else
    showUserMenu('add_new_participant');

}


function table_initialize_participant_list() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="margin-top: 7%; font-size: 17px; background-position: center center" onclick="add_new_participant(); return false;">' +
        '<b>New </b>' + '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');

    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_participant_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

    $('#done_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-2">' +
        '<button type="button" class="btn btn-primary btn-test" style="margin-top: 7%; font-size: 17px; background-position: center center" onclick="conference_done_popup(); return false;">' +
        '<b>Done </b>' + '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');
}


function report_menu_start_participant_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['participant_list'], dataInfo);
    //alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert("DataSet :"+dataSet);
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
            {"title": "participant_type", "class": "center"},
            {"title": "Edit/Delete", "class": "center"},


        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "conference/img/datatable/swf/copy_csv_xls_pdf.swf",
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

    });
}


function edit_participant_list(obj, info, conference_name, organization) {

    var data = [];
    var table = document.getElementById('dataTables_participant_list');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 5; i++)
       data[i] = table.rows[index].cells[i].innerHTML;

    showUserMenu('edit_participant');
    document.getElementById("participant_id").textContent=data[0];

    console.log(data[0],data[1],data[2],data[3],conference_name, organization  );

    $('#action').val("update");
    $('#action_id').val(data[0]);
    $('#participant_name').val(data[1]);
    $('#participant_msisdn').val(data[2]);
    $('#participant_email').val(data[3]);
    $('#participant_type').val(data[4]);
    $('#participant_conference_name').val(conference_name);
    $('#participant_organization').val(organization);
    dropdown_chosen_style();


}


function delete_participant_list(obj, action_id, conference_name, organization) {

    confirmMessage(this, 'conference_list', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id, conference_name, organization);
    $('#conference_list').click({id: arrayInput}, delete_confirm_participant_list);

}


function delete_confirm_participant_list(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['action_id'] = arrayInput[1];
    dataInfo['conference_name'] = arrayInput[2];
    dataInfo['organization'] = arrayInput[3];

    var response = connectServer(cms_url['participant_info'], dataInfo);


    // alert("after php get response: "+ response +"  b4json");
    response =JSON.parse(response);

   // alert("after php"+"//"+response.status);

    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        showUserMenu('participants_list');
    }
    else {
        alertMessage(this, 'red', 'Sorry!', 'Failed.');
    }

}

