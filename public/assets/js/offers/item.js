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
}