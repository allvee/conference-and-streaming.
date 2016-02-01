/**
 * Created by Anik on 11/24/2015.
 */

function table_initialize_firewall_role() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
            '<div class=" frmFldAcc col-md-2">' +
            '<button type="button" class="btn btn-primary btn-test" style="background-image:url(img/add.png); margin-top: 7%; font-size: 17px; background-position: center center" onclick="show_firewall_role_form(); return false;">' +
            '</button> </div>' +
            '<div class="frmFldAcc col-md-5"></div>');
    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_firewall_role" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}


function report_menu_start_firewall_role() {
    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_role'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_firewall_role(dataSet);

    data_table_responsive();
}


function table_data_firewall_role(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_firewall_role').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Name", "class": "center"},
            {"title": "Organization", "class": "center"},
            {"title": "Action", "class": "center"}
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
        }
    });
    $('th').css("white-space", "nowrap");
    $('th').css("width", "200px");
}


/* =====================================================
 * edit function. for read all row
 * =====================================================*/
function edit_firewall_role(obj, action_id) {
    var dataArray = [];
    var table = document.getElementById('dataTables_firewall_role');
    var index = obj.parentNode.parentNode.rowIndex;
    var i = 0;
    for (i = 0; i < 2; i++) {
        dataArray[i] = table.rows[index].cells[i].innerHTML;
    }
    display_content_custom('1576', '#modalData');
    $("#table_title").html("Edit Role");
    fetchDropDownOption("#org_id", cms_url['role_organization_dropdown'], '');

    $('#role_full_name').focus();
    $('#action').val('update');
    $('#action_id').val(action_id);
    $('#role_full_name').val(dataArray[0]);
    // $('#org_id').val(dataArray[1]);
    $("#org_id option").filter(function() {
        return this.text == dataArray[1];
    }).attr('selected', true);
    dropdown_chosen_style();
}

function firewall_role_onsubmit() {

    var form_id = "form_firewall_role";
    var response = connectServerWithForm(cms_url['save_role'], form_id);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', response.message);
        display_content_custom("100", "#modalData");
        table_initialize_firewall_role();
        report_menu_start_firewall_role();

    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }
}


function delete_firewall_role(obj, action_id) {

    confirmMessage(this, 'firewall_user_yes', 'Delete Confirmation', 'Do you want to delete ?');
    var arrayInput = new Array(obj, action_id);
    $('#firewall_user_yes').click({id: arrayInput}, delete_confirm_firewall_role);

}
function delete_confirm_firewall_role(event) {
    var arrayInput = event.data.id;
    var dataInfo = {}
    dataInfo['action'] = 'delete';
    dataInfo['deleted_id'] = arrayInput[1];
    var response = connectServer(cms_url['save_role'], dataInfo);
    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful', 'response.message');
        display_content_custom("100", "#modalData");
        table_initialize_firewall_role();
        report_menu_start_firewall_role();
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }

}


function show_firewall_role_form() {
    write_activity_log('SHOW_ROLE_FORM', 'SHOW_ROLE_FORM', cms_url['activity_log']);
    display_content_custom('1576', '#modalData');
    $("#table_title").html("New Role");
    fetchDropDownOption("#org_id", cms_url['role_organization_dropdown'], '');

}


function cancel_form_firewall_role() {
    display_content_custom("100", "#modalData");
    table_initialize_firewall_role();
    report_menu_start_firewall_role();

}



/*
 role menu association
 code
 */
function report_role_menu() {

    var dataSet = [[]];
    var dataInfo = {};

    dataInfo['role'] = $("#choose_role_id").val();

    dataSet = connectServer(cms_url['rcportal_firewall_get_menu'], dataInfo);
    dataSet = JSON.parse(dataSet);
    table_data_role_menu(dataSet);

}

function table_data_role_menu(dataset){
    // "bFilter": false,

    $('#dataTables_role_menu').dataTable({
        "bPaginate": true,
        "bLengthChange": false,
        "bFilter": true,
        "bInfo": false,
        "data": dataset,
        "lengthMenu": [[15, -1], [15, "All"]],
        "columns": [
            { "title": "ID", "class":"center"},
            { "title": "Menu Name", "class": "center" },
            { "title": "Add", "class": "center" },
            { "title": "Edit", "class": "center" },
            { "title": "Delete", "class": "center" },
            { "title": "View", "class": "center" }

        ],
        "order": [[0, "asc"]],
        dom: 'T<"clear">lfrtip',
        tableTools: {
            "sSwfPath": "gcportal/img/datatable/swf/copy_csv_xls_pdf.swf",
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

function load_menu_of_current_role(){
    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" id="dataTables_role_menu" width="100%"  ><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');
    report_role_menu();
    $("#dataTables_role_menu").after('<div class="row"> </div><div class="frmFldAcc col-md-4"></div>'+
            '<div class="frmFldAcc col-md-4"> <button id="submit" type="submit" class="" style="margin-top: 10%;" onclick="save_role_menu_association();return false;"><span id="remane_button_wa"> Save </span> </button> </div>'+
        '<div class="frmFldAcc col-md-4"><button type="button" class="" style="margin-top: 10%;" onclick="role_menu_sync();return false;"><span id="remane_button_wa">Sync</span></button></div>'+
        '<div class="frmFldAcc col-md-4"></div></div>'
    );
}

function save_role_menu_association(){
    var oTable = $('#dataTables_role_menu').dataTable();
    var menu_permission_map = {};
    oTable.$('tr').each(function(index,rowHTML){

        var menu_id_node = $(rowHTML).find('td')[0];
        var menu_id =  $(menu_id_node).text();
        menu_id = parseInt(menu_id);

        var checkobxs = $(rowHTML).find('td input[type="checkbox"]');
        var len = checkobxs.length;
        var datas = {};
        for(var i=0;i<len;i++){
            if( $(checkobxs[i]).is(":checked") ){
                if( i===0 ){
                    datas['add']= "yes";
                }
                if( i===1 ){
                    datas['edit']= "yes";
                }
                if(i===2){
                    datas['delete']= "yes";
                }
                if(i===3){
                    datas['view']= "yes";
                }

            }else{
                if( i===0 ){
                    datas['add']= "no";
                }
                if( i===1 ){
                    datas['edit']= "no";
                }
                if(i===2){
                    datas['delete']= "no";
                }
                if(i===3){
                    datas['view']= "no";
                }
            }
        }

        menu_permission_map[menu_id] = datas;
        // console.log(menu_id,datas);
        // console.log(index,rowHTML);
    });

    var dataInfo = {};
    dataInfo['role_id'] = $("#choose_role_id").val();
    dataInfo['permissions'] = menu_permission_map;
    var res = connectServer(cms_url['rcportal_firewall_save_menu'], dataInfo);

    if( parseInt(res) === 0 ){
        alertMessage(this, 'green', 'Successful',"Successfully Saved");
    }else{
        alertMessage(this, 'red', 'Unsuccessful',"Saving Failed!");
    }
}

function role_menu_sync() {
    $.ajax({
        type: 'POST',
        url: "conference/webservices/firewall/role_sync/sync_role_menu.php",
        async: false,

        success: function (response) {
            var res = JSON.parse(response);
            if (res.status) {
                alertMessage(this, 'green', 'Successful', res.message);
                display_content_custom("100", "#modalData");

            } else {
                alertMessage(this, 'red', 'Unsuccessful', res.message);
            }

        }
    });

}


