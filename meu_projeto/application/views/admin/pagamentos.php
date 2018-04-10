<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"> <i class="fa fa-usd fa-fw"></i> Pagamentos</h3>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O pagamento foi adicionado com sucesso!</div>
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
                           <?php echo $count_pagam; ?> <?php plural($count_pagam, 'Pagamento', 'Pagamentos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Usuário</th>
                                        <th>Forma Pag.</th>
                                        <th>Plano</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                        <th>Status</th>
                                        <th>Comprovante</th>
                                     <!--    <th>Ações</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pagos)): ?>                    
                            <?php foreach ($pagos as $pg): ?>
            <?php $rowsUsers = $this->db->query("SELECT * FROM users WHERE id = {$pg->id_user}"); ?>
            <?php $pUser = $rowsUsers->result(); ?>  
                                <tr class="odd gradeX">                               
                 <td class="text-center">#<?php echo $pg->codigo; ?></td>
                 <td class="text-center">
                  <?php if(isset($pUser[0]->id) && $pUser[0]->id != ''): ?>
                 <a title="Ver Perfil de <?php echo $pUser[0]->nome; ?> <?php echo $pUser[0]->sobrenome; ?>" href="<?php echo base_url('admin/usuarios/perfil/' . $pUser[0]->id); ?>"><?php echo $pUser[0]->nome; ?> (<?php echo zerofill($pUser[0]->id); ?>)</a>
                  <?php else: ?>
                    Sem usuário
                  <?php endif; ?>
               </td>
                      <td class="text-center">   
                       <?php echo tipo_pagam($pg->id_forma_pago); ?>
                      </td>    
                       <td class="text-center"><?php echo $pg->nome_plano; ?><br>
                        (<?php echo $pg->duracao; ?> <?php echo FormPeriodo($pg->periodo); ?>)
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
                   <td class="text-center">  <?php if(isset($pg->comprovante) && $pg->comprovante != null): ?>
        
            <a href="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" rel="shadowbox[<?php echo $pg->id_pago; ?>]" title="Comprovante">
<img class="exibeImg" src="<?php echo base_url('assets/comprovantes/' . $pg->comprovante); ?>" id="img_upload" alt="" />
     </a> 
    <a href="<?php echo base_url('admin/pagamentos/comprovante/' . $pg->id_pago); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Comprovante</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/pagamentos/comprovante/' . $pg->id_pago); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Comprovante</a>
 <?php endif; ?></td>           
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


<script type="text/javascript">



    $(document).ready(function () {

         Shadowbox.init();

          $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/pagamentos/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_pago": id, "status_pago": status},
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