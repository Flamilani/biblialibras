<div id="page-wrapper">
         
 <?php echo $this->session->userdata('nome'); ?>
                <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit fa-fw"></i> Assinaturas</h3>                 

                </div>
                <!-- /.col-lg-12 -->
            </div>
                    
            
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A assinatura foi atualizada com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar_assinatura')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A assinatura foi deletada com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Assinatura</button>
                        </div>
                        <div class="panel-body caixa_livro">  
     <?php $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open('admin/assinaturas/gravarAssinatura', 'role="form"'); ?>
                             <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Usuário', 'usuario'); ?>
                              <select class="form-control" name="id_user" id="id_user">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      foreach ($users_ativos as $user): ?>
                    <option value="<?php echo $user->id; ?>"><?php echo $user->nome; ?> <?php echo $user->sobrenome; ?> (<?php echo zerofill($user->id); ?>)</option>
                                       <?php endforeach; ?>
                                        </select>
                               </div>
                           </div>                           
                                 <div class="col-md-6"> 
                                <div class="form-group">
                                          <?php echo form_label('Plano', 'plano'); ?>
                                             <select class="form-control" name="id_plano" id="id_plano">
                                   <option value="0">Selecione</option>
                                   <option value="800"> &asymp; Livre</option>    
                                   <?php foreach ($planos as $pls): ?>
                                   <?php if($pls->id_planos == 0): ?>             
                    <option value="<?php echo $pls->id_planos; ?>"><b><?php echo $pls->nome_plano; ?></b></option>
                                  <?php else: ?>
                                    <option value="<?php echo $pls->id_planos; ?>" disabled><b><?php echo $pls->nome_plano; ?></b></option>
                                  <?php endif; ?>
    <?php $rowsPlano = $this->db->query("SELECT * FROM plano WHERE status = 1 AND id_planos = {$pls->id_planos}"); ?>   
            <?php $selPl = $rowsPlano->result(); ?>                  
            <?php foreach ($selPl as $pl): ?>   
    <option value="<?php echo $pl->id_plano; ?>"> &raquo; <?php echo $pl->duracao; ?> <?php echo FormPeriodo($pl->periodo); ?> (<?php echo reais($pl->valor); ?>) </option>
             <?php endforeach; ?>    
                                       <?php endforeach; ?>
                                        </select>                                
                                        </div>     
                                    </div>
                            </div>                    
                               
                       
       <?php echo form_submit($buttonPubl); ?>
       <?php echo form_submit($button); ?>
      <?php form_close(); ?>          
                                                      
                           
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

              <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
          <span style="text-align: center; font-size: 18px;" class="label label-success">Valor Total</span> <span style="margin-left: 10px; font-size: 18px;"> <?php echo reais($valor[0]->total); ?></span><br><br>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_assinaturas; ?> <?php plural($count_assinaturas, 'Assinatura', 'Assinaturas') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->                                       
                                        <th>Cód.</th>
                                        <th>Usuário</th>
                                        <th>Plano</th>
                                        <th>Valor</th>
                                        <th>Registro</th>
                                        <th>Pagamento</th>
                                        <th>Data Inicial</th>
                                        <th>Data Final</th>
                                        <th>Dias</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($assinaturas)): ?>                    
                            <?php foreach ($assinaturas as $ass): ?>
      <?php $rowsUsers = $this->db->query("SELECT * FROM users WHERE id = {$ass->id_user}"); ?>   
            <?php $pUser = $rowsUsers->result(); ?>  
                                <tr class="odd gradeX">                             
                                        <td class="text-center"> #<?php echo $ass->codigo; ?></td>
                                        <td class="text-center">
                     <input type="hidden" value="<?php echo $ass->id_assinatura; ?>" />
                      <?php if(isset($pUser[0]->id) && $pUser[0]->id != ''): ?>
                     <a title="Ver Perfil de <?php echo $pUser[0]->nome; ?> <?php echo $pUser[0]->sobrenome; ?>" href="<?php echo base_url('admin/usuarios/perfil/' . $pUser[0]->id); ?>"><?php echo $pUser[0]->nome; ?> (<?php echo zerofill($pUser[0]->id); ?>)</a>
                      <?php else: ?>
                    Sem usuário
                  <?php endif; ?>
                                        </td>
                                       <td class="text-center">   
              <?php echo $ass->nome_plano; ?> <br>  (<?php echo $ass->duracao; ?> <?php echo FormPeriodo($ass->periodo); ?>)                                   
                                      </td>    
                                       <td class="text-center"><?php echo reais($ass->valor); ?>
                                          
                                       </td>
                                      <td class="text-center"><?php echo FormData($ass->data_registro); ?> <br />
                                          <?php echo FormHora($ass->data_registro); ?>
                                      </td>
                                            
                                      <td class="text-center">
