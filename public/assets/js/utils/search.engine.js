$( document ).ready(function() {
    searchEngine_bindKeys();
});

function searchEngine_bindKeys() {
	$("#btnSearch").click(function () {
		searchProducts();
	});

	$('#inpSearchText').keyup(function (event) {
		if (event.keyCode === 13)
			searchProducts();
    });
}

function searchProducts() {
	let val = $("#inpSearchText").val();
	val = val.replace(/[^a-zA-Z0-9żźćńółęąśŻŹĆĄŚĘŁÓŃ\- ]/g, "");

	if(val.length < 2) {
		$("#inpSearchText").addClass('is-invalid')
		return;
	}

	let district = "", inpDistrict = $("#inpSearchDistrict").val();

	if(inpDistrict > 0)
		district = "&loc=" + inpDistrict;

	window.location.href = "/oferty?s=" + encodeURIComponent(val) + district;
}
