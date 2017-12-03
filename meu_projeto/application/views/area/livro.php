    <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Parabéns! Foi marcado como concluído com sucesso!</div>
            <?php } ?>
    <div class="container">
    
        <?php $livroUrl = $this->uri->segment(3); ?>
        <?php $capUrl = $this->uri->segment(4); ?>
 <?php $q = $this->db->query("SELECT *, c.titulo as tema FROM videos c INNER JOIN livros l ON l.id_livro = c.id_livro WHERE md5(c.id_livro) = '{$livroUrl}' AND md5(c.id_video) = '{$capUrl}' AND c.status = 1"); ?>
    <?php foreach($q->result() as $dado): ?>
      <div class="front">
          <h3><a href="<?php echo base_url('area'); ?>">Meus Livros</a> > <?php echo $dado->titulo; ?> </h3>
          </div>
                   <?php endforeach; ?>
     

        <div class="row">
               
            <div class="col-xs-12 col-md-4 col-lg-4">
  <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE md5(id_livro) = '{$livroUrl}'"); ?>
            <?php $countHist = $rowsHist->result(); ?>
    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE md5(id_livro) = '$livroUrl' AND status = 1"); ?>
            <?php $countCap = $rowsCap->result(); ?>                        
                    <h6 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h6>
                    <div class="progress">
                     
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
<div class="bs-example">
    <div class="panel-group" id="accordion">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1. What is HTML?</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p>HTML stands for HyperText Markup Language. HTML is the main markup language for describing the structure of Web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2. What is Bootstrap?</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>Bootstrap is a powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">3. What is CSS?</a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse">
                <div class="panel-body">
                    <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
			<div class="list-group">
       
          <?php if (!empty($lista_capitulos)): ?>                    
       <?php foreach ($lista_capitulos as $caps): ?>
    <a class="list-group-item <?php echo md5($caps->id_video) == $capUrl ? 'active' : '' ?>" href="<?php echo base_url('area/livro/' . md5($caps->id_livro) . '/' . md5($caps->id_video)); ?>" ><?php echo $caps->titulo; ?>
<?php $q = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = '{$caps->id_livro}' AND id_video = '{$caps->id_video}' AND visto_status = 1"); ?>
                     <?php foreach($q->result() as $dado): ?>
               <span class="badge concluido"><b class="glyphicon glyphicon-ok"></b></span>
                   <?php endforeach; ?>
                 </a>
          <?php endforeach; ?>
        <?php endif; ?>      
 
</div>
            	</div>
            	 <div class="col-xs-12 col-md-8 col-lg-8">
       <?php $q = $this->db->query("SELECT * FROM videos WHERE md5(id_livro) = '{$livroUrl}' AND md5(id_video) = '{$capUrl}' AND status = 1"); ?>
        <?php foreach($q->result() as $dado): ?>
          <h3 class="front">
                     <?php echo $dado->titulo; ?></h3>
                   <?php endforeach; ?>
            	 	 <div class="boxVideo fundoLoad">              
                       <?php foreach($q->result() as $dado): ?>
                     <?php echo $dado->video; ?> 
                   <?php endforeach; ?>
               
            </div><br> 

  <?php $qy = $this->db->query("SELECT * FROM historico_livro WHERE md5(id_livro) = '{$livroUrl}' AND md5(id_video) = '{$capUrl}'"); ?> 
   <?php $res = $qy->result(); ?>   
   <?php if(count($res) > 0): ?>             
   <button class="btn btn-default btnConcluido">Concluído  <span class="badge concluido"> <b class="glyphicon glyphicon-ok"></b></span></button>
            <?php else: ?>
            <?php foreach($q->result() as $dado): ?>           
              <?php $btnMarcar = array('name' => 'btn_concluido', 'id' => 'btn_concluido', 'type' => 'submit', 'class' => 'btn btn-success btnConcluido', 'value' => 'Marcar como Concluído');  ?>
  <?php echo form_open('area/marcarConcluido', 'role="form"') . form_hidden('id_livro', $dado->id_livro) . form_hidden('id_video',$dado->id_capitulo); ?>
<?php endforeach; ?>               
            <?php echo form_submit($btnMarcar); ?>
            <?php form_close(); ?>   
            <?php endif; ?>        

            	 </div>

            </div>
        </div>