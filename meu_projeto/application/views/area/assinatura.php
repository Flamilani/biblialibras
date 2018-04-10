<?php if(isset($assinatura[0]->status_pago) && $assinatura[0]->status_pago == 2 && $assinatura[0]->data_inicial != null): ?>
<div class="container ladosTela">
   <div style="margin-top: 70px;" class="page-header">
              <?php $rowsLivroPrinc = $this->db->query("SELECT * FROM livros ORDER BY ordem ASC"); ?>
               <?php $countLivroPrinc = $rowsLivroPrinc->result(); ?>  
    <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$assinatura[0]->id_planos}"); ?>   
            <?php $countPLivro = $rowsPlanoLivro->result(); ?>

  <h3><a href="<?php echo base_url('area'); ?>">Área do Usuário</a> : <?php echo $assinatura[0]->nome_plano; ?> | <?php echo $assinatura[0]->duracao; ?> <?php echo FormPeriodo($assinatura[0]->periodo); ?> | <?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'Livro', 'Livros') ?></h3>
</div>
    <div class="row display-flex">
          <?php $user = $this->session->userdata('user')->id; ?>

                     <?php $rowsHistTotal = $this->db->query("SELECT * FROM historico_livro WHERE id_user = {$user}"); ?>
            <?php $countHistTotal = $rowsHistTotal->result(); ?>      

    <?php $rowsCapTotal = $this->db->query("SELECT * FROM videos WHERE status = 1"); ?>   
            <?php $countCapTotal = $rowsCapTotal->result(); ?>  
<!-- 
<div class="panel panel-primary">  
  <div class="panel-body">
   <h4 class="text-center">Seu Progresso ( <?php echo count($countHistTotal); ?> / <?php echo count($countCapTotal); ?> )</h4>
                    <div class="progress"> 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHistTotal), count($countCapTotal)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHistTotal), count($countCapTotal)); ?>%;">
     <?php echo substr(porcento(count($countHistTotal), count($countCapTotal)),0,5); ?>%
  </div>
</div>
  </div>
</div> -->
           <?php if (!empty($countLivroPrinc)): ?>                    
           <?php foreach ($countLivroPrinc as $livro): ?>
     <?php $rowsLivro = $this->db->query("SELECT * FROM livros WHERE id_livro = {$livro->id_livro} ORDER BY ordem ASC"); ?>
            <?php $resLivro = $rowsLivro->result(); ?>     
      <?php if(in_array($resLivro[0]->id_livro, explode(',', $countPLivro[0]->params))): ?>
        <div class="col-xs-12 col-sm-3 col-md-3">
            <div class="thumbnail text-center">
              <?php echo (isset($resLivro[0]->imagem) && $resLivro[0]->imagem != '' && $resLivro[0]->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $resLivro[0]->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>     
                <div class="caption">
           
                  <?php $user = $this->session->userdata('user')->id; ?>

                     <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = {$livro->id_livro} AND id_user = {$user}"); ?>
            <?php $countHist = $rowsHist->result(); ?>      

    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = {$livro->id_livro} AND status = 1"); ?>   
            <?php $countCap = $rowsCap->result(); ?>  
   <?php $rowsAcess = $this->db->query("SELECT * FROM acesso_livro WHERE id_assinatura = {$assinatura[0]->id_assinatura} AND id_user = {$user}"); ?>   
            <?php $acesso = $rowsAcess->result(); ?>  
                                        
                       <?php if(count($countCap) > 0): ?>                
                    <h4 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h4>
                    <div class="progress">
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
<?php $user = $this->session->userdata('user')->id; ?>  
<form method="post" action="<?php echo base_url('area/iniciar'); ?>" role="form">
  <input type="hidden" id="id_livro" name="id_livro" value="<?php echo $livro->id_livro; ?>" />
  <input type="hidden" id="id_assinatura" name="id_assinatura" value="<?php echo $assinatura[0]->id_assinatura; ?>" />
  <input type="hidden" id="id_video" name="id_video" value="<?php echo $countCap[0]->id_video; ?>" />
  <input type="hidden" id="id_user" name="id_user" value="<?php echo $user; ?>" />
  <input type="hidden" id="titulo" name="titulo" value="<?php echo $countCap[0]->titulo; ?>" />
    <input type="submit" name="btn_iniciar" id="btn_iniciar" class="btn btn-success" value="Assistir" />
</form>           
                
<?php else: ?>
   <h5><div style="line-height: 3.8;" class="alert alert-warning" role="alert">Em construção</div></h5>
<?php endif; ?>
                </div>
            </div>
        </div>   
         <?php else: 
     
    endif;
      ?>    
 <?php endforeach; ?>
<?php else: ?>
  <div class="alert alert-info areaUser" role="alert">Não há livros escolhidos. <br> 
    <a href="<?php echo base_url('home/livros'); ?>">Comprar livros</a></div>
 <?php endif; ?>       
    </div>
</div>
<?php else: ?>
<?php $this->session->set_flashdata("sem_permissao", "Sem permissão");
    redirect(base_url('area')); ?>
<?php endif; ?>
  <script type="text/javascript">
        $(document).ready(function () {
             $(document).on('click', '.iniciar_livro', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';

            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/livros/iniciar_livro' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_livro": id, "status": status},
                success: function (data) {
                    location.reload();
                }});        
    });
        });
  </script>