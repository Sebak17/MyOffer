var inpOfferTitle,
    inpOfferTitleSub,
    inpOfferDescription,
    inpOfferDescriptionSub;

var valOfferTitle,
    valOfferDescription,
    valOfferCategory = 1;

const maxTitle = 80,
    maxDescription = 5000;

var offerImagesList = [];

$(document).ready(function () {
    load();

    bind();
});

function load() {
    inpOfferTitle = $("#inpOfferTitle");

    inpOfferTitleSub = $("#inpOfferTitleSub");
    inpOfferTitleSub.html("0/" + maxTitle);


    inpOfferDescription = $("#inpOfferDescription");

    inpOfferDescriptionSub = $("#inpOfferDescriptionSub");
    inpOfferDescriptionSub.html("0/" + maxDescription);
}

function bind() {
    inpOfferTitle.on('input', function (e) {
        let len = inpOfferTitle.val().length;

        if (len >= maxTitle)
            inpOfferTitle.val(valOfferTitle);
        else
            valOfferTitle = inpOfferTitle.val();

        inpOfferTitleSub.html(len + "/" + maxTitle);
    });

    inpOfferDescription.on('input', function (e) {
        let len = inpOfferDescription.val().length;

        if (len >= maxDescription)
            inpOfferDescription.val(valOfferDescription);
        else
            valOfferDescription = inpOfferDescription.val();

        inpOfferDescriptionSub.html(len + "/" + maxDescription);
    });


    $("#btnAddOffer").click(function () {
        addOffer();
    });

    $("#btnUploadImages").click(function (event) {
        $("#inpOfferImages").trigger('click');
    });

    $("#inpOfferImages").change(function (event) {
        if (this.files && this.files.length > 0) {
            imageOfferUpload(this);
        }
    });

    $("#btnSelectCategory").click(function () {
        $("#modalCategorySelect").modal('show');
    });
}


function addOffer() {
    let mOfferPrice = $("#inpOfferPrice").val();
    let mOfferLocation = $("#inpOfferLocation").val();

    showAlert(AlertType.LOADING, "Dodawanie oferty...", "#alertOfferAdd");

    $.ajax({
        url: "/system/panel/offerAdd",
        method: "POST",
        data: {
            offer_title: valOfferTitle,
            offer_description: valOfferDescription,
            offer_price: mOfferPrice,
            offer_location: mOfferLocation,
            offer_category: valOfferCategory,
            offer_images: offerImagesList,
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.SUCCESS, "Oferta dodana pomyślnie!", '#alertOfferAdd');
                window.location.href = "/panel/moje_ogloszenia";
            } else if (data.msg != null) {
                showAlert(AlertType.ERROR, data.msg, '#alertOfferAdd');
            } else {
                showAlert(AlertType.ERROR, "Błąd podczas dodawania!", '#alertOfferAdd');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas dodawania!", '#alertOfferAdd');
        }
    });
}

function imageOfferUpload(input) {
    let formData = new FormData();
    for (let i = 0; i < input.files.length; i++) {
        formData.append('images[' + i + ']', input.files[i]);
    }

    $.ajax({
        url: "/system/panel/offerImageUpload",
        method: "POST",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.success == true) {
                data.images.forEach(function (item, index) {
                    offerImagesList.push(item);
                });

                refreshImagesList();
            } else if (data.msg != null){
                showAlert(AlertType.ERROR, data.msg, '#alertOfferAdd');
            } else {
                showAlert(AlertType.ERROR, "Błąd podczas usuwania zdjęcia!", '#alertOfferAdd');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas usuwania zdjęcia!", '#alertOfferAdd');
        }
    });
}

function imageOfferRemove(hash) {
    $.ajax({
        url: "/system/panel/offerImageRemove",
        method: "POST",
        data: {
            hash: hash,
        },
        success: function (data) {
            if (data.success == true) {
                showAlert(AlertType.NONE, '', '#alertOfferAdd');
                offerImagesList = arrayRemove(offerImagesList, hash);
                refreshImagesList();
            } else if (data.msg != null) {
                showAlert(AlertType.ERROR, data.msg, '#alertOfferAdd');
            } else {
                showAlert(AlertType.ERROR, "Błąd podczas usuwania!", '#alertOfferAdd');
            }
        },
        error: function () {
            showAlert(AlertType.ERROR, "Błąd podczas usuwania!", '#alertOfferAdd');
        }
    });
}



function refreshImagesList() {
    let text = "";

    offerImagesList.forEach(function (item, index) {
        text += String.raw `
            <div class="col-4 col-lg-3 col-xl-2 mb-3">
                    <div class="card">
                        <div class="card-header text-right">
                            <button class="btn btn-danger btn-sm" onclick="imageOfferRemove('` + item + `')"><i class="fas fa-times"></i></button>
                        </div>
                        <img class="img-fluid" src="/storage/tmp_images/` + item + `" alt="Card image">
                    </div>
                </div>
        `;
    });


    $("#imagesList").html(text);
}