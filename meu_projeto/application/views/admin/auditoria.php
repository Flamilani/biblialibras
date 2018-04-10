
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"> Logins</h3>          
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>O acesso foi adicionado com sucesso!</div>
    <?php }  ?>
    <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>

    <div class="row">

        <div class="col-lg-12">

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo count($auditoria); ?> <?php plural(count($auditoria), 'Acesso', 'Acessos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Usuário</th>
                                    <th>IP</th>
                                    <th>Data</th>
                                    <th>Descrição</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (!empty($auditoria)): ?>
                                    <?php foreach ($auditoria as $aud): ?>
                                        <tr class="odd gradeX">
                                            <td><?php echo $aud->id_auditoria; ?></td>
                                            <td><?php echo $aud->nome; ?> <?php echo $aud->sobrenome; ?> (<?php echo zerofill($aud->id); ?>)</td>
                                            <td class="text-center"><?php echo $aud->ip; ?></td>
                                            <td class="text-center"><?php echo FormDataHora($aud->data_auditoria); ?></td>
                                            <td class="text-center"><?php echo $aud->descricao; ?></td>
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

    <!-- Uso de Modal-->
    <?php require_once('modal/modal_deletar.php'); ?>
    <!-- Uso de Modal-->

    <script type="text/javascript">
        $(document).ready(function () {
            $('#cep').mask("00000-000");
            $("#data_nasc").mask("00/00/0000");
            $("#input-demo-numero").mask("00000");
            $("#telefone").mask("(00) 0000-0000");
            $("#celular").mask("(00) 00000-0000");
            $("#cpf").mask("000.000.000-00", {reverse: true});
            $("#data_nasc").mask("00/00/0000");


            $(document).on('click', '.status_checks', function ()
            {
                var status = ($(this).hasClass("btn-success")) ? '0' : '1';
                var msg = (status === '0') ? 'Inativo' : 'Ativo';
                if (confirm("Tem certeza que quer alterar para " + msg + "?"))
                {
                    var current_element = $(this);
                    var id = $(current_element).attr('data');
                    url = "<?php echo base_url() . 'admin/usuarios/alterar_user_status' ?>";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {"id": id, "status": status},
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