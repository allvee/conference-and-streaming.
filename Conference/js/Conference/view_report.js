/**
 * Created by Shiam on 2/2/2016.
 */
function load_current_conference_list(){
    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive bootstrap-datatable datatable" id="dataTables_view_report" width="100%"  ><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');
    report_view_conference_report();
    /*$("#dataTables_view_report").after('<div class="row"> </div><div class="frmFldAcc col-md-3"></div>'+
        '<div class="frmFldAcc col-md-4"> <button id="submit" type="submit" class="btn btn-primary" style="margin-top: 10%;" onclick="save_role_menu_association();return false;"><span id="remane_button_wa"> Save </span> </button> </div>'+
        '<div class="frmFldAcc col-md-4"><button type="button" class="btn btn-primary" style="margin-top: 10%;" onclick="role_menu_sync();return false;"><span id="remane_button_wa">Sync</span></button></div>'+
        '<div class="frmFldAcc col-md-1"></div></div>'
    );*/
}

function report_view_conference_report(){
    var dataSet = [[]];
    var dataInfo = {};

    dataInfo['conference_id'] = $("#choose_conference_id").val();

    dataSet = connectServer(cms_url['get_single_conference_report'], dataInfo);
    dataSet = JSON.parse(dataSet);
    table_data_view_single_conference_report(dataSet);
}

function table_data_view_single_conference_report(dataSet) {

    $('#dataTables_view_report').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "ID", "class": "center"},
            {"title": "Ano", "class": "center"},
            {"title": "Conference Name", "class": "center"},
            {"title": "Start Time", "class": "center"},
            {"title": "End Time", "class": "center"},
            {"title": "Conference Total Duration", "class": "center"}
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
}
