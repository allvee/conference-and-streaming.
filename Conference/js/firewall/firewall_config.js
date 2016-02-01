/**
 * Created by Rakibul on 5/13/2015.
 */

function show_firewall(){
    var dataArray = Array();
    var data = '';
    var dataInfo ={};

    data = connectServer(cms_url['rcportal_firewall_show_config'], dataInfo);
    //alert(data);
    dataArray = data.split("|");

    //showUserMenu('firewall_config_add');
   // alert(dataArray[8]);
    $('#firewall_info_DeviceId').val(dataArray[0]);
    $('#firewall_info_DeviceIp').val(dataArray[1]);
    $('#firewall_info_NfqueueNumber').val(dataArray[2]);
    $('#firewall_info_SubnetMask').val(dataArray[3]);
    $("#firewall_info_LogLevel option[value='" + dataArray[4] + "']").attr('selected', true);
    $("#firewall_info_firewallEnable option[value='" + dataArray[5] + "']").attr('selected', true);
    $('#firewall_info_FirewallDirectory').val(dataArray[6]);
    $('#firewall_info_FirewallRuleFile').val(dataArray[7]);
    $('#firewall_info_AppId').val(dataArray[8]);
    $('#firewall_info_AppPassword').val(dataArray[9]);


    $('#submit').html('Update');
    //dropdown_chosen_style();
}


function save_firewall(){

    var action = $("#action").val();
    var form_id = "firewall";
    var action_id = "";
   // alert("1");
    if (action == 'insert') {
        var response = connectServerWithForm(cms_url['rcportal_firewall_save_config'], form_id);
        //alert(response);
        if (parseInt(response) == 0) {
            alertMessage(this, 'green', '', 'Successfully Submitted.');
           // showUserMenu('bwc_client_add');
        } else {
            alertMessage(this, 'red', '', 'Failed.');
        }
    }

}


function show_firewall_ini_config(){
    var dataArray = Array();
    var data = ' ';
    var dataInfo ={};

    data = connectServer(cms_url['firewall_ini_show_config_action'], dataInfo);
    //data += '</pre>';
//alert(data);
    $('#firewall_info_FirewallINI_text').html(data);

}


function firewall_config() {
//    alert();
    var new_window_features = 'directories=no,titlebar=no,toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width=1000, height=600';
    window.open(cms_url['firewall_config'], 'Firewall Info', new_window_features);
    return false;
}

