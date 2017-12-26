<?php foreach($livro as $item): ?>
    <div class="container headTop front ladosTela">
    	<div class="page-header">
    	 <h2><a href="<?php echo base_url('home/livros'); ?>">Livros</a> > <?php echo $item->tema; ?></h2>
    	</div>
        <div class="row"> 
            <form method="post" action="<?php echo base_url('home/add_carrinho'); ?>">        
          <input type="hidden" name="id" value="<?= $item->id_livro; ?>">
          <input type="hidden" name="nome" value="<?= $item->tema; ?>">
          <input type="hidden" name="preco" value="<?= $item->valor; ?>">
          <input type="hidden" name="foto" value="<?= base_url('assets/uploads/' . $item->imagem); ?>">
          <input type="hidden" name="url" value="<?= base_url(uri_string()); ?>">
               <div class="col-lg-6 col-md-6">
    <img src="<?php echo base_url('assets/uploads/' . $item->imagem); ?>" class="img-responsive" alt="" />   
       </div>
          
        <div class="col-lg-6 col-md-6 text-center">
        	 <h3> <?php echo $item->tema; ?></h3>
        	 <h2><?php echo reais($item->valor); ?></h2>
        	<br>
        	<!-- <p class="text-center"> <a href="<?php // echo base_url('carrinho/adicionar/' . $livro[0]->id_livro); ?>" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Adicionar no carrinho</a></p> -->
            <?php if(null != $this->session->userdata('logado')): ?>    
            <button name="btn_cart" id="btn_cart" class="btn btn-success" type="submit">Adicionar ao carrinho</button>     
        <?php else: ?>
   <a class="btn btn-info" href="<?php echo base_url('home/assinatura'); ?>" role="button">Assinar</a><br><br>
          <div class="alert alert-info text-center" role="alert">
            Obs: Para comprar livros, tem que assinar primeiro ou logar para acessar.
         </div>
        <?php endif; ?>
        <input type="hidden" name="quantidade" maxlength="2" size="3" />
     
        		 </form>  
        </div>
        </div>
        <br>
         <div class="row">          
               <div class="col-lg-6 col-md-6 text-center">
           
   <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$item->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>   

            <p><?php echo $capitulos_livros_id[0]->capitulos; ?> <?php plural($capitulos_livros_id[0]->capitulos, 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
       </div>
         
        
        </div>
	<div class="row">
        <div class="col-lg-12 text-center">
        	 <hr>
        	<?php echo $item->conteudo; ?>
        	
        </div>
   
</div>
 <?php endforeach; ?>
    </div>
    <div class="container headLivro">
        <div class="row">
            <div class="col-lg-12 text-center front">
                  <hr class="star-primary"> 
                <h3>Livros Relacionados</h3>
        
            </div>
        </div>
       <hr>
        <div class="row">   
  <div ng-repeat="filter:filtro">
     <?php if (!empty($livros_rand)): ?>                    
          <?php foreach ($livros_rand as $livro): ?>
        <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCap = $rowsCap->result(); ?>                     
             <div class="col-lg-4 col-md-6 col-sm-4 portfolio-item">
    <div class="thumbnail text-center">
                <img src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" class="img-responsive" alt="">
                
                <p><?php echo $livro->titulo; ?></p>
       <p><?php echo count($countCap); ?> <?php plural(count($countCap), 'capítulo', 'capítulos'); ?> | 36 vídeos</p>
      <div class="caption">
        <h2><?php echo reais($livro->valor); ?></h2>
         <?php if(null != $this->session->userdata('logado')): ?>
        <p><a href="<?php echo base_url('home/livro/' . $livro->id_livro . '/' . clear($livro->titulo)); ?>" class="btn btn-primary btnComprar" role="button">Comprar</a></p>
          <?php else: ?>
         <p><a href="<?php echo base_url('home/livro/' . $livro->id_livro . '/' . clear($livro->titulo)); ?>" class="btn btn-warning btn-lg" role="button">Ver mais detalhes</a></p>
          <?php endif; ?>
      </div>
    </div>
  </div>                
        <?php endforeach; ?>
        <?php else: ?>
        <div class="alert alert-info" role="alert">
    Nenhum livro neste momento.
            </div>
        <?php endif; ?>    

  </div>
        </div>
        <br>
        <div class="text-center">
        <a class="btn btn-primary btn-lg" href="<?php echo base_url('home/livros'); ?>">Ver mais livros</a>
</div>
    </div>