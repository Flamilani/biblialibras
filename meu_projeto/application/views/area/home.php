 <?php if ($this->session->flashdata('success')) { ?>
            <script type="text/javascript">
                $(function () {
                    $.notify(
                            {
                                icon: 'glyphicon glyphicon-success-sign',
                                title: '<b>Sucesso:</b>',
                                message: 'Logado com sucesso.'
                            },
                    {
                        type: 'success'
                    }
                    );
                });
            </script>
        <?php } ?>   

         <?php if ($this->session->flashdata('error')) { ?>
            <script type="text/javascript">
                $(function () {
                    $.notify(
                            {
                                icon: 'glyphicon glyphicon-warning-sign',
                                title: '<b>Erro:</b>',
                                message: 'Ainda não liberou por falta de pagamento.'
                            },
                    {
                        type: 'warning'
                    }
                    );
                });
            </script>
        <?php } ?>   
    	
<div class="container ladosTela">
   <div class="front">
  <h2>Meus Livros (<?php echo $count_livros; ?>)</h2>
</div>
    <div class="row display-flex">
           <?php if (!empty($lista_livros)): ?>                    
           <?php foreach ($lista_livros as $livro): ?>
        <div class="col-xs-18 col-sm-6 col-md-3">
            <div class="thumbnail">
               <img src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" class="img-responsive" alt="">
                <div class="caption">
                    <?php echo $livro->id_livro; ?>
                  <?php $user = $this->session->userdata('user')->id; ?>
                     <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = {$livro->id_item} AND id_user = {$user}"); ?>
            <?php $countHist = $rowsHist->result(); ?>            
    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = {$livro->id_item} AND status = 1"); ?>
            <?php $countCap = $rowsCap->result(); ?>     
                    <h4><?php echo $livro->titulo; ?></h4>
                    <p><?php echo $livro->conteudo; ?></p><hr>
                    <h6 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h6>
                    <div class="progress">
                     
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div><a href="<?php echo base_url('area/livro' . '/' . $livro->id_item . '/' . $countCap[0]->id_video); ?>" class="btn btn-primary" role="button">Assistir</a>                 
                </div>
            </div>
        </div>     
 <?php endforeach; ?>
<?php else: ?>
  <div class="alert alert-info areaUser" role="alert">Não há livros escolhidos. <br> 
    <a href="<?php echo base_url('home/livros'); ?>">Comprar livros</a></div>
 <?php endif; ?>       
    </div>
</div>

  