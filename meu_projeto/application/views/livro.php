<?php foreach($livro as $item): ?>
    <div class="container front ladosTela">
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
     <?php echo (isset($item->imagem) && $item->imagem != '' && $item->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $item->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>      
   
       </div>
          
        <div class="col-lg-6 col-md-6 text-center">
        	 <h3> <?php echo $item->id_livro; ?><?php echo $item->tema; ?></h3>
        	 <h2><?php echo reais($item->valor); ?></h2>
        	<br>
        	<!-- <p class="text-center"> <a href="<?php // echo base_url('carrinho/adicionar/' . $livro[0]->id_livro); ?>" class="btn btn-success"><span class="glyphicon glyphicon-shopping-cart"></span> Adicionar no carrinho</a></p> -->         
            <?php if(null != $this->session->userdata('logado')): ?>   
             <?php 
            foreach($this->cart->contents() as $it): ?>  
                    
            <?php echo (isset($it['id']) && $it['id'] != $item->id_livro) ? "<button name='btn_cart' id='btn_cart' class='btn btn-success' type='submit'>Adicionar ao carrinho</button>" : " <h5><div class='alert alert-info text-center' role='alert'>Este livro já foi adicionado no carrinho! <br /><br /> Ver carrinho</div></h5>"; ?>
                       
          <?php endforeach; ?>
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
             <?php $rowsCap = $this->db->query("SELECT * FROM capitulo WHERE id_livro = '{$item->id_livro}'"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>      
   <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$item->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>   

           <p><?php echo count($countCaps); ?> <?php plural(count($countCaps), 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
       </div>
         
        
        </div>

 <?php endforeach; ?>
    </div>
    <div class="container headLivro">
        <div class="row">
            <div class="col-lg-12 text-center front">
                  <hr> 
                <h3>Livros Relacionados</h3>
        
            </div>
        </div>
       <hr>
        <div class="row">   
  <div ng-repeat="filter:filtro">
     <?php if (!empty($livros_rand)): ?>                    
          <?php foreach ($livros_rand as $livro): ?>
             <?php $rowsCap = $this->db->query("SELECT * FROM capitulo WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCaps = $rowsCap->result(); ?>         
 <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>                      
             <div class="col-lg-4 col-md-6 col-sm-4 portfolio-item">
    <div class="thumbnail text-center">
    <?php echo (isset($livro->imagem) && $livro->imagem != '' && $livro->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $livro->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>     
                <p><?php echo $livro->titulo; ?></p>
       <p><?php echo count($countCaps); ?> <?php plural(count($countCaps), 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
      <div class="caption">
        <h2><?php echo reais($livro->valor); ?></h2>
          <?php if(null != $this->session->userdata('logado')): ?>        
          <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>  
          <?php $user = $this->session->userdata('user')->id; ?>
     <?php $Itens = $this->db->query("SELECT * FROM itens_pedidos ip INNER JOIN pedidos p ON ip.id_pedido = p.id_pedido WHERE ip.id_livro = '{$livro->id_livro}' AND p.id_user = {$user}"); ?>
                   <?php $Item = $Itens->result(); ?>           
 
  <?php echo (isset($Item[0]->id_livro) && empty($livro->id_livro) == false) ? "  <a href='" . base_url('area/livro' . '/' . $livro->id_livro . '/' . $countVideo[0]->id_video) . "' class='btn btn-primary btn-lg' role='button'>Assistir</a> " : "<a href='" . base_url('home/livro/' . $livro->id_livro . '/' . clear($livro->titulo)) . "' class='btn btn-primary btn-lg btnComprar' role='button'>Comprar</a>"; ?>
  
  <?php else: ?>
  <a href="<?php echo base_url('home/livro/' . $livro->id_livro . '/' . clear($livro->titulo)); ?>" class='btn btn-primary btn-lg btnComprar' role='button'>Comprar</a>
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