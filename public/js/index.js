let swiperProducts = new Swiper(".mySwiperProducts", {
    slidesPerView: 4,
    spaceBetween: 50,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        280: {
            slidesPerView: 1
        },
        800: {
            slidesPerView: 2
        },
        1000: {
            slidesPerView: 3
        },
        1300: {
            slidesPerView: 4
        }
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

let swiperPublications = new Swiper(".mySwiperElement", {
    slidesPerView: 4,
    spaceBetween: 50,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        280: {
            slidesPerView: 1
        },
        800: {
            slidesPerView: 2
        },
        1000: {
            slidesPerView: 3
        },
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

$(".element-image").on("click", function() {
    $("#showPublication").css("visibility", "hidden");
    let id = $(this).attr("id");
    $.ajax({
        url: '/publication',
        data: {
            id:id,
        },
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            let publication = resp.publication;
            $("#modalTitlePublication").text(publication.title);
            $("#modalDescriptionPublication").text(publication.description);
            let urlPublication = location.href + "images/publications/" + publication.image;
            $("#modalImagePublication").attr("src", urlPublication);
            $("#showPublication").css("visibility", "visible");
        }
    })
});

$(".show-book-item").on("click", function() {
    $("#showProduct").css("visibility", "hidden");
    $("#modalInputQuantityProduct").val(1);
    $("#modalQuantityProduct").val(1);

    let id = $(this).attr("id");
    $.ajax({
        url: '/book',
        data: {
            id:id,
        },
        type: 'GET',
        datatype: 'JSON',
        success: function (resp) {
            $("#modalTitleProduct").text("");
            $("#modalPriceWithDiscountProduct").text("");
            $("#modalPriceOriginalProduct").text("");

            $("#modalTitleProduct").text(resp.product.title);
            $("#modalDescriptionProduct").text(resp.product.description);

            let discount = Number(resp.product.discount);
            if(discount != 0) {
                $("#modalPriceOriginalProduct").text("S/ " + resp.product.price);
                $("#modalPriceWithDiscountProduct").text("S/ " + (Number(resp.product.price) - Number(resp.product.discount)));
            } else {
                $("#modalPriceWithDiscountProduct").text("S/ " + resp.product.price);
            }

            $("#modalIdProduct").val(resp.product.id);
            let url = location.href;
            let images = resp.product.images;
            let urlNotFoundImage = url + "images/default/image-not.png";

            $("#modalFirstImageProduct").attr("src", urlNotFoundImage);
            $("#modalSecondImageProduct").attr("src", urlNotFoundImage);
            $("#modalThirdImageProduct").attr("src", urlNotFoundImage);
            $("#modalFourthImageProduct").attr("src", urlNotFoundImage);

            if(images == null) {
                $("#modalFirstImageProduct").attr("src", urlNotFoundImage);
            } else {
                let urlFull = url + "images/books/" + images.split(",")[0];
                $("#modalFirstImageProduct").attr("src", urlFull);
                
                if(images.split(",")[1] != undefined) {
                    let urlFull = url + "images/books/" + images.split(",")[1];
                    $("#modalSecondImageProduct").attr("src", urlFull);
                }

                if(images.split(",")[2] != undefined) {
                    let urlFull = url + "images/books/" + images.split(",")[2];
                    $("#modalThirdImageProduct").attr("src", urlFull);
                }

                if(images.split(",")[3] != undefined) {
                    let urlFull = url + "images/books/" + images.split(",")[3];
                    $("#modalFourthImageProduct").attr("src", urlFull);
                }
            }

            $("#showProduct").css("visibility", "visible");
        }
    })
});

$("#modalInputQuantityProduct").on("change", function() {
    $("#modalQuantityProduct").val($(this).val());
});