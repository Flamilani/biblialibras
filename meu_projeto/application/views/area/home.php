
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

     <?php if ($this->session->flashdata('acesso')) { ?>
         <script type="text/javascript">
             $(function () {
                 $.notify(
                     {
                         icon: 'glyphicon glyphicon-warning-sign',
                         title: '<b>Erro:</b>',
                         message: 'Não é permitido acessar'
                     },
                     {
                         type: 'warning'
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
         <?php if ($this->session->flashdata('assinatura')) { ?>
            <script type="text/javascript">
                $(function () {
                    $.notify(
                            {
                                icon: 'glyphicon glyphicon-warning-sign',
                                title: '<b>Erro:</b>',
                                message: 'Ainda não é permitido acessar.'
                            },
                    {
                        type: 'warning'
                    }
                    );
                });
            </script>
        <?php } ?>

<div class="container ladosTela">
  
  <h3 class="tituloCima">Seja Bem-Vindo, <?php echo $this->session->userdata('user')->nome; ?> <?php echo $this->session->userdata('user')->sobrenome; ?></h3>
<?php if(isset($planoCompleto[0]->tipo_plano) && $planoCompleto[0]->tipo_plano == 1): ?>
    <h3>Plano</h3>
        <?php if (!empty($planoCompleto)): ?>
    <?php foreach ($planoCompleto as $item): ?>
     <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$item->id_planos}"); ?>
            <?php $countPLivro = $rowsPlanoLivro->result(); ?>    
                <div class="row display-flex">

<div class="panel panel-primary">
  <div class="panel-heading">
    <h4><?php echo $item->nome_plano; ?> (<?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?>) <div class="pull-right">#<?php echo $item->codigo; ?></div></h4>
  </div>
  <div class="panel-body">  
<div class="row tabelaAssina">
  <div class="col-lg-4 col-md-4 col-sm-4"><b><?php echo $item->nome_plano; ?></b><br> <?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?> | <?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'livro', 'livros') ?></div>
  <div class="col-xs-6 col-sm-4"><b>Data de Registro</b> <br><?php echo FormData($item->data_registro); ?></div>
  <div class="col-xs-6 col-sm-4"><b>Status</b><br>
      <?php if(isset($item->status_pago) && $item->status_pago == 3): ?>
          <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
      <?php elseif(isset($item->status_pago) && $item->status_pago == 2): ?>
          <?php
          $date = $item->data_inicial;
          $date = strtotime($date);
          $new_date = strtotime('+ ' . $item->duracao . ' ' . $item->periodo, $date);
          $data_final = date('Y-m-d', $new_date);

          $diaAtual = strtotime(date('Y-m-d'));
          $intervalo = ($new_date - $date) / 86400;
          ?>
          <span style="font-size: 15px;" class="label label-success">Pago</span>
               <?php elseif(isset($item->status_pago) && $item->status_pago == 1): ?>
          <span style="font-size: 15px;" class="label label-warning">Enviado</span>
      <?php else: ?>
          <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
      <?php endif; ?>
  </div>
</div>
      <?php if(isset($item->status_pago) && $item->status_pago == 2 && $item->data_inicial != null): ?>
    <hr>
<div class="row tabelaAssina">
   <div class="col-xs-6 col-sm-2"><b>Data Inicial</b><br><div style="font-size: 15px;" class="label label-success"><?php echo FormData($item->data_inicial); ?></div></div>
                                  <?php 
                                      $date = $item->data_inicial;
                                      $date = strtotime($date);
                                      $new_date = strtotime('+ ' . $item->duracao . ' ' . $item->periodo, $date);
                                      $data_final = date('Y-m-d', $new_date);

                                    $diaAtual = strtotime(date('Y-m-d'));
                                    $intervalo = ($new_date - $diaAtual) / 86400;
                                    $intervaloFinal = ($new_date - $date) / 86400;

                                  ?>
                                   <?php // echo intval($intervalo) . ' maior que ' . intval($intervaloFinal); ?>
   <div class="col-xs-6 col-sm-2"><b>Data Final</b><br><div style="font-size: 15px;" class="label label-danger"><?php echo FormData($data_final); ?></div></div>
    <div class="col-lg-4 col-md-2 col-sm-4">
       <?php if(intval($intervalo) >= intval($intervaloFinal) + 1): ?>
        <?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?>
        <?php elseif(intval($intervalo) >= 0): ?>
        <?php echo intval($intervalo); ?> dias restantes
        <?php else: ?>
            <span style="font-size: 15px;" class="label label-danger">Expirado</span><br><br>
        <?php echo  time2text(time() - strtotime($data_final)); ?> atrás
        <?php endif; ?>
    </div>

   <div class="col-lg-4 col-md-2 col-sm-4">
      <?php if(intval($intervalo) >= intval($intervaloFinal) + 1): ?>
             <a class="btn btn-warning btn-lg">Aguardando</a>
          <?php elseif(intval($intervalo) >= 0): ?>
             <a href="<?php echo base_url("area/assinatura/" . $item->id_assinatura); ?>" class="btn btn-success btn-lg">Acessar</a>
       <?php else: ?>
             <a href="<?php echo base_url("home/planos"); ?>" class="btn btn-danger btn-lg">Renovar</a>
          <?php endif; ?>
</div>
</div>
      <?php endif; ?>

  </div>
</div>
                    <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info text-center" role="alert"><h3>Não há plano neste momento. <br> <a href="<?php echo base_url("home/planos"); ?>">Assine um plano aqui.</a></h3></div>
<?php endif; ?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h4>Pagamentos <a style="font-size: 16px;" class="label label-success pull-right" href="<?php echo base_url('area/pagamentos'); ?>">Ver Todos</a></h4>
                        </div>
                        <div class="panel-body">  <?php if (!empty($pagos)): ?>
                                <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                    <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->                                      
                                        <th>Código</th>
                                        <th>Comprovante</th>
                                        <th>Status Pago</th>                                      
                                        <th>Plano</th>                                     
                                        <th>Data</th>
                                        <!--    <th>Ações</th> -->
                                    </tr>
                                    </thead>

                                    <tbody>
                                    <?php foreach ($pagosLimit as $pg): ?>

                                        <tr class="odd gradeX">                                           
                                    <td class="text-center">#<?php echo $pg->codigo; ?></td>
                                                     <td class="text-center">
                <?php if(isset($pg->comprovante) && $pg->comprovante != null): ?>
       <a href="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" rel="shadowbox[<?php echo $pg->id_pago; ?>]" title="Clique aqui para ampliar comprovante">
<img class="exibeImg" src="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" id="img_upload" alt="" />
     </a>  
    <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Comprovante</a>
   <?php else: ?>

   <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Comprovante</a>
 <?php endif; ?>
                                    </td>
                                                       <td class="text-center"><br>
                                        <?php if(isset($pg->status_pago) && $pg->status_pago == 3): ?>
                                            <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 2): ?>
                                            <span style="font-size: 15px;" class="label label-success">Pago</span>
                                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 1): ?>
                                            <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                                        <?php else: ?>
                                            <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                                        <?php endif; ?>
                                        <br><br>
                                        <b>Forma de Pagamento</b> <br>
                                        <?php echo tipo_pagam($pg->id_forma_pago); ?>                                    </td>             
                                 <td class="text-center"><?php echo $pg->nome_plano; ?><br> (<?php echo $pg->duracao; ?> <?php echo FormPeriodo($pg->periodo); ?>) <br><br> 
                                 <b>Valor</b><br><?php echo reais($pg->valor); ?></td>
                                                                     
                                      <td class="text-center">
                                       <b>Registrado</b> <br>
                                      <?php echo isset($pg->data_pago) && $pg->data_pago != '' ? FormData($pg->data_pago) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?><br><br>
                                        <b>Atualizado</b> <br>
                                      <?php echo isset($pg->data_ultimo) && $pg->data_ultimo != '' ? FormData($pg->data_ultimo) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?>                         
                                      </td>
                                     
                                    

                                            <!--  <td class="text-center">
            <a href="<?php echo base_url('admin/assinaturas/alterar_assina/' . $ass->id_assinatura); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/assinaturas/deletar/' . $ass->id_assinatura); ?>" onclick="return confirmarExclusao(<?php echo $ass->id_assinatura; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
                                      </td> -->
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>

                                </table>
                            <?php else: ?>
                                <div class="alert alert-info text-center" role="alert"><h3>Não há pagamentos. <br> <a href="<?php echo base_url("home/pagamento"); ?>">Confere aqui.</a></h3></div>
                            <?php endif; ?>
                        </div>
                    </div>

<?php else: ?>
                    <h3>Planos</h3>
                    <?php if (!empty($planoAlternativo)): ?>
                    <?php foreach ($planoAlternativo as $item): ?>
                    <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$item->id_planos}"); ?>
                    <?php $countPLivro = $rowsPlanoLivro->result(); ?>
                    <div class="row display-flex">

                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4><?php echo $item->nome_plano; ?> (<?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?>) <div class="pull-right">#<?php echo $item->codigo; ?></div></h4>
                            </div>
                            <div class="panel-body">
                                <div class="row tabelaAssina">
                                    <div class="col-lg-4 col-md-4 col-sm-4"><b><?php echo $item->nome_plano; ?></b><br> <?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?> | <?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'livro', 'livros') ?></div>
                                    <div class="col-xs-6 col-sm-4"><b>Data de Registro</b> <br><?php echo FormData($item->data_registro); ?></div>
                                    <div class="col-xs-6 col-sm-4"><b>Status</b><br>
                                        <?php if(isset($item->status_pago) && $item->status_pago == 3): ?>
                                            <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                                        <?php elseif(isset($item->status_pago) && $item->status_pago == 2): ?>
                                            <?php
                                            $date = $item->data_inicial;
                                            $date = strtotime($date);
                                            $new_date = strtotime('+ ' . $item->duracao . ' ' . $item->periodo, $date);
                                            $data_final = date('Y-m-d', $new_date);

                                            $diaAtual = strtotime(date('Y-m-d'));
                                            $intervalo = ($new_date - $diaAtual) / 86400;
                                            ?>
                                                <span style="font-size: 15px;" class="label label-success">Pago</span>
                                             <?php elseif(isset($item->status_pago) && $item->status_pago == 1): ?>
                                            <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                                        <?php else: ?>
                                            <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if(isset($item->status_pago) && $item->status_pago == 2 && $item->data_inicial != null): ?>
                                    <hr>
                                    <div class="row tabelaAssina">
                                        <div class="col-xs-6 col-sm-2"><b>Data Inicial</b><br><div style="font-size: 15px;" class="label label-success"><?php echo FormData($item->data_inicial); ?></div></div>
                                        <?php
                                        $date = $item->data_inicial;
                                        $date = strtotime($date);
                                        $new_date = strtotime('+ ' . $item->duracao . ' ' . $item->periodo, $date);
                                        $data_final = date('Y-m-d', $new_date);

                                        $diaAtual = strtotime(date('Y-m-d'));
                                        $intervalo = ($new_date - $diaAtual) / 86400;
                                        $intervaloFinal = ($new_date - $date) / 86400;

                                        ?>
                                        <div class="col-xs-6 col-sm-2"><b>Data Final</b><br><div style="font-size: 15px;" class="label label-danger"><?php echo FormData($data_final); ?></div></div>
                                        <div class="col-lg-4 col-md-2 col-sm-4">
                                          <?php // echo intval($intervalo) . ' maior que ' . intval($intervaloFinal); ?>
                 <?php if(intval($intervalo) >= intval($intervaloFinal) + 1): ?>
       <p><?php echo $item->duracao; ?> <?php echo FormPeriodo($item->periodo); ?></p> 
        <?php elseif(intval($intervalo) >= 0): ?>
                     <?php echo intval($intervalo); ?> dias restantes
                                            <?php else: ?>
                                                <span style="font-size: 15px;" class="label label-danger">Expirado</span> <br /><br />
                                                <?php echo time2text(time() - strtotime($data_final)); ?> atrás
                                            <?php endif; ?>
                                        </div>

                              <div class="col-lg-4 col-md-2 col-sm-4">                            
                                           <?php if(intval($intervalo) >= intval($intervaloFinal) + 1): ?>
                                              <a class="btn btn-warning btn-lg">Aguardando</a>
                                            <?php elseif(intval($intervalo) >= 0): ?>
                                                <a href="<?php echo base_url("area/assinatura/" . $item->id_assinatura); ?>" class="btn btn-success btn-lg">Acessar</a>
                                            <?php else: ?>
                                                <a href="<?php echo base_url("home/planos"); ?>" class="btn btn-danger btn-lg">Renovar</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    
                                <?php endif; ?>

                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="alert alert-info text-center" role="alert"><h3>Não há planos neste nomento. <br /><a href="<?php echo base_url("home/planos"); ?>">Assine um plano aqui.</a></h3></div>
                        <?php endif; ?>

   <div class="panel panel-success">
  <div class="panel-heading">
        <h4>Pagamentos <a style="font-size: 16px;" class="label label-success pull-right" href="<?php echo base_url('area/pagamentos'); ?>">Ver Todos</a></h4>
  </div>
  <div class="panel-body">  <?php if (!empty($pagos)): ?>
      <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->                                       
                                        <th>Código</th>
                                        <th>Comprovante</th>
                                        <th>Status Pago</th>                                        
                                        <th>Plano</th>                                     
                                        <th>Data</th>
                                     <!--    <th>Ações</th> -->
                                    </tr>
                                </thead>

          <tbody>
                            <?php foreach ($pagos as $pg): ?>
      
                                <tr class="odd gradeX">                               
                        <td class="text-center">#<?php echo $pg->codigo; ?></td>
                                                     <td class="text-center">
                <?php if(isset($pg->comprovante) && $pg->comprovante != null): ?>
       <a href="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" rel="shadowbox[<?php echo $pg->id_pago; ?>]" title="Clique aqui para ampliar comprovante">
