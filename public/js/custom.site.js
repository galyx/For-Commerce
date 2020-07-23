// Menu slider
document.querySelector("#open_menu").onclick = function() {
    document.querySelector("#menu_slider").classList.add("menu-body");
    document
        .querySelector("#menu_slider > .menu-box")
        .classList.add("menu-box-size");

    document.querySelector("body").classList.add("modal-open");
};

document.querySelector(".close-menu").onclick = function(e) {
    let close_box =
        e.target == document.querySelector("#menu_slider") ? true : false;
    let close_button =
        e.target == document.querySelector("button.close-menu") ? true : false;

    if (close_box || close_button) {
        document
            .querySelector("#menu_slider > .menu-box")
            .classList.remove("menu-box-size");
        setTimeout(function() {
            document
                .querySelector("#menu_slider")
                .classList.remove("menu-body");

            document.querySelector("body").classList.remove("modal-open");
        }, 1000);
    }
};

// Cart
document.querySelector("#open_cart").onclick = function() {
    document.querySelector("#cart_shop").classList.add("cart-body");
    document
        .querySelector("#cart_shop > .cart-box")
        .classList.add("cart-box-size");

    document.querySelector("body").classList.add("modal-open");
};

document.querySelector(".close-cart").onclick = function(e) {
    let close_box =
        e.target == document.querySelector("#cart_shop") ? true : false;
    let close_button =
        e.target == document.querySelector("button.close-cart") ? true : false;

    if (close_box || close_button) {
        document
            .querySelector("#cart_shop > .cart-box")
            .classList.remove("cart-box-size");
        setTimeout(function() {
            document.querySelector("#cart_shop").classList.remove("cart-body");

            document.querySelector("body").classList.remove("modal-open");
        }, 1000);
    }
};

// Pesquisar cep
if (document.querySelector(".cepConsulta")) {
    document.querySelector(".cepConsulta").onclick = function(e) {
        let cep = document.querySelector(".cep");
        let uf = document.querySelector(".uf");
        let cidade = document.querySelector(".cidade");
        let bairro = document.querySelector(".bairro");
        let rua = document.querySelector(".rua");

        cep.disabled = true;

        let href = window.location.protocol+'//'+window.location.host+'/Dev-Commerce/public/';

        axios
            .post(href+"cep/" + cep.value)
            .then(response => {
                cep.disabled = false;

                uf.value = response.data.uf;
                cidade.value = response.data.localidade;
                bairro.value = response.data.bairro;
                rua.value = response.data.logradouro;
            })
            .catch(error => {
                cep.disabled = false;
            });
    };
}

$(".imagem-produto-1").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".imagem-produto-2"
});

$(".imagem-produto-2").slick({
    slidesToShow: 3,
    asNavFor: ".imagem-produto-1",
    dots: true,
    centerMode: true,
    focusOnSelect: true
});

$(function() {
    $("#main-menu").smartmenus({
        subMenusSubOffsetX: 6,
        subMenusSubOffsetY: -8
    });
});

$(function() {
    $("#sub-main-menu").smartmenus({
        mainMenuSubOffsetX: 1,
        mainMenuSubOffsetY: -8,
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

$(function() {
    $("#lateral-main-menu").smartmenus({
        mainMenuSubOffsetX: 1,
        mainMenuSubOffsetY: -8,
        subMenusSubOffsetX: 1,
        subMenusSubOffsetY: -8
    });
});

$(".cpf").mask("000.000.000-00");
$(".fone").mask("(00) 0000-0000");
$(".cel").mask("(00) 00000-0000");

$(".cep").mask("00000-000");
