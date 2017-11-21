$(function () {	
    $("#cartBtn").mousedown(function() {
        $('#panelCart').fadeToggle('slow');
    });

   
 //	$('#valor').mask('000.000.000.000.000,00', {reverse: true});

});

function toggleCart() {

    var cart = document.getElementById("panelCart");

    if(cart.style.display == 'none' || cart.style.display == '') {
        cart.style.display = "block";
    } else {
        cart.style.display = "none";
    }
}

function confirmarExclusao(id) {
	if(!confirm("Confirma deletar este registro ID " + id + "?")) {
		return false;
	} else {
		return true;
	}
}
