<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Pedidos</h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O pedido foi adicionado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O pedido foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">
              <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_pedidos; ?> <?php plural($count_pedidos, 'Pedido', 'Pedidos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Usuário</th>
                                        <th>Itens</th>
                                        <th>Valor Total</th>
                                        <th>Data Pedido</th>
                                        <th>Pago</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pedidos)): ?>                    
                            <?php foreach ($pedidos as $pedido): ?>
 <?php $rows = $this->db->query("SELECT * FROM itens_pedidos WHERE id_pedido = {$pedido->id_pedido}"); ?>
                     <?php $count = $rows->result(); ?>
                                <tr class="odd gradeX">
                                <td><?php echo $pedido->id_pedido; ?><?php echo form_hidden($pedido->id_pedido); ?></td>                                                 
                                        <td><?php echo $pedido->nome; ?> ( <?php echo zerofill($pedido->id); ?> )
                                          <a title="Ver Perfil de <?php echo $pedido->nome; ?> <?php echo $pedido->sobrenome; ?>" class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('admin/usuarios/perfil/' . $pedido->id); ?>"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                                        <td class="text-center">                         
    <a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/pedidos/itens/' . $pedido->id_pedido); ?>"><?php echo count($count); ?> itens</a>
                                          </td>
                                        <td class="text-center"><?php echo reais($pedido->produtos); ?></td>      
                                        <td class="text-center"><?php echo FormData($pedido->data_pedido); ?></td>
                                        <td class="text-center"><?php echo $pedido->id_pago; ?></td> 
                                            <td class="text-center">
       <b data="<?php echo $pedido->id_pedido; ?>" class="status_checks btn btn-sm <?php echo ($pedido->status_pedido) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($pedido->status_pedido) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
           <!--  <a href="<?php echo base_url('admin/pedidos/alterar/' . $pedido->id_pedido); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a> -->

  <a href="<?php echo base_url('admin/pedidos/deletar/' . $pedido->id_pedido); ?>" onclick="return confirmarExclusao(<?php echo $pedido->id_pedido; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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

<script type="text/javascript">
    $(document).ready(function () {

    $('#valor').mask('0000,00', {reverse: true});

      $("#capitulos").mask("00");

        $(document).on('click', '.status_checks', function ()
           {
           var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/pedidos/alterar_pedido_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_pedido": id, "status": status},
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