<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Firewall Configuration</title>
    <link rel="stylesheet" type="text/css" href="../../css/showUGW.css">
    <script src="../../../WebFramework/HTML5/jqry/jquery-1.10.2.min.js"></script>
</head>
<body>
<div class="center">
    <table cellpadding="3" width="900" border="0">
        <tbody>
        <tr class="h">
            <td>
                <h1 class="p">Firewall Configuration</h1>
            </td>
        </tr>
        </tbody>
    </table>
    <br />
<!--
    <h3>Firewall Table</h3>
    <table cellpadding="3" width="900" border="0">
        <tbody id="tbl_firewall_config">
        </tbody>
    </table>
-->
    <h3>Groups</h3>
    <table cellpadding="3" width="900" border="0">
        <tbody id="tbl_firewall_group">
        </tbody>
    </table>

    <h3>Rules</h3>
    <table cellpadding="3" width="900" border="0">
        <tbody id="tbl_firewall_rule">
        </tbody>
    </table>

</div>
</body>
</html>

<script>


  /* function show_fw_config() {
        var data = "";
        var cols = ["id", "device_id", "device_ip", "nfqueue_num", "subnet_mask", "log_level", "firewall_enable", "firewall_directory", "firewall_rule_file", "app_id", "app_password"];
        data = "tbl_name=tbl_firewall_config" + "&col_no=11" + "&cols=" + cols ;
        var html_data = "";
        $.post("show_data.php", data, function (response) {
            $("#tbl_firewall_config").html(response);
        });
    } */

    function show_group_config() {
        var data = "";
        var cols = ["id", "name", "type", "content", "last_updated"];
        data = "tbl_name=groups" + "&col_no=5" + "&cols=" + cols + "&status=1" ;
        var html_data = "";
        $.post("show_data.php", data, function (response) {
            $("#tbl_firewall_group").html(response);
        });
    }

    function show_rule_config() {
        var data = "";
        var cols = ["id", "rule_name","source_address", "destination_address", "port", "protocol", "start_time", "end_time", "action", "last_updated"];
        data = "tbl_name=rules" + "&col_no=9" + "&cols=" + cols + "&status=1" ;
        var html_data = "";
        $.post("show_data.php", data, function (response) {
            $("#tbl_firewall_rule").html(response);
        });
    }


    $(document).ready(function () {
        //show_fw_config();
        show_group_config();
	show_rule_config();


    });
</script>