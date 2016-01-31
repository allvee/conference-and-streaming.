/**
 * Created by Plabon Dutta on 31-Dec-15.
 */

/**
 * Created by Plabon Dutta on 29-Dec-15.
 */

function table_initialize_role_mngmt_sync_log(){
    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_role_mgnmt_sync_log" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');

}
function report_menu_start_role_mngmt_sync_log(){

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['view_role_mgmt_sync_log'], dataInfo);
    dataSet = JSON.parse(dataSet);

    table_data_role_mngmt_sync_log(dataSet);

    data_table_responsive();

}


function table_data_role_mngmt_sync_log(dataSet) {
    // "bFilter": false,
    //alert(dataSet);
    $('#dataTables_role_mgnmt_sync_log').dataTable({
        "data": dataSet,
        "columns": [
            {"title": "Component", "class": "center"},
            {"title": "Status", "class": "center"},
            {"title": "Remote Host", "class": "center"},
            {"title": "Write Time", "class": "center"},
            {"title": "Last Updated By", "class": "center"},
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

function sync_failed_organization(data){

    $.ajax({
        type: 'POST',
        url: "conference/webservices/firewall/role_sync/sync_organization.php",
        async: false,
        data: {'log_id': data},
        success: function (response) {

            var res = JSON.parse(response);
            if (res.status) {
                alertMessage(this, 'green', 'Successful', res.message);
                display_content_custom("150", "#modalData");
                table_initialize_role_mngmt_sync_log();
                report_menu_start_role_mngmt_sync_log();

            } else {
                alertMessage(this, 'red', 'Unsuccessful', res.message);
            }

        }
    });


}

function sync_failed_role(data){

    $.ajax({
        type: 'POST',
        url: "conference/webservices/firewall/role_sync/sync_user_role.php",
        async: false,
        data: {'log_id': data},
        success: function (response) {

            var res = JSON.parse(response);
            if (res.status) {
                alertMessage(this, 'green', 'Successful', res.message);
                display_content_custom("150", "#modalData");
                table_initialize_role_mngmt_sync_log();
                report_menu_start_role_mngmt_sync_log();

            } else {
                alertMessage(this, 'red', 'Unsuccessful', res.message);
            }

        }
    });
}