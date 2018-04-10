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
  <h3>Meus Livros (<?php echo count($lista_livros); ?>)</h3>
</div>
    <div class="row display-flex">

  <div class="tabAssinatura">
   <table class="table">    
   <tbody>
    <?php if (!empty($lista_livros)): ?>      
     <?php foreach ($lista_livros as $livro): ?>   
          <?php $user = $this->session->userdata('user')->id; ?>

                     <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = {$livro->id_livro} AND id_user = {$user}"); ?>
            <?php $countHist = $rowsHist->result(); ?>      

    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = {$livro->id_livro} AND status = 1"); ?>   
            <?php $countCap = $rowsCap->result(); ?>  
  <?php // date_add(data_inicial, INTERVAL 1 YEAR) AS data_final ?>
   <?php $rowsAcess = $this->db->query("SELECT * FROM acesso_livro WHERE id_livro = {$livro->id_livro} AND id_user = {$user}"); ?>   
            <?php $acesso = $rowsAcess->result(); ?>  
    <tr> 
     <td class="col-sm-4"> <?php echo (isset($livro->imagem) && $livro->imagem != '' && $livro->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $livro->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>     
     </td> 
     <td class="col-sm-6 text-center">  
       <h2><?php echo $livro->titulo; ?></h2><hr>
      <?php if(count($countCap) > 0): ?>                
                    <h3 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h3>
                    <div class="progress">
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
<?php if(isset($acesso[0]->status_acesso) && $acesso[0]->status_acesso == 1): ?>
<a href="<?php echo base_url('area/livro/' . $livro->id_livro . '/' . $countCap[0]->id_video); ?>" class="btn btn-primary" role="button">Assistir</a> 
<?php else: ?>
<?php $user = $this->session->userdata('user')->id; ?>
    <?php $iniciar = array('name' => 'btn_iniciar', 'id' => 'btn_iniciar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Iniciar');  ?>
  <?php echo form_open('area/iniciar', 'role="form"') . form_hidden('id_livro', $livro->id_livro) . form_hidden('id_user', $user) . form_hidden('id_video', $countCap[0]->id_video); ?>
            <?php echo form_submit($iniciar); ?>
            <?php form_close(); ?>              
  <?php endif; ?> 
<?php else: ?>
   <h5><div class="alert alert-warning" role="alert">Em construção</div></h5>
<?php endif; ?>
</td> 
    </tr>   
<?php endforeach; ?>
<?php endif; ?>
    </tbody> 
  </table> 
</div>


           <?php if (!empty($lista_livros)): ?>                    
           <?php foreach ($lista_livros as $livro): ?>
        <div class="col-xs-12 col-sm-4 col-md-4">
            <div class="thumbnail text-center">
              <?php echo (isset($livro->imagem) && $livro->imagem != '' && $livro->imagem != null) ? "<img src='" . base_url('assets/uploads/' . $livro->imagem) . "' class='img-responsive' alt=''>" : "<img src='" . base_url('assets/img/padrao_imagem.png') . "' class='img-responsive' alt=''>"; ?>     
                <div class="caption">
                  <?php $user = $this->session->userdata('user')->id; ?>

                     <?php $rowsHist = $this->db->query("SELECT * FROM historico_livro WHERE id_livro = {$livro->livro_id} AND id_user = {$user}"); ?>
            <?php $countHist = $rowsHist->result(); ?>      

    <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = {$livro->livro_id} AND status = 1"); ?>   
            <?php $countCap = $rowsCap->result(); ?>  
  <?php // date_add(data_inicial, INTERVAL 1 YEAR) AS data_final ?>
   <?php $rowsAcess = $this->db->query("SELECT * FROM acesso_livro WHERE id_livro = {$livro->livro_id} AND id_user = {$user}"); ?>   
            <?php $acesso = $rowsAcess->result(); ?>  

               <?php $rowsPedido = $this->db->query("SELECT * FROM pedidos WHERE id_user = {$user}"); ?>   
            <?php $pedido = $rowsPedido->result(); ?>  

                    <h4><?php echo $livro->titulo; ?></h4><hr>
                    <?php foreach ($pedido as $ped): ?>
                    <?php if(isset($ped->status) && $ped->status == 1): ?>                  
                    <h6 class="text-center">Seu Progresso ( <?php echo count($countHist); ?> /
                    <?php echo count($countCap); ?> )</h6>
                    <div class="progress">
 
  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo porcento(count($countHist), count($countCap)); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo porcento(count($countHist), count($countCap)); ?>%;">
     <?php echo substr(porcento(count($countHist), count($countCap)),0,5); ?>%
  </div>
</div>
<?php if(isset($acesso[0]->status_acesso) && $acesso[0]->status_acesso == 2): ?>
  <h4><div class="label label-success">Inicial: <?php echo FormDataP($acesso[0]->data_inicial); ?></div> <div class="label label-danger">Final: <?php echo FormDataP($acesso[0]->data_final); ?></div></h4>
<a href="<?php echo base_url('area/renovar/' . $livro->livro_id . '/' . $countCap[0]->id_video); ?>" class="btn btn-danger" role="button">Renovar</a> 
<?php elseif(isset($acesso[0]->status_acesso) && $acesso[0]->status_acesso == 1): ?>
  <h4><div class="label label-success">Inicial: <?php echo FormDataP($acesso[0]->data_inicial); ?></div> <div class="label label-danger">Final: <?php echo FormDataP($acesso[0]->data_final); ?></div></h4>
<a href="<?php echo base_url('area/livro/' . $livro->livro_id . '/' . $countCap[0]->id_video); ?>" class="btn btn-primary" role="button">Assistir</a> 
<?php else: ?>
<?php $user = $this->session->userdata('user')->id; ?>
    <?php $iniciar = array('name' => 'btn_iniciar', 'id' => 'btn_iniciar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Iniciar');  ?>
  <?php echo form_open('area/iniciar', 'role="form"') . form_hidden('id_livro', $livro->livro_id) . form_hidden('id_user', $user) . form_hidden('id_video', $countCap[0]->id_video); ?>
            <?php echo form_submit($iniciar); ?>
            <?php form_close(); ?>              
  <?php endif; ?> 
                     <?php else: ?>
  <h5><div class="alert alert-warning" role="alert">Aguardando o pagamento</div></h5><br>    
   <?php endif; ?>  
   <?php endforeach; ?>   
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

  <script type="text/javascript">
        $(document).ready(function () {
             $(document).on('click', '.iniciar_livro', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';

            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/livros/iniciar_livro' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_livro": id, "status": status},
                success: function (data) {
                    location.reload();
                }});        
    });
        });
  </script>