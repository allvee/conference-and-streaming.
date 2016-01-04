/**
 * Created by Al-Amin on 1/4/2016.
 */

function check_box_value_changed(){
    if($("#schedule_conf").is(":checked"))
        document.getElementById('hidden_div').style.display = 'block';

    else  if($("#demo_active").is(":checked"))
        document.getElementById('hidden_div').style.display = 'block';

    else  if($("#demo_recording").is(":checked"))
        document.getElementById('hidden_div').style.display = 'block';
    else

        document.getElementById('hidden_div').style.display = 'none';
}


function conference_edit_test() {
    form_id = "conference_edit_test";

    alert("before php Hit js");

    var response = connectServerWithForm(cms_url['conference_info'], form_id);

    //alert("after php Hit js");

    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful message from js', response.message);
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}