$(document).ready(function () {
    bindKeys();
});

function bindKeys() {
    $("#btnChangePersonal").click(function () {
        changePersonal();
    });
    $("#btnChangePassword").click(function () {
        changePassword();
    });
}

function changePersonal() {

	let mFirstname = $("#inpChanePersonalFirstname").val();
	let mPhone = $("#inpChanePersonalPhone").val();

	if(mFirstname.length == 0) {
		showAlert(AlertType.ERROR, "Podaj imię!", '#alertChangePersonal');
		return;
	}

	if(mPhone.length != 9) {
		showAlert(AlertType.ERROR, "Numer telefonu jest niepoprawny!", '#alertChangePersonal');
		return;
	}

	showAlert(AlertType.LOADING, "Zmiana danych...", '#alertChangePersonal');

	$.ajax({
        url: "/system/user/changePersonal",
        method: "POST",
        data: {
            user_firstname: mFirstname,
            user_phone: mPhone
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.SUCCESS, "Dane zostały zmienione pomyślnie!", '#alertChangePersonal');
                location.reload();
            } else if(data.msg != null) {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, data.msg, '#alertChangePersonal');
            } else {
                $("#inpAuthPassword").val("");
                showAlert(AlertType.ERROR, "Błąd podczas zmiany!", '#alertChangePersonal');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas zmiany!", '#alertChangePersonal');
        }
    });
}

function changePassword() {

	let mPasswordOld = $("#inpChangePasswordOld").val();
	let mPasswordNew1 = $("#inpChangePasswordNew1").val();
	let mPasswordNew2 = $("#inpChangePasswordNew2").val();

	if(mPasswordOld.length == 0) {
		showAlert(AlertType.ERROR, "Podaj stare hasło!", '#alertChangePassword');
		return;
	}

	if(mPasswordNew1.length == 0) {
		showAlert(AlertType.ERROR, "Podaj nowe hasło!", '#alertChangePassword');
		return;
	}

	if(mPasswordNew2.length == 0) {
		showAlert(AlertType.ERROR, "Potwórz nowe hasło!", '#alertChangePassword');
		return;
	}

	if(mPasswordNew1 != mPasswordNew2) {
		showAlert(AlertType.ERROR, "Hasła się nie zgadzają!", '#alertChangePassword');
		return;
	}

	showAlert(AlertType.LOADING, "Zmiana hasła...", '#alertChangePassword');

	$.ajax({
        url: "/system/user/changePassword",
        method: "POST",
        data: {
            user_password_old: mPasswordOld,
            user_password_new: mPasswordNew1
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.SUCCESS, "Hasło zostało zmienione pomyślnie!", '#alertChangePassword');
                location.reload();
            } else if(data.msg != null) {
                showAlert(AlertType.ERROR, data.msg, '#alertChangePassword');
            } else {
                showAlert(AlertType.ERROR, "Błąd podczas zmiany!", '#alertChangePassword');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas zmiany!", '#alertChangePassword');
        }
    });

}