<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once("analyticstracking.php"); ?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="a Biblia em Libras">
    <meta name="author" content="Gilmar">
    <title>A Bíblia em Libras</title>
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/icone_mao.png'); ?>">

    <!-- Bootstrap Core CSS -->
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assets/css/freelancer.min.css'); ?>
    <?php echo link_tag('assets/css/style.css'); ?>
      <!-- Custom Fonts -->
    <?php echo link_tag('assets/font-awesome/css/font-awesome.min.css'); ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
            <?php echo link_tag('assets/fonts/glyphicons-halflings-regular.eot'); ?>       
        <?php echo link_tag('assets/fonts/glyphicons-halflings-regular.svg'); ?>       
        <?php echo link_tag('assets/fonts/glyphicons-halflings-regular.ttf'); ?>       
        <?php echo link_tag('assets/fonts/glyphicons-halflings-regular.woff'); ?>       
        <?php echo link_tag('assets/fonts/glyphicons-halflings-regular.woff2'); ?>    
    <?php echo link_tag('assets/shadowbox/shadowbox.css'); ?>       
    <?php echo link_tag('assets/css/sweet-alert.css'); ?>    
    <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/jquery/jquery-ui.js') ?>"></script>
    <script src="<?php echo base_url('assets/js/jquery.forms.js') ?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
// <!--
var mensagem="";
function clickIE() {if (document.all) {(mensagem);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(mensagem);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")
// -->
</script>
    <script>
       // <!--
        function SymError()
        {
            return true;
        }
        window.onerror = SymError;
        //-->
    </script>

    <script>
           
            $(function () {

                $('.debug').each(function () {
                    $(this).after('<p style="color: #fff; background: #333; padding: 10px">' + $(this).width() + 'px</p>');
                });

                $(".accordion").accordion({
                    heightStyle: "content"
                });
                
            });

    </script>
        
   
</head>
<body id="page-top" class="index" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">  
      <p class="j_back backtop"><i class="fa fa-arrow-up" aria-hidden="true"></i></p>