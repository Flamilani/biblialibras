      <?php if($this->session->flashdata('error')) { ?>
     <script type="text/javascript">
            $(function () {
                  $.notify(
      {
      icon: 'glyphicon glyphicon-warning-sign',
      title: '<b>Alerta:</b>',
      message: 'Este livro ainda não está completo. Em breve...'
      },
      {
      type: 'warning'
      }
        );
        });
            </script>
<?php } ?>

<section class="topPlanos" id="outros_planos">
<!-- Portfolio Grid Section -->
    <div class="container QuatroColunas">
        <div class="row"><!-- row -->                                      
        
<div class="col-lg-12 text-center front"> <!-- col-lg-12 -->
                  <!-- panel-group-->     
 <?php $rowsplLivro = $this->db->query("SELECT * FROM livros ORDER BY ordem"); ?>
            <?php $resplLivro = $rowsplLivro->result(); ?> 
      <?php $rowsPlanos = $this->db->query("SELECT * FROM planos WHERE status = 1 AND home = 1 AND tipo_plano = 0"); ?>
            <?php $countPls = $rowsPlanos->result(); ?>
    <?php $rowsPlanosBas = $this->db->query("SELECT * FROM planos WHERE status = 1 AND home = 1 AND tipo_plano = 1"); ?>
    <?php $countPlsBasc = $rowsPlanosBas->result(); ?>
    <?php foreach ($countPls as $pls): ?>
          <?php $rowsPlano = $this->db->query("SELECT * FROM plano WHERE status = 1 AND id_planos = {$pls->id_planos}"); ?>   
          <?php $countPl = $rowsPlano->result(); ?>  
    <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$pls->id_planos}"); ?>   
            <?php $countPLivro = $rowsPlanoLivro->result(); ?>
           <!-- title -->
              <?php if((isset($countPLivro[0]->params)) && $countPLivro[0]->params != ''): ?>
       <h2><?php echo $pls->nome_plano; ?> (<?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'Livro', 'Livros') ?>)</h2><br>
    <?php endif; ?>


              <div class="row boxPlano">
 
     <?php if (!empty($countPl)): ?>
          <?php foreach ($countPl as $plano): ?>
        <?php $rowsCap = $this->db->query("SELECT * FROM capitulo"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>

        <?php $rowsVideo = $this->db->query("SELECT * FROM videos"); ?>
       <?php $countVideo = $rowsVideo->result(); ?>
             <?php if((isset($countPLivro[0]->params)) && $countPLivro[0]->params != ''): ?>

    <div class="thumbnail text-center front boxLados">
        <div class="caption">
           <h2><span class="label label-warning"><?php echo $plano->duracao; ?> <?php echo FormPeriodo($plano->periodo); ?></span>
        <span class="label label-primary"> 1 x <?php echo reais($plano->valor); ?></span></h2>  
 </div>
       
        <p>
           <?php if(null != $this->session->userdata('logado')): ?>
               <?php $user = $this->session->userdata('user')->id; ?>
       <?php $rowsAss = $this->db->query("SELECT * FROM assinaturas WHERE id_user = {$user}"); ?>
                  <?php $resAss = $rowsAss->result(); ?>

                   <?php
                    $date = isset($resAss[0]->data_inicial);
                    $date = strtotime($date);
                    $new_date = strtotime('+ ' . $plano->duracao . ' ' . $plano->periodo, $date);
                    $data_final = date('Y-m-d', $new_date);

                    $diaAtual = strtotime(date('Y-m-d'));
                     $intervalo = ($new_date - $diaAtual) / 86400;
                    ?>

       <a href="<?php echo base_url('home/assinar/' . $plano->id_plano); ?>" class='btn btn-primary btn-lg btnComprar' role='button'>Comprar</a>

  <?php else: ?>
  <a href="<?php echo base_url('home/cadastro'); ?>" class='btn btn-primary btn-lg btnComprar' role='button'>Comprar</a>
                        <?php endif; ?>
        </p>
     
     
    </div>


             <?php endif; ?>
        <?php endforeach; ?>

        <?php else: ?>
        <div class="alert alert-info" role="alert">
    Nenhum plano neste momento.
            </div>
        <?php endif; ?>    

        </div>
      <br>
               <div class="row boxPlano">
     <?php if (!empty($resplLivro)): ?> 
                
 <?php foreach($resplLivro as $pl): ?>  

 <?php $rowsCap = $this->db->query("SELECT * FROM capitulo WHERE id_livro = '{$pl->id_livro}'"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>                     

        <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$pl->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>
                   <?php if((isset($countPLivro[0]->params)) && $countPLivro[0]->params != ''): ?>
                  <?php if(in_array($pl->id_livro, explode(',', $countPLivro[0]->params))): ?>

    <div class="thumbnail text-center front boxLados">
             <?php echo (isset($pl->imagem) && $pl->imagem != '' && $pl->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $pl->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>                    
              
       <p><?php echo count($countCaps); ?> <?php plural(count($countCaps), 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>          
      
    </div>

                 <?php endif; ?>
     <?php endif; ?>

        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning" role="alert">
    Nenhum livro neste momento.
            </div>
        <?php endif; ?>    

        </div>  

    <hr>
       <?php endforeach; ?>
    <?php if(isset($countPlsBasc[0]->tipo_plano) && $countPlsBasc[0]->tipo_plano == 1) { ?>
        <a href="<?php echo base_url('home/planos/'); ?>" class='btn btn-warning btn-lg' role='button'><?php echo $countPlsBasc[0]->nome_plano; ?></a>
    <?php } ?>



            </div> <!-- end col-lg-12 -->
        </div><!-- end row -->


  
      
    </div>
</section>

<?php if($this->uri->segment(2) == 'outros_planos') { ?>
<script>
     $(document).ready(function() {       
        $('#outros_planos').addClass("cima");
     });
</script>     

<?php } ?>

