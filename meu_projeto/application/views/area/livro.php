    <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Parabéns! Foi marcado como concluído com sucesso!</div>
            <?php } ?>
    <div class="container">
    
        <?php $livroUrl = $this->uri->segment(3); ?>
        <?php $capUrl = $this->uri->segment(4); ?>
 <?php $q = $this->db->query("SELECT *, c.titulo as tema FROM videos c INNER JOIN livros l ON l.id_livro = c.id_livro  WHERE c.id_livro = '{$livroUrl}' AND c.id_video = '{$capUrl}' AND c.status = 1"); ?>
    <?php foreach($q->result() as $dado): ?>
      <div class="front">
          <h3><a href="<?php echo base_url('area'); ?>">Meus Livros</a> > <?php echo $dado->titulo; ?> <span style="float: right;">Cap. <?php echo $dado->id_capitulo; ?></span> </h3>
          </div>
                   <?php endforeach; ?>
     

        <div class="row">
               
            <div class="col-xs-12 col-md-4 col-lg-4">
  <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$livroUrl}'"); ?>
            <?php $countHist = $rowsHist->result(); ?>
    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = '$livroUrl' AND status = 1"); ?>
            <?php $countCap = $rowsCap->result(); ?>                        
                    <h6 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h6>
                    <div class="progress">
                     
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
<div class="over">
          <?php foreach ($titulo_capitulo as $titulo): ?>
            <div id="<?php echo $titulo->id_capitulo; ?>" class="list-group-item list-group-item-info"><b style="font-size: 17px;">Capítulo <?php echo $titulo->capitulo; ?></b></div>
            <div class="list-group">   
    <?php $exibe_videos = $this->db->query("SELECT * FROM livros l INNER JOIN videos v on l.id_livro = v.id_livro WHERE l.id_livro = '{$livroUrl}' AND v.id_capitulo =  {$titulo->capitulo} AND l.status = 1"); ?>
       <?php foreach ($exibe_videos->result() as $video): ?>
   <a class="list-group-item <?php echo $video->id_video == $capUrl ? 'active' : '' ?>" href="<?php echo base_url('area/livro/' . $video->id_livro . '/' . $video->id_video); ?>" >
      <?php echo $video->titulo; ?>  
<?php $q = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$video->id_livro}' AND id_video = '{$video->id_video}' AND visto_status = 1"); ?>
                     <?php foreach($q->result() as $dado): ?>
               <span class="badge concluido"><b class="glyphicon glyphicon-ok"></b></span>
                   <?php endforeach; ?>
                 </a>
          <?php endforeach; ?>         
    </div>
  <?php endforeach; ?>
  </div>
            	</div>
            	 <div class="col-xs-12 col-md-8 col-lg-8">
       <?php $q = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livroUrl}' AND id_video = '{$capUrl}' AND status = 1"); ?>
        <?php foreach($q->result() as $dado): ?>
          <h4 class="front" style="text-align: center; margin-top: 0px; margin-bottom: 5px;">
                     <?php echo $dado->titulo; ?></h4>
                   <?php endforeach; ?>
            	 	 <div class="boxVideo fundoLoad">              
                       <?php foreach($q->result() as $dado): ?>
                     <?php echo $dado->video; ?> 
                   <?php endforeach; ?>
               
            </div>

  <?php $qy = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$livroUrl}' AND id_video = '{$capUrl}'"); ?> 
   <?php $res = $qy->result(); ?>   
   <?php if(count($res) > 0): ?>             
   <button class="btn btn-default btnConcluido">Concluído  <span class="badge concluido"> <b class="glyphicon glyphicon-ok"></b></span></button>
            <?php else: ?>
            <?php foreach($q->result() as $dado): ?>           
              <?php $btnMarcar = array('name' => 'btn_concluido', 'id' => 'btn_concluido', 'type' => 'submit', 'class' => 'btn btn-success btnConcluido', 'value' => 'Marcar como Concluído');  ?>
  <?php echo form_open('area/marcarConcluido', 'role="form"') . form_hidden('id_livro', $dado->id_livro) . form_hidden('id_video',$dado->id_video); ?>
<?php endforeach; ?>               
            <?php echo form_submit($btnMarcar); ?>
            <?php form_close(); ?>   
            <?php endif; ?>        

            	 </div>

            </div>
        </div>
