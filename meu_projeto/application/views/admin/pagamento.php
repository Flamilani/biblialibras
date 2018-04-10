<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url('admin/assinaturas'); ?>"> <i class="fa fa-edit fa-fw"></i> Assinaturas</a> > Pagamento do <?php echo $pagos[0]->nome; ?> <?php echo $pagos[0]->sobrenome; ?> (<?php echo $pagos[0]->nome_plano; ?> - <?php echo $pagos[0]->duracao; ?> <?php echo FormPeriodo($pagos[0]->periodo); ?>)</h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O pagamento foi atualizado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O pagamento foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
                      <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">       
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_pago; ?> <?php plural($count_pago, 'Pagamento', 'Pagamentos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Código</th>
                                        <th>Forma Pag.</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Status Pago</th>
                                        <th>Comprovante</th>
                                     <!--    <th>Ações</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pagos)): ?>                    
                            <?php foreach ($pagos as $pg): ?>
      
                                <tr class="odd gradeX">                               
                                    <td class="text-center">#<?php echo $pg->codigo; ?></td>
                                    <td class="text-center">
                                          <?php echo tipo_pagam($pg->id_forma_pago); ?>
                                      </td>
                                       <td class="text-center"><?php echo reais($pg->valor); ?></td>
                                      <td class="text-center">
                                        <b>Registado</b><br>
                                        <?php echo isset($pg->data_pago) && $pg->data_pago != '' ? FormDataHora($pg->data_pago) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?><br><br>
                                        <b>Atualizado</b><br>
                                        <?php echo isset($pg->data_ultimo) && $pg->data_ultimo != '' ? FormDataHora($pg->data_ultimo) : '<span style="font-size: 15px;" class="label label-warning">Sem Data</span>' ?>
                                          
                                        </td>                                        
                                      <td class="text-center">
                                          <?php if(isset($pg->status_pago) && $pg->status_pago == 3): ?>
                                              <span style="font-size: 15px;" class="label label-danger">Cancelado</span>
                                          <?php elseif(isset($pg->status_pago) && $pg->status_pago == 2): ?>
                                              <span style="font-size: 15px;" class="label label-success">Pago</span>
                                          <?php elseif(isset($pg->status_pago) && $pg->status_pago == 1): ?>
                                              <span style="font-size: 15px;" class="label label-warning">Enviado</span>
                                          <?php else: ?>
                                              <span style="font-size: 15px;" class="label label-primary">Aguardando</span>
                                          <?php endif; ?>
                                          <br><br> <a title="Atualizar Status de pagamento" class="btn btn-sm btn-primary" href="<?php echo base_url('admin/assinaturas/alterar_pagamento/' . $pg->id_pago); ?>">
                                              <span class="glyphicon glyphicon-edit"></span></a>
                                      </td>
                                      <td class="text-center">
                <?php if(isset($pg->comprovante) && $pg->comprovante != null): ?>
        <a href="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" rel="shadowbox[<?php echo $pg->id_pago; ?>]" title="Comprovante">
<img class="exibeImg" src="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" id="img_upload" alt="" />
     </a> 
    <a href="<?php echo base_url('admin/pagamentos/comprovante/' . $pg->id_pago); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Comprovante</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/pagamentos/comprovante/' . $pg->id_pago); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Comprovante</a>
 <?php endif; ?>
                                    </td>
                       
                                      <!--  <td class="text-center">
            <a href="<?php echo base_url('admin/assinaturas/alterar_assina/' . $ass->id_assinatura); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/assinaturas/deletar/' . $ass->id_assinatura); ?>" onclick="return confirmarExclusao(<?php echo $ass->id_assinatura; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
                                      </td> -->
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
      
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

<!-- Modal -->
<div class="modal fade" id="modalPago" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Alterar Status de Pagamento</h4>
            </div>
            <div class="modal-body">
                <form></form>
                <form role="form" method="post" class="formulario" action="<?php echo base_url('admin/assinaturas/salvar_pago'); ?>" id="formulario_pago">

                    <?php echo form_label('Status', 'status_pago') ?> <br>
                    <div class="form-group">
                        <select class="form-control" name="status_pago" id="status_pago">
                            <option disabled value="">Selecione</option>
                            <option value="0" <?php if (isset($pagos[0]->status_pago) && $pagos[0]->status_pago == '0') echo 'selected'; ?>>Aguardando</option>
                            <option value="1" <?php if (isset($pagos[0]->status_pago) && $pagos[0]->status_pago == '1') echo 'selected'; ?>>Enviado</option>
                            <option value="2" <?php if (isset($pagos[0]->status_pago) && $pagos[0]->status_pago == '2') echo 'selected'; ?>>Pago</option>
                            <option value="3" <?php if (isset($pagos[0]->status_pago) && $pagos[0]->status_pago == '3') echo 'selected'; ?>>Cancelado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <?php echo form_label('Comentário', 'comentario') ?> <br>
                        <textarea class="form-control" name="mensagem" id="mensagem" cols="10" rows="5"></textarea>
                    </div>
                    <input type="hidden" id="nome" name="nome" value="<?php echo $pagos[0]->nome; ?> <?php echo $pagos[0]->sobrenome; ?>">
                    <input type="hidden" id="email" name="email" value="<?php echo $pagos[0]->email; ?>">
                    <input type="hidden" id="plano" name="plano" value="<?php echo $pagos[0]->nome_plano; ?> - <?php echo $pagos[0]->duracao; ?> <?php echo FormPeriodo($pagos[0]->periodo); ?>">
                    <input type="hidden" name="id_pago" id="id_pago" value="" />
                    <button type="button" class="btn btn-primary" onclick="$('.formulario').submit();">Salvar</button>
                    <span class="loading"><img src="<?php echo base_url('assets/img/load.gif'); ?>" alt="">Carregando...</span>
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

        $('#modalPago').on('show.bs.modal', function (e) {
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

    function carregaDadosJSon(id_pago) {
        $.post(base_url + 'admin/assinaturas/dados_pagamento', {
            id_pago: id_pago
        }, function (data) {
            $('#id_pago').val(data.id_pago);
        }, 'json');

    }

    function modalPago(id_pago) {
        if (id_pago != null) {
            carregaDadosJSon(id_pago);
        }
        $('#modalPago').modal('show');
    }
</script>

<script type="text/javascript">

    $(document).ready(function () {

        Shadowbox.init();

        $('.salvar').click(function() {
           $('.loading').css('display', 'inline-block');
            location.reload();
        });
    
    });

</script>