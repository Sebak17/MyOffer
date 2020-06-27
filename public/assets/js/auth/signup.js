var registerStep;

// STEPS
// 1 -> EMAIL | PASSWORD
// 2 -> FIRSTNAME | PHONE
// 10 -> PROCESSING
// 11 -> ERROR
// 12 -> SUCCESS


$(document).ready(function () {
    bindButtons();

    loadForm();

    $("footer").addClass('fixed-bottom')
});

function bindButtons() {
    $("#btnNext").click(function () {
        nextStep();
    });

    $("#btnBack").click(function () {
        prevStep();
    });
}

function loadForm() {
    $("#registerStep2").addClass('d-none');
    $("#registerStepProcessing").addClass('d-none');
    $("#registerStepSuccess").addClass('d-none');
    $("#registerStepError").addClass('d-none');

    $("#btnBack").addClass('d-none')

    registerStep = 1;
}

function nextStep() {
    if (registerStep == 1) {

        if (!validStep1())
            return;

        loadStep(2);

        return;

    } else if (registerStep == 2) {

        if (!validStep2())
            return;

        loadStep(10);

        signUp();
    }
}

function prevStep() {
    if (registerStep == 2) {
        loadStep(1);
    }

    if (registerStep == 11) {
        loadStep(2);
    }
}

function loadStep(number) {
	registerStep = number;

	showAlert(AlertType.NONE, "", '#alertSignUp');

	$("#registerStep1").addClass('d-none');
	$("#registerStep2").addClass('d-none');
	$("#registerStepProcessing").addClass('d-none');
	$("#registerStepError").addClass('d-none');
	$("#registerStepSuccess").addClass('d-none');

    switch (registerStep) {
        case 1:
        	$("#registerStep1").removeClass('d-none');
        	$("#btnNext").removeClass('d-none');

        	$("#btnBack").addClass('d-none');

        	$("#btnNext").html('Dalej <i class="fas fa-arrow-right"></i>');
            break;
        case 2:
        	$("#registerStep2").removeClass('d-none');

        	$("#btnBack").removeClass('d-none');
        	$("#btnNext").removeClass('d-none');

        	$("#btnNext").html('Zarejestruj <i class="fas fa-arrow-right"></i>');
            break;
        case 10:
        	$("#registerStepProcessing").removeClass('d-none');
        	$("#btnBack").addClass('d-none');
        	$("#btnNext").addClass('d-none');
            break;
        case 11:
        	$("#registerStepError").removeClass('d-none');
        	$("#btnBack").removeClass('d-none');
        	$("#btnNext").addClass('d-none');
            break;
        case 12:
        	$("#registerStepSuccess").removeClass('d-none');
        	$("#btnBack").addClass('d-none');
        	$("#btnNext").addClass('d-none');
            break;
    }
}

function validStep1() {
	let mEmail = $("#inpRegisterEmail").val();
    let mPassword1 = $("#inpRegisterPassword1").val();
    let mPassword2 = $("#inpRegisterPassword2").val();

    if(!validateEmail(mEmail)) {
		showAlert(AlertType.ERROR, "Email jest nieprawidłowy!", '#alertSignUp');
		return false;
	}

    if(mPassword1.length == 0) {
		showAlert(AlertType.ERROR, "Podaj hasło!", '#alertSignUp');
		return false;
	}

	if(mPassword2.length == 0) {
		showAlert(AlertType.ERROR, "Potwórz hasło!", '#alertSignUp');
		return false;
	}

	if(mPassword1 != mPassword2) {
		showAlert(AlertType.ERROR, "Hasła się nie zgadzają!", '#alertSignUp');
		return false;
	}

    return true;
}

function validStep2() {

	let mFirstname = $("#inpRegisterFirstname").val();
    let mPhone = $("#inpRegisterPhone").val();

	if(mFirstname.length == 0) {
		showAlert(AlertType.ERROR, "Podaj imię!", '#alertSignUp');
		return false;
	}

	if(mPhone.length != 9) {
		showAlert(AlertType.ERROR, "Numer telefonu jest niepoprawny!", '#alertSignUp');
		return false;
	}



    return true;
}

function signUp() {
	if(isRequest)
		return;

    let mEmail = $("#inpRegisterEmail").val();
    let mPassword = $("#inpRegisterPassword1").val();

    let mFirstname = $("#inpRegisterFirstname").val();
    let mPhone = $("#inpRegisterPhone").val();

    isRequest = true;

    $.ajax({
        url: "/system/auth/signUp",
        method: "POST",
        data: {
            user_email: mEmail,
            user_password: mPassword,
            user_firstname: mFirstname,
            user_phone: mPhone,
        },
        success: function (data) {
            if (data.success == true) {
                $("#msgBoxSuccess").html("Konto zostało stworzone pomyślnie!");
            	loadStep(12);
            	setTimeout(function() {
                	window.location.href = "/";
            	}, 2500);
            } else if (data.msg != null) {
            	$("#msgBoxError").html(data.msg);
            	loadStep(11);
            } else {
                $("#msgBoxError").html("Problem z tworzeniem konta!");
        		loadStep(11);
            }
        },
        error: function () {
        	$("#msgBoxError").html("Problem z serwerem!");
        	loadStep(11);
        },
        complete: function() {
        	isRequest = false;
        }
    });
}