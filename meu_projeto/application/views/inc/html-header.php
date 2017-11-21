<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta id="viewport" name="viewport" content="width=device-width, user-scalable=no">
    <meta name="description" content="a Biblia em Libras">
    <meta name="author" content="Gilmar">
    <title>A Bíblia em Libras</title>
    <!-- Bootstrap Core CSS -->
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css'); ?>
    <?php echo link_tag('assets/css/freelancer.min.css'); ?>
    <?php echo link_tag('assets/css/style.css'); ?>
      <!-- Custom Fonts -->
    <?php echo link_tag('assets/font-awesome/css/font-awesome.min.css'); ?>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <?php echo link_tag('assets/shadowbox/shadowbox.css'); ?>       
    <?php echo link_tag('assets/css/sweet-alert.css'); ?>    
    <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/jquery/jquery-ui.js') ?>"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
              <script type="text/javascript">
            $(function () {

                $('.debug').each(function () {
                    $(this).after('<p style="color: #fff; background: #333; padding: 10px">' + $(this).width() + 'px</p>');
                });

                $(".accordion").accordion({
                    heightStyle: "content"
                });
                
            });

    </script>
        
          <script>

document.querySelector('.showcase.normal button').onclick = function(){
    alert("Oops... Something went wrong!");
};

document.querySelector('.showcase.sweet button').onclick = function(){
    swal("Oops...", "Something went wrong!", "error");
};

document.querySelector('ul.examples li.message button').onclick = function(){
    swal("Here's a message!");
};

document.querySelector('ul.examples li.title-text button').onclick = function(){
    swal("Here's a message!", "It's pretty, isn't it?")
};

document.querySelector('ul.examples li.success button').onclick = function(){
    swal("Good job!", "You clicked the button!", "success");
};

document.querySelector('ul.examples li.warning button').onclick = function(){
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!'
    },
    function(){
        alert("Deleted!");
    });
};

document.querySelector('ul.examples li.custom-icon button').onclick = function(){
    swal({
        title: "Sweet!",
        text: "Here's a custom image.",
        imageUrl: 'images/thumbs-up.jpg'
    });
};

    </script>

</head>
<!--<body id="page-top" class="index" oncontextmenu="return false" ondragstart="return false" onselectstart="return false">-->
<body id="page-top" class="index" ng-app="meuApp" ng-controller="meuCtrl">