<?php $rowsPag = $this->db->query("SELECT * FROM pagamentos pg INNER JOIN plano p ON p.id_plano = pg.id_plano INNER JOIN assinaturas a ON a.id_plano = p.id_plano INNER JOIN users u ON u.id = pg.id_user WHERE a.codigo = {$ass->codigo}"); ?>
            <?php $pago = $rowsPag->result(); ?>
                               <?php if(isset($ass->status_pago) && $ass->status_pago == 3): ?>
                                          <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                            <?php elseif(isset($ass->status_pago) && $ass->status_pago == 2): ?>
                                   <?php
                                   $date = $ass->data_inicial;
                                   $date = strtotime($date);
                                   $new_date = strtotime('+ ' . $ass->duracao . ' ' . $ass->periodo, $date);
                                   $data_final = date('Y-m-d', $new_date);

                                   $diaAtual = strtotime(date('Y-m-d'));
                                   $intervalo = ($new_date - $diaAtual) / 86400;
                                   ?>
                                   <span style="font-size: 15px;" class="label label-success">Pago</span>
                                  <?php elseif(isset($ass->status_pago) && $ass->status_pago == 1): ?>
                                      <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                                       <?php else: ?>
                                          <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                                          <?php endif; ?>
                                 <?php if(isset($pUser[0]->nome) && $pUser[0]->nome != ''): ?>
                              <br><br><a class="btn btn-primary btn-sm" href="<?php echo base_url('admin/assinaturas/pagamento/' . $pago[0]->codigo); ?>"><span class="glyphicon glyphicon-eye-open"></span></a>
                                  <?php else: ?>
                   
                  <?php endif; ?>
                                  </td> 
                                   <td class="text-center">
                          <?php if(isset($ass->data_inicial) && $ass->data_inicial == '' || $ass->data_inicial == null): ?> 
                          
                                    <span style="font-size: 15px;" class="label label-warning">Sem Data</span>  <br><br>
                              <a class="btn btn-sm btn-primary" href="javascript:;" onclick="modalData(<?php echo $ass->id_assinatura; ?>)">
                        <span class="glyphicon glyphicon-calendar"></span></a> 
                                  <?php else: ?>                                  
                                                            
                            <span style="font-size: 15px;" class="label label-success"><?php echo FormData($ass->data_inicial); ?></span> <br><br>
                            <a class="btn btn-sm btn-primary" href="javascript:;" onclick="modalData(<?php echo $ass->id_assinatura; ?>)">
                        <span class="glyphicon glyphicon-calendar"></span></a>
                                  <?php endif; ?>                      
                                     </td>
                                  <td class="text-center">
                                        <?php if(isset($ass->data_inicial) && $ass->data_inicial == '' || $ass->data_inicial == null): ?> 
                                    <span style="font-size: 15px;" class="label label-warning">Sem Data</span>
                                  <?php else: ?>
                                      <?php 
                                      $date = $ass->data_inicial;
                                      $date = strtotime($date);
                                      $new_date = strtotime('+ ' . $ass->duracao . ' ' . $ass->periodo, $date);
                                      $data_final = date('Y-m-d', $new_date);

                                            $diaAtual = strtotime(date('Y-m-d'));
                                            $intervalo = ($new_date - $diaAtual) / 86400;
                                     ?>
                           <span style="font-size: 15px;" class="label label-danger"><?php echo FormData($data_final); ?></span>
                           <?php endif; ?>     
                                    </td>
                                   <td class="text-center">
                                       <?php if(isset($ass->data_inicial) && $ass->data_inicial == '' || $ass->data_inicial == null): ?>
                                           Sem dias restantes
                                       <?php else: ?>
             <?php if(intval($intervalo) >= $ass->duracao + 1): ?>
        <?php echo $ass->duracao; ?> <?php echo FormPeriodo($ass->periodo); ?>
        <?php elseif(intval($intervalo) > 0): ?>
                                               <?php echo intval($intervalo); ?> <br>dias restantes
                                           <?php else: ?>
                                               <span style="font-size: 15px;" class="label label-danger">Expirado</span><br /><br />
                                               <?php echo  time2text(time() - strtotime($data_final)); ?> atrás
                                           <?php endif; ?>
                                       <?php endif; ?>
