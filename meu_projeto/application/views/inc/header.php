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
            <?php if($this->uri->segment(2) == 'assinatura_realizada' || $this->uri->segment(2) == 'privacidade' || $this->uri->segment(2) == 'termos' || $this->uri->segment(2) == 'registrar' || $this->uri->segment(2) == 'outros_planos' || $this->uri->segment(2) == 'planos' || $this->uri->segment(2) == 'funciona' || $this->uri->segment(2) == 'sobre' || $this->uri->segment(2) == 'cadastro' || $this->uri->segment(2) == 'contato' || $this->uri->segment(2) == 'login' || $this->uri->segment(2) == 'assinar' || $this->uri->segment(2) == 'pagamento_realizado') { ?>
 <a class="navbar-brand brandLogo" href="<?php echo base_url('home'); ?>"><img src="<?php echo base_url('assets/img/logoBBL.png'); ?>" alt="Logo A Bíblia em Libras" /></a>
    <?php } else { ?>                   
 <a class="navbar-brand brandLogo" href="#page-top"><img src="<?php echo base_url('assets/img/logoBBL.png'); ?>" alt="Logo A Bíblia em Libras" /></a>

                <?php  }  ?>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right navbarRight">
                <li class="hidden">
                    <a href="#page-top"></a>
                </li>
                <li class="page-scroll">                    
                    <?php if($this->uri->segment(2) == 'assinatura_realizada' || $this->uri->segment(2) == 'privacidade' || $this->uri->segment(2) == 'termos' || $this->uri->segment(2) == 'registrar' || $this->uri->segment(2) == 'outros_planos' || $this->uri->segment(2) == 'funciona' || $this->uri->segment(2) == 'sobre' || $this->uri->segment(2) == 'cadastro' || $this->uri->segment(2) == 'contato' || $this->uri->segment(2) == 'login' || $this->uri->segment(2) == 'assinar' || $this->uri->segment(2) == 'pagamento_realizado') { ?>
                     <a href="<?php echo base_url('home/planos'); ?>">Planos</a>
                     <?php } else { ?>                   
                     <a href="#planos">Planos</a>
                <?php  }  ?>
                </li>
               
                <li class="page-scroll">
                    <?php if($this->uri->segment(2) == 'assinatura_realizada' || $this->uri->segment(2) == 'privacidade' || $this->uri->segment(2) == 'termos' || $this->uri->segment(2) == 'registrar' || $this->uri->segment(2) == 'outros_planos' || $this->uri->segment(2) == 'funciona' || $this->uri->segment(2) == 'planos' || $this->uri->segment(2) == 'cadastro' || $this->uri->segment(2) == 'contato' || $this->uri->segment(2) == 'login' || $this->uri->segment(2) == 'assinar' || $this->uri->segment(2) == 'pagamento_realizado') { ?>
                     <a href="<?php echo base_url('home/sobre'); ?>">Sobre</a>
                     <?php } else { ?>                   
                     <a href="#sobre">Sobre</a>
                <?php  }  ?>
                </li>           
                <li class="page-scroll">                   
                      <?php if($this->uri->segment(2) == 'assinatura_realizada' || $this->uri->segment(2) == 'privacidade' || $this->uri->segment(2) == 'termos' || $this->uri->segment(2) == 'registrar' || $this->uri->segment(2) == 'outros_planos' || $this->uri->segment(2) == 'sobre' || $this->uri->segment(2) == 'planos' || $this->uri->segment(2) == 'cadastro' || $this->uri->segment(2) == 'contato' || $this->uri->segment(2) == 'login' || $this->uri->segment(2) == 'assinar' || $this->uri->segment(2) == 'pagamento_realizado') { ?>
                     <a href="<?php echo base_url('home/funciona'); ?>">Como Funciona</a>
                     <?php } else { ?>                   
                     <a href="#funciona">Como Funciona</a>
                <?php  }  ?>
                </li>             
                <li class="page-scroll">
                    <a href="<?php echo base_url('home/cadastro'); ?>">Cadastro</a>
                </li>
                    <li class="page-scroll">
                    <a href="<?php echo base_url('home/contato'); ?>">Contato</a>
                </li>
               <!--  <li class="page-scroll">                         
                    <a data-html="true" data-toggle="tooltip" data-placement="bottom" title="Ver meu carrinho <br />( <?php echo $this->cart->total_items(); ?> livro )" class="btn btn-success cartBtn" href="<?php echo base_url('home/meu_carrinho'); ?>"><span class="glyphicon glyphicon-shopping-cart"><span class="spanbadge"><?php echo $this->cart->total_items(); ?></span></span></a>
                </li> -->
                <li class="page-scroll">
                    <!-- Button trigger modal -->
       
          <?php if(null != $this->session->userdata('logado')): ?> 

              <div class="dropdown">
                  <button class="btn btn-info dropdown-toggle menuHome" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      <?php echo $this->session->userdata('user')->nome; ?>
                      <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu menuHomeSub" aria-labelledby="dropdownMenu1">
                  <!--    <li><a href="<?php /*echo base_url('area/assinatura/'. $assinatura[0]->id_assinatura); */?>">Meus Livros</a></li>-->
                      <li><a href="<?php echo base_url('area'); ?>">Área do Usuário</a></li>
                      <li><a href="<?php echo base_url('area/meu_perfil/' . $this->session->userdata('user')->id); ?>">Meu Perfil</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a class="btn btn-danger" href="<?php echo base_url('area/logout'); ?>">Sair</a></li>
                  </ul>
              </div> <?php else: ?>
                             <!-- <button type="button" class="btn btn-warning loginBtn" data-toggle="modal" data-target="#myModal">Login</button> -->
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