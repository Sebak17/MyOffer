var changingFavorite = false;

$(document).ready(function() {
	bind();
});

function bind() {
	$("#btnActionPhone").click(function() {
		let s = $("#itemListPhone");
		if(s.is(":visible"))
			s.fadeOut();
		else
			s.fadeIn();
	});

	$("#btnActionEmail").click(function() {
		let s = $("#itemListEmail");
		if(s.is(":visible"))
			s.fadeOut();
		else
			s.fadeIn();
	});

	$("#btnFavouriteStatus").click(function() {
		changeFavoriteStatus();
	});
}

function changeFavoriteStatus() {

    if(changingFavorite)
        return;

    changingFavorite = true;

    $.ajax({
        url: "/system/user/changeFavoriteStatus",
        method: "POST",
        data: {
            id: $("[data-id]").attr("data-id"),
        },
        success: function (data) {
            if (data.success == true) {
                let o = $("[data-is-favourite]");

                if (!data.status) {
                    o.removeClass('fas')
                    o.addClass('far');
                    o.attr("data-is-favourite", false);
                } else {
                    o.removeClass('far')
                    o.addClass('fas');
                    o.attr("data-is-favourite", true);
                }
            }
        },
        error: function () {},
        complete: function() {
            changingFavorite = false;
        }
    });

}