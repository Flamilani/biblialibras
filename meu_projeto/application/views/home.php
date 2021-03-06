<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <?php if($this->session->flashdata('message')) { ?>
     <script type="text/javascript">
            $(function () {
                    $.notify(
            {
            icon: 'glyphicon glyphicon-warning-sign',
            title: '<b>Alerta:</b>',
            message: 'Login e/ou senha são incorretos!'
            },
            {
            type: 'warning'
            }
            );
          });
            </script>
<?php } ?>
  <?php if($this->session->flashdata('logout')) { ?>
     <script type="text/javascript">
            $(function () {
                    $.notify(
            {
            icon: 'glyphicon glyphicon-success-sign',
            title: '<b>Sucesso:</b>',
            message: 'Saiu da sessão com sucesso. Volte em breve.'
            },
            {
            type: 'success'
            }
            );
          });
            </script>
<?php } ?>
<?php if($this->session->flashdata('envio')) { ?>
     <script type="text/javascript">
            $(function () {
                    $.notify(
            {
            icon: 'glyphicon glyphicon-success-sign',
            title: '<b>Sucesso:</b>',
            message: 'Sua mensagem foi enviada com sucesso.'
            },
            {
            type: 'success'
            }
            );
          });
            </script>
<?php } ?>
 <?php if($this->session->flashdata('erro_envio')) { ?>
     <script type="text/javascript">
            $(function () {
                    $.notify(
            {
            icon: 'glyphicon glyphicon-warning-sign',
            title: '<b>Alerta:</b>',
            message: 'Erro ao enviar!'
            },
            {
            type: 'warning'
            }
            );
          });
            </script>
<?php } ?>
<?php if($this->session->flashdata('sem_permissao')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-warning-sign',
                    title: '<b>Alerta:</b>',
                    message: 'Seu Plano já foi escolhido!'
                },
                {
                    type: 'warning'
                }
            );
        });
    </script>
<?php } ?>
<?php if($this->session->flashdata('erro_assinatura')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-warning-sign',
                    title: '<b>Alerta:</b>',
                    message: 'Já tem seu plano escolhido!'
                },
                {
                    type: 'warning'
                }
            );
        });
    </script>
<?php } ?>
<!-- Header -->
<?php if(isset($inicial[0]->status) && $inicial[0]->status == 1): ?>
<header>
    <div class="container homeTop principal" id="maincontent" tabindex="-1">
        <div class="row">
                  
          <div class="col-xs-12 col-md-6 col-lg-6">

            <?php if(isset($inicial[0]->midia) && $inicial[0]->midia == 'imagem'): ?>
                  
               <img class="" src="<?php echo $sobre[0]->imagem; ?>" alt="">
      <?php elseif(isset($inicial[0]->midia) && $inicial[0]->midia == 'video'): ?>     
           
             <div class="boxVideo">
                <?php echo $inicial[0]->video; ?>
            </div>
        <?php else: ?>

        <?php endif; ?>
        </div>
        <div class="col-xs-12 col-md-6 col-lg-6">
                   <div class="intro-text">
                    <h1 class="name">
                        <img src="<?php echo base_url('assets/img/logoBBL.png'); ?>" alt="Logo A Bíblia em Libras" />

                    </h1>
           <?php echo $inicial[0]->conteudo; ?>
                </div>
            </div>

                   </div>
    </div>
</header>
<?php else: ?>

    <?php endif; ?>








