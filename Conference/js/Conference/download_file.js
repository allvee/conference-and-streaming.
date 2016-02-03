/**
 * Created by Al-Amin on 2/2/2016.
 */

function set_download_url( file_name) {
     alert(file_name);
    var data = {};
    // var tcpdump_file = $("#tcpdump_file").val();
    var file_loction = 'conference/download.php'+'?name='+file_name;
    $("#download_file").attr("href", file_loction);
}

function conference_record_download(){

   // alert("i am here!");
   // showUserMenu('download_record');
    showUserMenu('download_list');

}


function table_initialize_download_list() {

    $('#table_title').html('View');

    $('#tbl_view_table').html('<table class="table table-striped table-bordered table-hover responsive" id="dataTables_download_list" width="100%"><tr><td  align="center"><img src="conference/img/31.gif"></td></tr></table>');


}


function report_menu_start_download_list() {

    var dataSet = [[]];
    var dataInfo = {};
    dataSet = connectServer(cms_url['record_file'], dataInfo);
    //alert(dataSet);
    dataSet = JSON.parse(dataSet);
    //alert("DataSet :"+dataSet);
    table_data_download_list(dataSet);

}

function table_data_download_list(dataSet) {

    $('#dataTables_download_list').dataTable({

        "data": dataSet,
        "columns": [
            {"title": "List of Recorded Files", "class": "center"},
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
