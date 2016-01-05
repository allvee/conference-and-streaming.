/**
 * Created by Al-Amin on 1/5/2016.
 */
function add_new_user(){

    showUserMenu('new_user');
}



function create_user() {
    form_id = "create_user";

    alert("before php Hit js");

    var response = connectServerWithForm(cms_url['admin_info'], form_id);

    //alert("after php Hit js");

    response = JSON.parse(response);
    if (response.status) {
        alertMessage(this, 'green', 'Successful message from js', response.message);
    } else {
        alertMessage(this, 'red', 'Unsuccessful', response.message);
    }


}