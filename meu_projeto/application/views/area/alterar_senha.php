<div class="container ladosTela">
    <div style="margin-top: 70px;" class="page-header">
    <div class="front">
        <h3><a href="<?php echo base_url('area'); ?>">Área do Usuário</a> > Meu Perfil : <?php echo $perfil[0]->nome; ?></h3>
    </div>
    </div>
    <div class="row display-flex">
<div id="page-wrapper">
    <div class="row">

        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <?php if($this->session->flashdata('success')) { ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>A senha foi atualizada com sucesso!</div>
    <?php } else if($this->session->flashdata('deletar')) { ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <i class="icon fa fa-success"></i>O usuário foi deletado com sucesso!</div>
    <?php } ?>
    <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>

    <div class="row">

        <div class="col-lg-12">
            <div class="panel panel-primary">

                <div class="panel-heading">
                    Alterar Senha
                </div>
                <div class="panel-body">
                    <?php $senha = array('id' => 'inputPassword', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Digite sua senha', 'data-error' => 'Mínimo de seis (6) dígitos.', 'pattern' => '.{6,12}', 'title' => 'Informe sua Senha [de 6 a 12 caracteres!]','required' => 'required');
                    $confsenha = array('name' => 'senha','id' => 'inputConfirm', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirme sua senha', 'data-match' => '#inputPassword','data-match-error'=>'As senhas não são iguais.','required' => 'required');
                    $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>

                    <?php echo form_open('area/alterar_senha_user', array('id'=>'SendSenha')) . form_hidden('id', $perfil[0]->id); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo form_label('Senha', 'inputPassword') . form_input($senha); ?>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group has-feedback">
                                <?php echo form_label('Confirme a Senha', 'inputConfirm') . form_input($confsenha); ?>
                                <span class="glyphicon form-control-feedback"></span>
                                <span class="help-block with-errors"></span>
                            </div>
                        </div>
                    </div>



                    <?php echo form_submit($buttonPubl); ?>


                    <!-- /.row (nested) -->
                </div>
                <?php form_close(); ?>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {

        $('#SendSenha').validator();

    });

    function confirmarSenha() {
        alert("senha");
        $senha = document.getElementById("senha").value;
        $confsenha = document.getElementById("confsenha").value;
        if($senha != $confsenha) {
            alert("A senha não é compatível");
            return false;
        } else {
            return true;
        }
    }

</script>