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

<section class="topPlanos" id="planos">
<!-- Portfolio Grid Section -->
    <div class="container">
        <div class="row"><!-- row -->                                      
        
<div class="col-lg-12 text-center front"> <!-- col-lg-12 -->
                  <!-- panel-group-->     
  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
    <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro"); ?>   
    <?php $countPLivro = $rowsPlanoLivro->result(); ?>  
            <?php $rowsPlanos = $this->db->query("SELECT * FROM planos WHERE status = 1"); ?>   
            <?php $countPls = $rowsPlanos->result(); ?> 
          <?php foreach ($countPls as $pls): ?>           
          <?php $rowsPlano = $this->db->query("SELECT * FROM plano WHERE status = 1 AND id_planos = {$pls->id_planos}"); ?>   
          <?php $countPl = $rowsPlano->result(); ?>  
    <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$pls->id_planos}"); ?>   
            <?php $countPLivro = $rowsPlanoLivro->result(); ?>  

  <!-- panel-primary -->  
  <div class="panel panel-info"> 
  <!-- panel-heading -->       
        <div class="panel-heading" role="tab" id="<?php echo $pls->id_planos; ?>">
           <!-- title --> 
             <div style="margin-top: -8px;" class="title" data-role="title" data-toggle="collapse" data-parent="#accordion" href="#<?php echo $pls->ordem; ?>" aria-expanded="false" aria-controls="<?php echo $pls->ordem; ?>">
               <h3><?php echo $pls->nome_plano; ?></h3>
                </div><!-- end title --> 
        </div><!-- end panel-heading --> 
             <div id="<?php echo $pls->ordem; ?>" class="panel-collapse collapse <?php echo isset($pls->ordem) && $pls->ordem == '001' ? 'in' : '';  ?>" role="tabpanel" aria-labelledby="<?php echo $pls->id_planos; ?>">
      <!-- panel-body --> 
          <div class="panel-body">
                 <div class="row">       
   
     <?php if (!empty($countPl)): ?>                    
          <?php foreach ($countPl as $plano): ?>
        <?php $rowsCap = $this->db->query("SELECT * FROM capitulo"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>    

        <?php $rowsVideo = $this->db->query("SELECT * FROM videos"); ?>
       <?php $countVideo = $rowsVideo->result(); ?>       

             <div class="col-lg-4 col-md-4 col-sm-4 portfolio-item">
    <div class="thumbnail text-center front">  
        <div class="caption">
           <h2><span class="label label-warning"><?php echo $plano->duracao; ?> <?php echo FormPeriodo($plano->periodo); ?></span>
        <span class="label label-primary"><?php echo reais($plano->valor); ?></span></h2>  
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
                    ?>
<?php if(isset($resAss[0]->id_assinatura) && empty($resAss[0]->id_assinatura) == true): ?>    
         <div class="alert alert-info" role="alert">Plano foi assinado</div>
     <?php else: ?>  
       <a href="<?php echo base_url('home/assinar/' . $plano->id_plano); ?>" class='btn btn-primary btn-lg btnComprar' role='button'>Assinar</a>
      <?php endif; ?>
  <?php else: ?>
  <a href="<?php echo base_url('home/cadastro'); ?>" class='btn btn-primary btn-lg btnComprar' role='button'>Assinar</a>
                        <?php endif; ?>
        </p>
     
     
    </div>
  </div>                
        <?php endforeach; ?>

        <?php else: ?>
        <div class="alert alert-info" role="alert">
    Nenhum plano neste momento.
            </div>
        <?php endif; ?>    

        </div>
        <button class="btn btn-success btn-lg displayButton"><span class="glyphicon glyphicon-eye-open"></span> <?php echo count($countPLivro); ?> Livros</button>
               <div class="row displayLivros">            
     <?php if (!empty($countPLivro)): ?>   
     <hr>                 
          <?php foreach ($countPLivro as $livro): ?>
 <?php $rowsLivro = $this->db->query("SELECT * FROM livros WHERE id_livro = {$livro->id_livro}"); ?>
            <?php $resLivro = $rowsLivro->result(); ?>     
 <?php $rowsCap = $this->db->query("SELECT * FROM capitulo WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>                     

        <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>                     
             <div class="col-lg-3 col-md-3 col-sm-3 portfolio-item">
    <div class="thumbnail text-center front">  
        <?php echo (isset($resLivro[0]->imagem) && $resLivro[0]->imagem != '' && $resLivro[0]->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $resLivro[0]->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>                    
              
       <p><?php echo count($countCaps); ?> <?php plural(count($countCaps), 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
          
      
    </div>
  </div>                
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning" role="alert">
    Nenhum livro neste momento.
            </div>
        <?php endif; ?>    

        </div>  
                  </div><!-- end panel-body --> 
      </div><!-- end panel-collapse --> 
  </div><!-- end panel-primary -->  
 
    
       <?php endforeach; ?>
</div><!-- end panel-group -->   
   


            </div> <!-- end col-lg-12 -->
        </div><!-- end row -->


  
      
    </div>
</section>

  <div class="modal fade" id="modalLivros" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><div id="id_planos"></div><?php echo $count_livros; ?> Livros</h4>
        </div>
        <div class="modal-body">

        <div class="row">            
     <?php if (!empty($countPLivro)): ?>                    
          <?php foreach ($countPLivro as $livro): ?>
 <?php $rowsCap = $this->db->query("SELECT * FROM capitulo WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>                     

        <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>                     
             <div class="col-lg-4 col-md-4 col-sm-4 portfolio-item">
    <div class="thumbnail text-center front">  
        <?php echo (isset($livro->imagem) && $livro->imagem != '' && $livro->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $livro->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>                    
              
       <p><?php echo count($countCaps); ?> <?php plural(count($countCaps), 'capítulo', 'capítulos'); ?> <br> <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
          
      
    </div>
  </div>                
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-warning" role="alert">
    Nenhum livro neste momento.
            </div>
        <?php endif; ?>    

        </div>   
 <input type="hidden" name="id_capitulo" id="id_capitulo" value="" />                       
                                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>


<?php if($this->uri->segment(2) == 'planos') { ?>
<script>
     $(document).ready(function() {       
        $('#planos').addClass("cima");
     });
</script>     

<?php } ?>

<script>
       $(function() {
                
                $('#modalLivros').on('show.bs.modal', function (e) {
                    $('.formulario').resetForm();
                });
                        
                $('.formulario').ajaxForm({
                    success: function (data) {
                        if (data == 1) {                           
                            document.location.href = document.location.href;
                        }
                    }
                });
            });

     var base_url = "<?php echo base_url(); ?>";
    
      function carregaDadosLivrosJSon(id_planos) {      
                $.post(base_url + 'home/dados_livros', {
                    id_planos: id_planos
                }, function (data) {
                    $('#id_planos').text(data.id_planos);                   
                }, 'json');
            }

   function modalLivros(id_planos) {             
                 if (id_planos != null) {                
                    carregaDadosLivrosJSon(id_planos);
                }
                $('#modalLivros').modal('show');
            }
  </script>