$(document).ready(function () {
    bindKeys();
});

function bindKeys() {
    $("#btn_auth_login").click(function () {
        signIn();
    });
}

function signIn() {

    let mEmail = $("#inpAuthEmail").val();
    let mPassword = $("#inpAuthPassword").val();

    showAlert(AlertType.LOADING, "Logowanie do systemu...", '#alertAuthLogin');

    $.ajax({
        url: "/system/auth/signIn",
        method: "POST",
        data: {
            email: mEmail,
            password: mPassword
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.SUCCESS, "Zalogowano pomyślnie!", '#alertAuthLogin');
                location.reload();
            } else if(data.msg != null) {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, data.msg, '#alertAuthLogin');
            } else {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, "Błąd podczas logowania!", '#alertAuthLogin');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas logowania!");
        }
    });
}