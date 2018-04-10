<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Relatos de Erros</h3>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>O relato foi adicionado com sucesso!</div>
    <?php } else if($this->session->flashdata('deletar')) { ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>O relato foi deletado com sucesso!</div>
    <?php } else if($this->session->flashdata('atualizar')) { ?>
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>O relato foi atualizado com sucesso!</div>
    <?php } ?>
    <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <button class="btn btn-info" id="cadastro_livro">Inserir Relato</button>
                </div>
                <div class="panel-body caixa_livro">
                    <?php
                    $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');
                    $link = array('name' => 'link', 'id' => 'link', 'type' => 'url', 'value' => set_value('link'), 'class' => 'form-control', 'placeholder' => 'Link');
                    $conteudo = array('name' => 'editor1', 'type' => 'text', 'id' => 'editor1', 'value' => set_value('editor1'), 'class' => 'form-control', 'rows' => '3');
                    $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Inserir'); ?>

                    <?php echo form_open_multipart('admin/relato/gravarRelato', 'role="form"'); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Título', 'titulo') . form_input($titulo); ?>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo form_label('Tipo', 'tipo'); ?>
                                <select class="form-control" name="tipo" id="tipo">
                                    <option value="0">Selecione</option>
                                    <option value="1">Novo </option>
                                    <option value="2">Mudança</option>
                                    <option value="3">Erro de Código</option>
                                    <option value="4">Falha de Sistema</option>
                                    <option value="5">Defeito</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo form_label('Nível', 'nivel'); ?>
                                <select class="form-control" name="nivel" id="nivel">
                                    <option value="0">Selecione</option>
                                    <option value="1">Leve</option>
                                    <option value="2">Normal</option>
                                    <option value="3">Grave</option>
                                    <option value="4">Urgente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Imagem', 'imagem') ?>
                                <input name="userfile" class="form-control" type="file" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Link', 'link') . form_input($link); ?>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo form_label('Status', 'status'); ?>
                                <select class="form-control" name="status" id="status">
                                    <option value="0">Dependente</option>
                                    <option value="1">Resolvido</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="form-group">
                                <?php echo form_label('Descrição', 'descricao') . form_textarea($conteudo); ?>
                            </div>
                        </div>
                    </div>
                    <?php echo form_submit($buttonPubl); ?>
                    <?php form_close(); ?>


                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

        <!-- /.row -->
        <h2 class="text-center"><span class="label label-success"> <?php echo $count_resolvidos; ?> <?php plural($count_resolvidos, 'Resolvido', 'Resolvidos') ?></span>
            <span class="label label-warning">   <?php echo $count_dependentes; ?> <?php plural($count_dependentes, 'Dependente', 'Dependentes') ?></span>
        </h2><br>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php echo $count_relatos; ?> <?php plural($count_relatos, 'Relato', 'Relatos') ?>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                            <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th>ID</th>
                                <th>Título</th>
                                <th>Descrição</th>
                                <th>Imagem</th>
                                <th>Link</th>
                                <th>Tipo</th>
                                <th>Nível</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if (!empty($relatos)): ?>
                                <?php foreach ($relatos as $relato): ?>
                                    <tr class="odd gradeX">
                                        <td class="text-center"><?php echo $relato->id_relato; ?><?php echo form_hidden($relato->id_relato); ?></td>
                                        <td><?php echo $relato->titulo; ?></td>
                                        <td class="text-center">
                                            <?php echo $relato->conteudo; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if(isset($relato->imagem) && $relato->imagem != null): ?>
                                            <a href="<?php echo base_url('assets/relatos/' . $relato->imagem); ?>" rel="shadowbox[<?php echo $relato->id_relato; ?>]" title="Relato">
                                            <img class="exibeImg" src="<?php echo base_url('assets/relatos/' . $relato->imagem); ?>" id="img_upload" alt="" />
                                            </a>
                                                <a href="<?php echo base_url('admin/relato/alterar_imagem/' . $relato->id_relato); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Imagem</a>
                                            <?php else: ?>
                                                <a href="<?php echo base_url('admin/relato/alterar_imagem/' . $relato->id_relato); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Imagem</a>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $relato->link; ?>

                                        </td>
                                        <td class="text-center">
                                            <?php echo FormTipo($relato->tipo); ?>

                                        </td>
                                        <td class="text-center">
                                            <?php echo FormNivel($relato->nivel); ?>
                                        </td>
                                        <td class="text-center">
                                            <b data="<?php echo $relato->id_relato; ?>" class="status_checks btn btn-sm <?php echo ($relato->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($relato->status) ? 'Resolvido' : 'Dependente' ?></b>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo base_url('admin/relato/alterar/' . $relato->id_relato); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

                                            <a href="<?php echo base_url('admin/relato/deletar/' . $relato->id_relato); ?>" onclick="return confirmarExclusao(<?php echo $relato->id_relato; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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

        Shadowbox.init();

        CKEDITOR.replace('editor1');

        $(document).on('click', '.status_checks', function ()
        {
            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            var msg = (status === '0') ? 'Dependente' : 'Resolvido';
            if (confirm("Tem certeza que quer alterar para " + msg + "?"))
            {
                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo base_url() . 'admin/relato/alterar_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id_relato": id, "status": status},
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