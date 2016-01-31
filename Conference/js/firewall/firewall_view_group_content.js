function table_initialize_firewall_content_view() {
    $('#table_title').html('Group Content Status');
    $('#tbl_view_table1').html('<table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" id="dataTables_firewall_group_content" width="100%"  ><tr><td  align="center"><img src="rcportal/img/31.gif"></td></tr></table>');

    $('#back_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-3">' +
        '<button type="button" name="Backy" class="btn btn-primary btn-test" style="background-image:url(img/btn31.png); margin-top:7%; font-size: 14px; background-position: center center" onclick="go_to_group_view(); return false;">' +
        '  <span id="remane_button_wa"> Back </span> ' +
        '</button> </div>' +
        '<div class="frmFldAcc col-md-5"></div>');
}

function table_firewall_content_view_dataset(dataSet) {

    $('#dataTables_firewall_group_content').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Group Content", "class": "center"}
        ]
    });
}

function go_to_group_view(){
  //  display_content_custom('31', '#modalData');
    showUserMenu('firewall_group_view');
}


