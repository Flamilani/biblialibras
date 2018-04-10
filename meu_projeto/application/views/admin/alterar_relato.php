<div id="page-wrapper">
    <div class="row">

        <div class="col-lg-12">
            <h3 class="page-header"><a href="<?php echo base_url("admin/relato") ?>"> Relato de Erros </a> > Relato <?php echo $relato[0]->titulo; ?> - ID <?php echo $relato[0]->id_relato; ?></h3>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible">
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
                    Alterar Livro
                </div>
                <div class="panel-body">
                    <?php
                    $titulo = array('name' => 'titulo', 'type' => 'text', 'id' => 'titulo', 'value' => $relato[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
                    $link = array('name' => 'link', 'type' => 'url', 'id' => 'link', 'value' => $relato[0]->link, 'class' => 'form-control', 'placeholder' => 'Link');
                    $conteudo = array('name' => 'editor1', 'id' => 'editor1', 'value' => $relato[0]->conteudo, 'rows' => '10', 'cols' => '80');
                    $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>
                    <?php echo form_open('admin/relato/gravar_alteracoes') . form_hidden('id_relato', $relato[0]->id_relato); ?>
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
                                <option value="0" disabled selected> Selecione </option>
                                <option value="1" <?php if (isset($relato[0]->tipo) && $relato[0]->tipo == '1') echo 'selected'; ?>> Novo </option>
                                <option value="1" <?php if (isset($relato[0]->tipo) && $relato[0]->tipo == '2') echo 'selected'; ?>> Mudança </option>
                                <option value="1" <?php if (isset($relato[0]->tipo) && $relato[0]->tipo == '3') echo 'selected'; ?>> Erro de Código </option>
                                <option value="2" <?php if (isset($relato[0]->tipo) && $relato[0]->tipo == '4') echo 'selected'; ?>> Falha de Sistema </option>
                                <option value="3" <?php if (isset($relato[0]->tipo) && $relato[0]->tipo == '5') echo 'selected'; ?>> Defeito </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <?php echo form_label('Nível', 'nivel'); ?>
                                <select class="form-control" name="nivel" id="nivel">
                                <option value="0" disabled selected> Selecione </option>
                                <option value="1" <?php if (isset($relato[0]->nivel) && $relato[0]->nivel == '1') echo 'selected'; ?>> Leve </option>
                                <option value="2" <?php if (isset($relato[0]->nivel) && $relato[0]->nivel == '2') echo 'selected'; ?>> Normal </option>
                                <option value="3" <?php if (isset($relato[0]->nivel) && $relato[0]->nivel == '3') echo 'selected'; ?>> Grave </option>
                                <option value="4" <?php if (isset($relato[0]->nivel) && $relato[0]->nivel == '4') echo 'selected'; ?>> Urgente </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo form_label('Link', 'link') . form_input($link); ?>
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

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!-- Uso de Modal-->
<?php require_once('modal/modal_deletar.php'); ?>
<!-- Uso de Modal-->

<script type="text/javascript">


    $(document).ready(function () {
        Shadowbox.init();

         CKEDITOR.replace('editor1');

        $(document).on('click', '.status_checks', function ()
        {
            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            var msg = (status === '0') ? 'Inativo' : 'Ativo';
            if (confirm("Tem certeza que quer alterar para " + msg + "?"))
            {
                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo base_url() . 'admin/livros/alterar_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id_livro": id, "status": status},
                    success: function (data) {
                        location.reload();
                    }});
            }
        });

        var base_url = "<?= base_url(); ?>";


    });

</script>