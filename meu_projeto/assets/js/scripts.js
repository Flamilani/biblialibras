$(function () {
    $("#cartBtn").mousedown(function() {
        $('#panelCart').fadeToggle('slow');
    });
});

function toggleCart() {

    var cart = document.getElementById("panelCart");

    if(cart.style.display == 'none' || cart.style.display == '') {
        cart.style.display = "block";
    } else {
        cart.style.display = "none";
    }
}