<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <?php $url = $this->uri->segment(4); ?>
            <?php $rowsplLivro = $this->db->query("SELECT * FROM livros"); ?>
            <?php $resplLivro = $rowsplLivro->result(); ?>
            <?php $rowsPlanoLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$url}"); ?>
            <?php $countPLivro = $rowsPlanoLivro->result(); ?>
            <h3 class="page-header"><a href="<?php echo base_url('admin/planos'); ?>"> <i class="fa fa-file fa-fw"></i> Planos</a> > Livros do <?php echo $nome_plano[0]->nome_plano; ?>
                <?php if(isset($countPLivro[0]->params) && $countPLivro[0]->params != ''): ?>
                    (<?php echo count(explode(',', $countPLivro[0]->params)); ?> <?php plural(count(explode(',', $countPLivro[0]->params)), 'Livro', 'Livros') ?>)
                <?php endif; ?>
            </h3>

        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


        <?php if($this->session->flashdata('success')) { ?>
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-success"></i>O livro do plano foi adicionado com sucesso!</div>
        <?php } ?>
        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Inserir Livro do Plano
                    </div>
                    <div class="panel-body">
                        <?php $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

                        <?php echo form_open('admin/planos/gravarPlanoLivro', 'role="form"'); ?>
                        <?php echo form_hidden('id_planos', $nome_plano[0]->id_planos) ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo form_label('Selecione Livro', 'livro') ?>
                                    <?php foreach($plano_livroSel as $livro): ?>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="livros[]" value="<?php echo $livro->id_livro; ?>" id="<?php echo $livro->id_livro; ?>" />
                                                <?php echo $livro->ordem; ?> - <b><?php echo $livro->titulo; ?></b></label>
                                        </div>
                                    <?php endforeach; ?>

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

</div>
<!-- /#page-wrapper -->


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
                url = "<?php echo base_url() . 'admin/planos/alterar_plano_livro_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id_plano_livro": id, "status": status},
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