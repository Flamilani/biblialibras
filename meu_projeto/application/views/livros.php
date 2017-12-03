<!-- Portfolio Grid Section -->
<section id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h3>Livros e Planos</h3>
              <!--   <hr class="star-primary"> -->
            </div>
        </div>
        <div class="row">
  <div class="col-md-8 front"><h3><?php echo $count_livros; ?> livros</h3>  </div>
  <div class="col-md-4"> 
 <div class="input-group">
     <input type="text" class="form-control" id="livro" placeholder="Busca livro" ng-model="filtro" />
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div><!-- /input-group -->
  </div>
</div>
      <hr> 
        <div class="row">   
  <div ng-repeat="filter:filtro">
     <?php if (!empty($lista_livros)): ?>                    
          <?php foreach ($lista_livros as $livro): ?>
        <?php $rowsCap = $this->db->query("SELECT * FROM capitulos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countCap = $rowsCap->result(); ?>                     
             <div class="col-lg-4 col-md-6 col-sm-4 portfolio-item">
    <div class="thumbnail text-center">
        <a href="#portfolioModal5" class="portfolio-link" data-toggle="modal">
                    <div class="caption">
                        <div class="caption-content">
                            <i class="fa fa-search-plus fa-3x"></i>
                        </div>
                    </div>
                <img src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" class="img-responsive" alt="">
                </a>
                <p><?php echo $livro->titulo; ?></p>
       <p><?php echo count($countCap); ?> <?php plural(count($countCap), 'capítulo', 'capítulos'); ?> | 36 vídeos</p>
      <div class="caption">
        <h2><?php echo reais($livro->valor); ?></h2>
        <p><a href="#" class="btn btn-primary btnComprar" role="button">Comprar</a></p>
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
        <div class="text-center">
        <nav aria-label="...">
  <ul class="pagination">
    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
    ...
  </ul>
</nav>
</div>
    </div>
</section>