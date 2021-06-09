$(function () {
    let newShop = new shopController();
    if (window.location.pathname == '/Uebung3_BEB_ROHL/shop.html') {
        newShop.activateGUI();
    } else if (window.location.pathname == '/Uebung3_BEB_ROHL/cart.html') {
        newShop.toCart();
    }
});