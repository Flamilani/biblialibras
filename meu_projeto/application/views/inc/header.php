    <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Fez login com sucesso!</div>
            <?php } ?>
<div id="skipnav"><a href="#maincontent">Skip to main content</a></div>

<!-- Navigation -->
<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
            </button>
    <a class="navbar-brand brandLogo" href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('assets/img/logoBBL.png'); ?>" alt="Logo A Bíblia em Libras" /></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right navbarRight">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">
                    <a href="<?php echo base_url('home/livros'); ?>">Livros</a>
                </li>
                <li class="page-scroll">
                    <a href="<?php echo base_url('home/sobre'); ?>">Sobre</a>
                </li>
                <li class="page-scroll">
                    <a href="<?php echo base_url('home/funciona'); ?>">Como Funciona</a>
                </li>
                <li class="page-scroll">
                    <a href="<?php echo base_url('home/assinatura'); ?>">Assinatura</a>
                </li>
                    <li class="page-scroll">
                    <a href="<?php echo base_url('home/contato'); ?>">Contato</a>
                </li>
                <li class="page-scroll">
                    <!-- <button id="cartBtn" type="button" class="btn btn-default">
                        <span class="glyphicon glyphicon-shopping-cart"></span>                        
                    </button>
                    <div id="panelCart">Seu carrinho está vazio</div> -->                  
                    <a data-html="true" data-toggle="tooltip" data-placement="bottom" title="Ver meu carrinho <br />( <?php echo $this->cart->total_items(); ?> livro )" class="btn btn-success cartBtn" href="<?php echo base_url('home/meu_carrinho'); ?>"><span class="glyphicon glyphicon-shopping-cart"><span class="spanbadge"><?php echo $this->cart->total_items(); ?></span></span></a>
                </li>
                <li class="page-scroll">
                    <!-- Button trigger modal -->
        <!--     <button type="button" class="btn btn-warning loginBtn" data-toggle="modal" data-target="#myModal"> </button>-->
          <?php if(null != $this->session->userdata('logado')): ?>                                   
              <a class="btn btn-info loginBtn" href="<?php echo base_url('area'); ?>"><?php echo $this->session->userdata('user')->nome; ?> </a>
                        <?php else: ?>
  <a class="btn btn-warning loginBtn" href="<?php echo base_url('home/login'); ?>">Login</a>
                        <?php endif; ?>
                    
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<?php // require 'modal_login.php'; ?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>