/**
 * Created by Al-Amin on 1/19/2016.
 */


function participant_add_edit(){

    form_id = "participant_add_edit";


    alert("before php Hit js");

    var response = connectServerWithForm(cms_url['participant_info'], form_id);

    console.log("get: "+response +" found");

    response = JSON.parse(response);
    alert("after php Hit js: "+response.status);

    if (response.status) {

        alertMessage(this, 'green', 'Participant Conformation','successfully saved' );
        showUserMenu('participants_list');
    }

    else
    {
        alertMessage(this, 'red', 'Unsuccessful' , response.message);
    }
}