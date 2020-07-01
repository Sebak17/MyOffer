var filtersValues = [],
    sortType = 1,
    pageCurrent = 1,
    pageMax = 1,
    categoryID = 0,
    locDistrict = 0;

$(document).ready(function () {
    parseURL();

    bind();
});

function bind() {

    $("#btnFiltersApply").click(function () {
        applyFilters();
    });

    $("#sortType").change(function () {
        sortType = parseInt($("#sortType").val());
    });

    bindCategoryList();
    bindPagination();
}

function bindCategoryList() {
    let cat = document.querySelectorAll(".category-item");

    for (let i = 0; i < cat.length; i++) {
        cat[i].addEventListener('click', function () {
            categoryID = cat[i].getAttribute("category");

            window.location.href = generateURL();
        });

    }


    $(".category-item-back").click(function () {
        categoryID = $(".category-item-back").attr("category");

        window.location.href = generateURL();
    });
}

function bindPagination() {
    $("[data-page-number]").each(function(index, el) {
        $(el).click(function() {
            changePage(el.getAttribute('data-page-number'));
        });
    });
}

function parseURL() {
    let url = new URL(window.location.href);

    if (url.searchParams.get("page")) {
        let page = parseInt(url.searchParams.get("page"));
        if (!isNaN(page))
            pageCurrent = page;
    }

    if (url.searchParams.get("locd")) {
        let locd = url.searchParams.get("locd");
        if (!isNaN(locd))
            locDistrict = locd;
    }


    if (url.searchParams.get("category")) {
        let id = url.searchParams.get("category");
        if (!isNaN(id))
            categoryID = id;
    }

    if (url.searchParams.get("s")) {
        filtersValues['s'] = decodeURIComponent(url.searchParams.get("s"));
        $("#inpSearchText").val(filtersValues['s']);
    }

    if (url.searchParams.get("sort")) {
        let sort = url.searchParams.get("sort");
        if (!isNaN(sort)) {
            sortType = parseInt(sort);
            $("#sortType").val(sortType);
        }
    }

    if (url.searchParams.get("price-min")) {
        filtersValues['product-price-min'] = url.searchParams.get("price-min");
        $("#fl_price1").val(filtersValues['product-price-min']);
    }
    if (url.searchParams.get("price-max")) {
        filtersValues['product-price-max'] = url.searchParams.get("price-max");
        $("#fl_price2").val(filtersValues['product-price-max']);
    }
}

function applyFilters() {
    let p1 = parseFloat($("#fl_price1").val());
    if (!isNaN(p1))
        filtersValues['product-price-min'] = p1.toFixed(2);
    else
        delete filtersValues['product-price-min'];

    let p2 = parseFloat($("#fl_price2").val());
    if (!isNaN(p2))
        filtersValues['product-price-max'] = p2.toFixed(2);
    else
        delete filtersValues['product-price-max'];


    filtersValues['s'] = $("#inpSearchText").val().replace(/[^a-zA-Z0-9żźćńółęąśŻŹĆĄŚĘŁÓŃ\- ]/g, "");

    locDistrict = $("#inpSearchDistrict").val();

    window.location.href = generateURL();
}

function generateURL() {
    let url = "";

    if (categoryID > 0)
        url += "&category=" + categoryID;

    if (pageCurrent != 0)
        url += "&page=" + pageCurrent;

    if (locDistrict > 0)
        url += "&locd=" + locDistrict;

    if (filtersValues['s'])
        url += "&s=" + filtersValues['s'];

    url += "&sort=" + sortType;

    if (filtersValues['product-price-min'])
        url += "&price-min=" + parseFloat(filtersValues['product-price-min']).toFixed(2);

    if (filtersValues['product-price-max'])
        url += "&price-max=" + parseFloat(filtersValues['product-price-max']).toFixed(2);


    url = url.replace("&", "?");

    return "/oferty" + url;
}

function changePage(page) {
    if(page < 1)
        page = 1;
    if(page > pageMax)
        page = pageMax;

    if(page == pageCurrent)
        return;

    pageCurrent = page;

    window.location.href = generateURL();
}