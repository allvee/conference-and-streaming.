function firewall_stop(){
  write_activity_log('APPLICATION_STOP', 'APPLICATION_STOP', cms_url['activity_log']);
  var data = {};
  data['cmd'] = 'stop';
  var res = connectServer(cms_url['firewall_maintenance_cmd'], data,false);
  $("#command_output_box").append(res).scrollTop($("#command_output_box")[0].scrollHeight);
}

function firewall_start(){
  write_activity_log('APPLICATION_START', 'APPLICATION_START', cms_url['activity_log']);
  var data = {};
  data['cmd'] = 'start';
  var res = connectServer(cms_url['firewall_maintenance_cmd'], data,false);
  $("#command_output_box").append(res).scrollTop($("#command_output_box")[0].scrollHeight);
}


function firewall_reload(){
  write_activity_log('APPLICATION_RELOAD', 'APPLICATION_RELOAD', cms_url['activity_log']);
  var data = {};
  data['cmd'] = 'restart';
  var res = connectServer(cms_url['firewall_maintenance_cmd'], data,false);
  $("#command_output_box").append(res).scrollTop($("#command_output_box")[0].scrollHeight);
}

function firewall_refresh(){

  write_activity_log('WINDOW_REFRESH', 'WINDOW_REFRESH', cms_url['activity_log']);
	$("#command_output_box").html("");
}
