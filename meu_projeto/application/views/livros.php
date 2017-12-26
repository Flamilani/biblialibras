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
<!-- Portfolio Grid Section -->
    <div class="container headTop">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h3>Livros e Planos</h3>
              <!--   <hr class="star-primary"> -->
            </div>
        </div>
        <div class="row">
  <div class="col-md-8 front"><h3><?php echo $count_livros; ?> livros</h3>  </div>
<!--   <div class="col-md-4"> 
 <div class="input-group">
     <input type="text" class="form-control" id="livro" placeholder="Busca livro" ng-model="filtro" />
      <span class="input-group-btn">
        <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
      </span>
    </div>
  </div> -->
</div>
        <div class="row">            
     <?php if (!empty($lista_livros)): ?>                    
          <?php foreach ($lista_livros as $livro): ?>
        <?php $rowsVideo = $this->db->query("SELECT * FROM videos WHERE id_livro = '{$livro->id_livro}'"); ?>
                  <?php $countVideo = $rowsVideo->result(); ?>                     
             <div class="col-lg-4 col-md-6 col-sm-4 portfolio-item">
    <div class="thumbnail text-center front">        
                <img src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" class="img-responsive" alt="">
               
                <p><?php echo $livro->titulo; ?></p>
       <p><?php echo $livro->capitulos; ?> <?php plural($livro->capitulos, 'capítulo', 'capítulos'); ?> | <?php echo count($countVideo); ?> <?php plural(count($countVideo), 'vídeo', 'vídeos'); ?></p>
      <div class="caption">
        <h2><?php echo reais($livro->valor); ?></h2>
        <?php if(null != $this->session->userdata('logado')): ?>
          <?php if($this->cart->contents() > 1): ?>
        <p>
<a href="<?php echo base_url('home/livro/' . $livro->id_livro . '/' . clear($livro->titulo)); ?>" class="btn btn-primary btnComprar" role="button">Comprar</a>
        </p>
      <?php else: ?>
        Já foi adicionado no carrinho!
      <?php endif; ?>
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
