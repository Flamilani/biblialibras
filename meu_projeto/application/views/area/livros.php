    <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Parabéns! Foi marcado como concluído com sucesso!</div>
            <?php } ?>
    <div class="container">
    
        <?php $livroUrl = $this->uri->segment(3); ?>
        <?php $capUrl = $this->uri->segment(4); ?>
 <?php $q = $this->db->query("SELECT * FROM capitulos c INNER JOIN livros l ON l.id_livro = c.id_livro WHERE md5(c.id_livro) = '{$livroUrl}' AND md5(c.id_capitulo) = '{$capUrl}' AND c.status = 1"); ?>
    <?php foreach($q->result() as $dado): ?>
      <div class="front">
          <h3><a href="<?php echo base_url('area'); ?>">Meus Livros</a> > <?php echo $dado->titulo; ?> <small class="pull-right tituloCap"> <?php echo $dado->capitulo; ?></small></h3>
          </div>
                   <?php endforeach; ?>
     

        <div class="row">
               
            <div class="col-xs-12 col-md-4 col-lg-4">
  <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE md5(id_livro) = '{$livroUrl}'"); ?>
            <?php $countHist = $rowsHist->result(); ?>
    <?php $rowsCap = $this->db->query("SELECT * FROM capitulos WHERE md5(id_livro) = '$livroUrl' AND status = 1"); ?>
            <?php $countCap = $rowsCap->result(); ?>                        
                    <h6 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h6>
                    <div class="progress">
                     
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
			<div class="list-group">
 <!--  <a href="#" class="list-group-item active">
    Cras justo odio
  </a>
  <a href="#" class="list-group-item">Dapibus ac facilisis in</a>
  <a href="#" class="list-group-item">Morbi leo risus</a>
  <a href="#" class="list-group-item">Porta ac consectetur ac</a>
  <a href="#" class="list-group-item">Vestibulum at eros</a> -->

     
          <?php if (!empty($lista_capitulos)): ?>                    
       <?php foreach ($lista_capitulos as $caps): ?>
    <a class="list-group-item <?php echo md5($caps->id_capitulo) == $capUrl ? 'active' : '' ?>" href="<?php echo base_url('area/livro/' . md5($caps->id_livro) . '/' . md5($caps->id_capitulo)); ?>" ><?php echo $caps->capitulo; ?>
<?php $q = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$caps->id_livro}' AND id_capitulo = '{$caps->id_capitulo}' AND visto_status = 1"); ?>
                     <?php foreach($q->result() as $dado): ?>
               <span class="badge concluido"><b class="glyphicon glyphicon-ok"></b></span>
                   <?php endforeach; ?>
                 </a>
          <?php endforeach; ?>
        <?php endif; ?>      
</div>
            	</div>
            	 <div class="col-xs-12 col-md-8 col-lg-8">
            	 	 <div class="boxVideo fundoLoad">                
   <?php $q = $this->db->query("SELECT * FROM capitulos WHERE md5(id_livro) = '{$livroUrl}' AND md5(id_capitulo) = '{$capUrl}' AND status = 1"); ?>
                     <?php foreach($q->result() as $dado): ?>
                     <?php echo $dado->video; ?>
                   <?php endforeach; ?>
               
            </div><br> 

  <?php $qy = $this->db->query("SELECT * FROM historico_livro WHERE md5(id_livro) = '{$livroUrl}' AND md5(id_capitulo) = '{$capUrl}'"); ?> 
   <?php $res = $qy->result(); ?>   
   <?php if(count($res) > 0): ?>             
   <button class="btn btn-default btnConcluido">Concluído  <span class="badge concluido"> <b class="glyphicon glyphicon-ok"></b></span></button>
            <?php else: ?>
            <?php foreach($q->result() as $dado): ?>           
              <?php $btnMarcar = array('name' => 'btn_concluido', 'id' => 'btn_concluido', 'type' => 'submit', 'class' => 'btn btn-success btnConcluido', 'value' => 'Marcar como Concluído');  ?>
  <?php echo form_open('area/marcarConcluido', 'role="form"') . form_hidden('id_livro', $dado->id_livro) . form_hidden('id_capitulo',$dado->id_capitulo); ?>
<?php endforeach; ?>               
            <?php echo form_submit($btnMarcar); ?>
            <?php form_close(); ?>   
            <?php endif; ?>        

            	 </div>

            </div>
        </div>
<div class="row">
  
  <!-- First column -->
  <div class="col-4">

    <!-- Navigation -->
    <div class="list-group" id="list-tab" role="tablist">
      <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
      <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>
      <a class="list-group-item list-group-item-action" id="list-messages-list" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages">Messages</a>
      <a class="list-group-item list-group-item-action" id="list-settings-list" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings">Settings</a>
    </div>
    <!-- Navigation -->

  </div>
  <!-- First column -->

  <!-- Second column -->
  <div class="col-8">

    <!-- Content -->
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">...</div>
      <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">...</div>
      <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">...</div>
      <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">...</div>
    </div>
    <!-- Content -->

  </div>
  <!-- Second column -->

</div>
