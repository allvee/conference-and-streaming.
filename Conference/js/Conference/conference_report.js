/**
 * Created by Al-Amin on 2/2/2016.
 */


function table_initialize_live_conference_list() {

    $('#add_button').html('<div class="frmFldAcc  col-md-5"></div>' +
        '<div class=" frmFldAcc col-md-3">' +
        '<p >' +
        '<h4>Live Conference </h4>' + '</p> </div>' +
        '<div class="frmFldAcc col-md-4"></div>');

    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_live_conference_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');


}


function report_menu_start_participant_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['participant_list'], dataInfo);
    //alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert("DataSet :"+dataSet);
    table_data_live_conference_list(dataSet);

}

function table_data_live_conference_list(dataSet) {

    $('#dataTables_live_conference_list').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "Conference ID", "class": "center"},
            {"title": "Room Number", "class": "center"},
            {"title": "ANO", "class": "center"},
            {"title": "BNO", "class": "center"},
            {"title": "Start Time", "class": "center"},
            {"title": "End Time", "class": "center"},


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

    });
}
