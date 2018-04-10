    <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Parabéns! Foi marcado como concluído com sucesso!</div>
            <?php } ?>
    <div class="container-fluid">
     <?php $user = $this->session->userdata('user')->id; ?>
        <?php $livroUrl = $this->uri->segment(3); ?>
        <?php $capUrl = $this->uri->segment(4); ?>
 <?php $q = $this->db->query("SELECT *, v.titulo as tema FROM videos v INNER JOIN livros l ON l.id_livro = v.id_livro  WHERE v.id_livro = '{$livroUrl}' AND v.id_video = '{$capUrl}' AND v.status = 1"); ?>
    <?php foreach($q->result() as $dado): ?>
      <?php $caps = $this->db->query("SELECT * FROM capitulo WHERE id_capitulo = '{$dado->id_capitulo}'"); ?>
      <?php $resCaps = $caps->result(); ?>
       <?php $assina = $this->db->query("SELECT * FROM assinaturas WHERE id_user = '{$user}'"); ?>
      <?php $assi = $assina->result(); ?>
      <div style="margin-top: 70px;" class="front">
          <h3><a href="<?php echo base_url('area/assinatura/'. $assi[0]->id_assinatura); ?>">Meus Livros</a> : <?php echo $dado->titulo; ?> <span style="float: right;"><?php echo $dado->sigla; ?> <?php echo $resCaps[0]->capitulo; ?></span> </h3>
          </div>
                   <?php endforeach; ?>
     

        <div class="aula-flex row">
            <div class="col-xs-12 col-md-5 col-lg-5">             
  <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$livroUrl}' AND id_user = '{$user}'"); ?>
            <?php $countHist = $rowsHist->result(); ?>
    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = '$livroUrl' AND status = 1"); ?>
            <?php $countCap = $rowsCap->result(); ?>
            <div class="panel panel-primary">  
  <div class="panel-body">                        
                    <h4 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h4>
                    <div class="progress">                  
   <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
</div>
</div>

    <div class="over aulas-sidebar mCustomScrollbar" data-mcs-theme="dark">
  <?php foreach ($titulo_capitulo as $titulo): ?>
            <div class="list-group-item list-group-item-info"><b style="font-size: 17px;"><?php echo $titulo->sigla; ?> <?php echo $titulo->capitulo; ?></b></div>
            <div class=" list-group">
<?php $exibe_videos = $this->db->query("SELECT *, v.titulo as video, v.ordem as ordem_video FROM videos v INNER JOIN livros l on l.id_livro = v.id_livro WHERE l.id_livro = '{$livroUrl}' AND v.id_capitulo =  {$titulo->id_capitulo} AND l.status = 1 ORDER BY v.ordem"); ?>
       <?php foreach ($exibe_videos->result() as $video): ?>
   <a class="list-group-item <?php echo $video->id_video == $capUrl ? 'active' : '' ?>" href="<?php echo base_url('area/livro/' . $video->id_livro . '/' . $video->id_video) . '/' . clear($video->video); ?>" >
      <?php echo $video->ordem_video; ?>   <?php echo $video->video; ?>
<?php $q = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$video->id_livro}' AND id_video = '{$video->id_video}' AND visto_status = 1 AND id_user = '{$user}'"); ?>
                     <?php foreach($q->result() as $dado): ?>
               <span class="badge concluido"><b class="glyphicon glyphicon-ok"></b></span>
                   <?php endforeach; ?>
                 </a>
          <?php endforeach; ?>         
    </div>
  <?php endforeach; ?>

  </div>
            	</div>
            	 <div class="col-xs-12 col-md-7 col-lg-7">
       <?php $q = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livroUrl}' AND id_video = '{$capUrl}' AND status = 1"); ?>
        <?php foreach($q->result() as $dado): ?>
          <h2 class="front" style="text-align: center; margin-top: 0px; margin-bottom: 5px;">
                     <?php echo $dado->titulo; ?></h2>
                   <?php endforeach; ?>
            	 	 <div class="boxVideo fundoLoad">              
                       <?php foreach($q->result() as $dado): ?>
                     <?php echo $dado->video; ?> 
                   <?php endforeach; ?>
               
            </div>
       
<nav aria-label="...">
  <ul style="margin-top: 0px;" class="pager">

    <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Anterior</a></li>

  <?php $qy = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$livroUrl}' AND id_video = '{$capUrl}' AND id_user = '{$user}'"); ?> 
   <?php $res = $qy->result(); ?>   
   <?php if(count($res) > 0): ?>            
   <?php foreach($res as $dado): ?>           
              <?php $btnDesmarcar = array('style' => 'display: inline-block; margin-top: 3px;', 'name' => 'btn_concluido', 'id' => 'btn_concluido', 'type' => 'submit', 'class' => 'btn btn-default btnConcluido', 'value' => 'Concluído', 'onclick'=>'return confirmarDesmarcar()');  ?>
  <?php echo form_open('area/desmarcar', 'role="form"') . form_hidden('id_hist', $dado->id_hist) . form_hidden('id_livro', $dado->id_livro) . form_hidden('id_video',$dado->id_video); ?>
<?php endforeach; ?>               
            <?php echo form_submit($btnDesmarcar); ?>
            <?php form_close(); ?>  
            <?php else: ?>
            <?php foreach($q->result() as $dado): ?>           
              <?php $btnMarcar = array('style' => 'display: inline-block; margin-top: 3px', 'name' => 'btn_concluido', 'id' => 'btn_concluido', 'type' => 'submit', 'class' => 'btn btn-success btnConcluido', 'value' => 'Marcar como Concluído');  ?>
  <?php echo form_open('area/marcarConcluido', 'role="form"') . form_hidden('id_livro', $dado->id_livro) . form_hidden('id_video',$dado->id_video); ?>
<?php endforeach; ?>               
            <?php echo form_submit($btnMarcar); ?>
            <?php form_close(); ?>   
            <?php endif; ?> 
    <li class="next"><a href="#">Próximo <span aria-hidden="true">&rarr;</span></a></li>
  </ul>
</nav>
            	 </div>

            </div>
        </div>
  <script type="text/javascript">
        $(document).ready(function() {

          //  carregarDinamico();
            function carregarDinamico() {
              $('.realtime').click(function() {
               var pagina = $(this).attr('href', '<?php echo base_url("area/livro/" . $livroUrl . '/' . $capUrl); ?>');

               $('.container-fluid').load(pagina);
               // return false;
              });
            }

        });
  </script>