<img class="exibeImg" src="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" id="img_upload" alt="" />
     </a>  
    <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Comprovante</a>
   <?php else: ?>

   <a href="<?php echo base_url('area/comprovante/' . $pg->id_plano); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Comprovante</a>
 <?php endif; ?>
                                    </td>
                                                       <td class="text-center"><br>
                                        <?php if(isset($pg->status_pago) && $pg->status_pago == 3): ?>
                                            <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 2): ?>
                                            <span style="font-size: 15px;" class="label label-success">Pago</span>
                                        <?php elseif(isset($pg->status_pago) && $pg->status_pago == 1): ?>
                                            <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                                        <?php else: ?>
                                            <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                                        <?php endif; ?>
                                        <br><br>
                                        <b>Forma de Pagamento</b> <br>
                                        <?php echo tipo_pagam($pg->id_forma_pago); ?>                                    </td>             
                                 <td class="text-center"><?php echo $pg->nome_plano; ?><br> (<?php echo $pg->duracao; ?> <?php echo FormPeriodo($pg->periodo); ?>) <br><br> 
                                 <b>Valor</b><br><?php echo reais($pg->valor); ?></td>
                                                                     
                                      <td class="text-center">
                                        <b>Registrado</b> <br>
                                      <?php echo isset($pg->data_pago) && $pg->data_pago != '' ? FormData($pg->data_pago) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?><br><br>
                                        <b>Atualizado</b> <br>
                                      <?php echo isset($pg->data_ultimo) && $pg->data_ultimo != '' ? FormData($pg->data_ultimo) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?>                         
                                      </td>
                          
                       
                                       <!--  <td class="text-center">
            <a href="<?php echo base_url('admin/assinaturas/alterar_assina/' . $ass->id_assinatura); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/assinaturas/deletar/' . $ass->id_assinatura); ?>" onclick="return confirmarExclusao(<?php echo $ass->id_assinatura; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
                                      </td> -->
                                    </tr>   
                                         <?php endforeach; ?>

                                   </tbody>

      </table>
      <?php else: ?>
          <div class="alert alert-info text-center" role="alert"><h3>Não há pagamentos. <br> <a href="<?php echo base_url("home/pagamento"); ?>">Confere aqui.</a></h3></div>
      <?php endif; ?>
  </div>
</div>
    </div>

    <?php endif; ?>

</div>


  <script type="text/javascript">
        $(document).ready(function () {

            Shadowbox.init();

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
