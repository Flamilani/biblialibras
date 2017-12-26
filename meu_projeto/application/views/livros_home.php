    <div class="container headLivro">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h3>Livros e Planos</h3>
              <!--   <hr class="star-primary"> -->
            </div>
        </div>
       <hr>
        <div class="row">   
  <div ng-repeat="filter:filtro">
     <?php if (!empty($lista_livros)): ?>                    
          <?php foreach ($lista_livros as $livro): ?>
        <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCap = $rowsCap->result(); ?>                     
             <div class="col-lg-4 col-md-6 col-sm-4 portfolio-item">
    <div class="thumbnail text-center front">
       <!--  <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>  </a> -->
                <img src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" class="img-responsive" alt="">
              
                <p><?php echo $livro->titulo; ?></p>
       <p><?php echo count($countCap); ?> <?php plural(count($countCap), 'capítulo', 'capítulos'); ?> | 36 vídeos</p>
      <div class="caption">
        <h2><?php echo reais($livro->valor); ?></h2>
         <?php if(null != $this->session->userdata('logado')): ?>
        <p><a href="#" class="btn btn-primary btnComprar" role="button">Comprar</a></p>
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