<!--                                          <b data="<?php /*echo $ass->id_assinatura; */?>" class="status_checks btn btn-sm <?php /*echo ($ass->status_assina) ? 'btn-success' : 'btn-warning' */?>"><?php /*echo ($ass->status_assina) ? '<span title="Ativo" class="glyphicon glyphicon-ok"></span>' : '<span title="Inativo" class="glyphicon glyphicon-minus"></span>' */?></b>
-->                                          </td>
                                        <td class="text-center">
<!--            <a href="<?php /*echo base_url('admin/assinaturas/alterar_assinatura/' . $ass->id_assinatura); */?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>-->

  <a href="<?php echo base_url('admin/assinaturas/deletar_assinatura/' . $ass->codigo); ?>" onclick="return confirmarExclusao(<?php echo $ass->id_assinatura; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
                                      </td>
                                    </tr>   
                                         <?php endforeach; ?>
                                      <?php endif; ?>                
                                   </tbody>
                            </table>
                             </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

  <!-- Modal -->
  <div class="modal fade" id="modalData" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inserir Data Inicial</h4>
        </div>
        <div class="modal-body">
            <form></form>
          <form role="form" method="post" class="formulario" action="<?php echo base_url('admin/assinaturas/salvar'); ?>" id="formulario_assinatura">
         
  <?php echo form_label('Data Inicial', 'data_inicial') ?> <br>
          <div class="form-group">
          <input type="date" id="data_inicial" name="data_inicial" required="required" />
    </div>
                                     <input type="hidden" name="id_assinatura" id="id_assinatura" value="" />                                  
                         <button type="button" class="btn btn-primary" onclick="$('.formulario').submit();">Salvar</button>
                                 </form>
                                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>

  <script>
       $(function() {

                  
          //$("#data_inicial").mask("00/00/0000");

                $('#modalData').on('show.bs.modal', function (e) {
                    $('.formulario').resetForm();
                });
                        
                $('.formulario').ajaxForm({
                    success: function (data) {
                        if (data == 1) {
                          document.location.href = document.location.href;

                        }
                    }
                });
            });

     var base_url = "<?php echo base_url(); ?>";
    
      function carregaDadosJSon(id_assinatura) {      
                $.post(base_url + 'admin/assinaturas/dados_assinatura', {
                    id_assinatura: id_assinatura
                }, function (data) {
                    $('#id_assinatura').val(data.id_assinatura);
                }, 'json');
            }

   function modalData(id_assinatura) {             
                 if (id_assinatura != null) {                
                    carregaDadosJSon(id_assinatura);
                }
                $('#modalData').modal('show');
            }
  </script>
<script type="text/javascript">

    $(document).ready(function () {

          $(document).on('click', '.status_checks', function ()
           {  
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/assinaturas/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_assinatura": id, "status": status},
                success: function (data) {
                    location.reload();
                }});
        }
    });

           var base_url = "<?= base_url(); ?>";
    
    $(function () {
        $('.confirma_exclusao').on('click', function (e) {
            e.preventDefault();

            var nome = $(this).data('nome');
            var id = $(this).data('id');

            $('#modal_confirmation').data('nome', nome);
            $('#modal_confirmation').data('id', id);
            $('#modal_confirmation').modal('show');
        });

        $('#modal_confirmation').on('show.bs.modal', function () {
            var nome = $(this).data('nome');
            $('#nome_exclusao').text(nome);
            var id = $(this).data('id');
            $('#id_exclusao').text(id);
        });

        $('#btn_excluir').click(function () {
            var id = $('#modal_confirmation').data('id');
            document.location.href = base_url + "admin/posts/deletar/" + id;
        });
    });
        
          $('.tabela1').DataTable({
            language: {
                processing: "Processando",
                search: "Pesquisa",
                lengthMenu: "Exibindo _MENU_ registros",
                info: "Exibição de registro _START_ a _END_ em _TOTAL_ registros",
                infoEmpty: "Exibição de registros 0 &agrave; 0 em 0 registros",
                infoFiltered: "(Filtrado de _MAX_ registros em total)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro a exibir.",
                emptyTable: "Não há registros disponíveis na tabela",
                paginate: {
                    first: "<<",
                    previous: "<",
                    next: ">",
                    last: ">>"
                },
                aria: {
                    sortAscending: ": Permite classificar a coluna em ordem crescente",
                    sortDescending: ": Permite classificar a coluna em ordem decrescente"
                }
            }
        });
    });

</script>