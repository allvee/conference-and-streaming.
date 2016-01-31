
function set_changed_password() {

    var form_id = "form_change_password";
    var flag = false;
    var psswrd = $("#change_password").val();
    var psswrd_retyped = $("#re-type_password").val();
    if ( psswrd == psswrd_retyped ) {
        flag = true;
    } else {
        alertMessage(this, 'yellow', 'Password Mismatch', 'Passwords do not match');
    }

    if(flag){
        var response = connectServerWithForm(cms_url['change_password'], form_id);
        response = JSON.parse(response);
        if (response.status) {
            alertMessage(this, 'green', 'Successful', response.message);
            display_content_custom('1581', '#modalData');

        } else {
            alertMessage(this, 'red', 'Unsuccessful', response.message);
        }
    }


}