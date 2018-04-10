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
        <div class="col-lg-6">
            <?php
            $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>
            <?php echo form_open('admin/assinaturas/salvar_pago') . form_hidden('id_pago',$pagos[0]->id_pago); ?>

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
                <input type="hidden" id="codigo" name="codigo" value="<?php echo $pagos[0]->codigo; ?>">
                <input type="hidden" id="plano" name="plano" value="<?php echo $pagos[0]->nome_plano; ?> - <?php echo $pagos[0]->duracao; ?> <?php echo FormPeriodo($pagos[0]->periodo); ?>">
                <input type="hidden" name="id_pago" id="id_pago" value="<?php echo $pagos[0]->id_pago; ?>" />
                <?php echo form_submit($buttonPubl); ?>
                <span class="loading"><img src="<?php echo base_url('assets/img/load.gif'); ?>" alt="">Carregando...</span>

                <?php form_close(); ?>
        </div>
        <!-- /.col-lg-12 -->
    </div>

    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript">

    $(document).ready(function () {

            $('#btn_publicar').click(function() {
            $('.loading').css('display', 'inline-block');
        });

    });

</script>

