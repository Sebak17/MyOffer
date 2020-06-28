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
		changeFavouriteStatus();
	});
}

function changeFavouriteStatus() {
	let element = $("#btnFavouriteStatus");

	let isFavourite = (element.attr('data-is-favourite') == 'true');

	if(isFavourite) {
		element.removeClass('fas');
		element.addClass('far');
		element.attr('data-is-favourite', 'false');
	} else {
		element.removeClass('far');
		element.addClass('fas');
		element.attr('data-is-favourite', 'true');
	}
}