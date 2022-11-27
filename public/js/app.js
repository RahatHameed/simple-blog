const selectors = {
    username: '#username',
    password: '#password',
    title: '#title',
    text: '#text',
    imageUrl: '#image_url',
    resMsg: '#res_msg',
};

function userLogin() {

    $(selectors.resMsg).html('');
    if($(selectors.username).val() =='' || $(selectors.password).val() =='' || $(selectors.image_url).val() ==''){
        $(selectors.resMsg).html('Please fill required fields.');
        return false;
    }
    var form_data = new FormData();
    form_data.append("username", $(selectors.username).val());
    form_data.append("password", $(selectors.password).val());

    $.ajax({
        url: "/user-login",
        type: "POST",
        processData: false,
        contentType: false,
        data: form_data,
        dataType: 'json',
        success:
            function (result) {
                window.location.replace("/");
            },
        error:
            function (result) {
                $(selectors.resMsg).html(result.responseJSON);
            }
    });
}

function addArticle() {

    $(selectors.resMsg).html('');
    if ($(selectors.title).val() == '' || $(selectors.text).val() == '') {
        $(selectors.resMsg).html('Please fill required fields.');
        return false;
    }

}