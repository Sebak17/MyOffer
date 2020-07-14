$(document).ready(function () {
    bindKeysSignIn();
});

function bindKeysSignIn() {
    $("#btnAuthLogin").click(function () {
        signIn();
    });
}

function signIn() {

    let mLogin = $("#inpAuthLogin").val();
    let mPassword = $("#inpAuthPassword").val();

    showAlert(AlertType.LOADING, "Logowanie do systemu...", '#alertAuthLogin');

    $.ajax({
        url: "/system/admin/signIn",
        method: "POST",
        data: {
            login: mLogin,
            password: mPassword,
            remember_me: $("#remember").is(':checked')  ? 1 : 0,
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.SUCCESS, "Zalogowano pomyślnie!", '#alertAuthLogin');
                window.location.href = data.url;
            } else if(data.msg != null) {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, data.msg, '#alertAuthLogin');
            } else {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, "Błąd podczas logowania!", '#alertAuthLogin');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas logowania!", '#alertAuthLogin');
        }
    });
}