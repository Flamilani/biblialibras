$(function () {	
    $("#cartBtn").mousedown(function() {
        $('#panelCart').fadeToggle('slow');
    });    

});
     $(document).ready(function() {  

    var heightHeader = $('.main_header').outerHeight();

         // SUSPENDE MENU:
    $(window).scroll(function () {
        if ($(this).scrollTop() > heightHeader + 150) {        
            $('.j_back').fadeIn(500);
        } else {
            $('body').css('padding-top', '0');          
            $('.j_back').fadeOut(500);
        }
    });
     
      // BACK TOP
    $('.j_back').click(function() {       
        $('html, body').animate({scrollTop: 0}, 1000);
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

function confirmarExclusao(id) {
	if(!confirm("Confirma deletar este registro ID " + id + "?")) {
		return false;
	} else {
		return true;
	}
}

function confirmarExcluirCapitulo() {
    if(!confirm("Confirma remover este capítulo?")) {
        return false;
    } else {
        return true;
    }
}

function confirmarExcluirVideo() {
    if(!confirm("Confirma remover este vídeo?")) {
        return false;
    } else {
        return true;
    }
}

function confirmarDesmarcar() {
    if(!confirm("Confirma desmarcar?")) {
        return false;
    } else {
        return true;
    }
}

$(function () { 
    $('#cadastro_livro').click(function(){       
        $('.caixa_livro').slideToggle("slow");
    });
});

$(function () { 
    $('.displayButton').click(function(){       
        $('.displayLivros').slideToggle("600");
    });

    $('.panel-heading .title').click(function(){       
        $('.displayLivros').slideUp("600");
    });

    $(window).on("scroll", function() {
        var scrollHeight = $(document).height();
        var scrollPosition = $(window).height() + $(window).scrollTop();
        if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
            // when scroll to bottom of the page
        }
    });

});

$(window).on('load',function(){


    $('.aulas-sidebar').mCustomScrollbar({
        mouseWheelPixels: 200,
        callbacks:{
            onUpdate:function(){

                $('.list-group-item .active').mCustomScrollbar('scrollTo',$('[targetaulascroll]'),{
                    scrollInertia:0
                });

            }
        }
    });

    checkDuvidaTarget();

    function checkDuvidaTarget(){
        //Verificamos se existe um elemento de duvidas com base no GET para descer a pÃ¡gina
        if($('[targetduvida]').length > 0){
            var off = $('[targetduvida]').offset().top;
            $('body,html').animate({'scrollTop':off},1000,function(){});
        }
    }


    insertCode();

    function insertCode(){
        $('.form-duvida input[type=button]').click(function(){
            var textarea = $('.form-duvida').find('textarea');
            if(textarea.val() == '')
                textarea.val(textarea.val()+'`'+'\ncodigo aqui\n'+'`');
            else
                textarea.val(textarea.val()+'\n`'+'\ncodigo aqui\n'+'`');
        })
    }

    $('pre code').each(function(i, block) {
        hljs.highlightBlock(block);
    });

    adjust();
    $('footer').hide();

    function adjust(){

        var newWidth = $(window)[0].innerWidth;
        if(newWidth > 768){
            if($(document).scrollTop() >= $('.aula-flex').offset().top){
                initSideBar('begin');
            }else{
                initSideBar('relative');
            }
        }else{
            resetSideBar();
        }

    }





    $(window).scroll(function(){
        adjust();
    });

    $(window).resize(function(){
        adjust();
    })



    //Vimeo callback

    var callback = false;
    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);

    var observerDom = function(target){
        MutationObserver = window.MutationObserver || window.WebKitMutationObserver;

        var observer = new MutationObserver(function(mutations, observer) {
            if(mutations[0].attributeName == 'src'){
                window.location.href = '/';
            }
        });

        observer.observe(target, {
            subtree: true,
            attributes: true
        });
    }

    player.ready().then(function() {
        observerDom(iframe);
    });




    player.on('ended', function() {
        //console.log("Video terminado!");
        if(callback === false){
            callback = true;
            // setTimeout(function(){
            sendAulaConcluida();
            //},3000)
        }
    });



    function sendAulaConcluida(){
        var aula_id = $('[aula_id]').attr('aula_id');

        if(aula_id !== undefined){
            $.ajax({
                dataType:'json',
                url:include_path+'ajax/aulaconcluida.php',
                method:'post',
                data:{'aula_id':aula_id}
            }).done(function(data){

                if(data.error === undefined){
                    alert('Aula concluida com sucesso!');
                    location.href=data.link;
                }else{
                    console.log(data.error);
                }
                //console.log(data);
            })
        }
    }


});

