<?php if($this->session->flashdata('message')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-warning-sign',
                    title: '<b>Alerta:</b>',
                    message: 'Login e/ou senha são incorretos!'
                },
                {
                    type: 'warning'
                }
            );
        });
    </script>
<?php } ?>
<?php if($this->session->flashdata('recuperar')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-warning-sign',
                    title: '<b>Alerta:</b>',
                    message: 'Dados são incorretos!'
                },
                {
                    type: 'warning'
                }
            );
        });
    </script>
<?php } ?>
<?php if($this->session->flashdata('logout')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-success-sign',
                    title: '<b>Sucesso:</b>',
                    message: 'Saiu da sessão com sucesso. Volte em breve.'
                },
                {
                    type: 'success'
                }
            );
        });
    </script>
<?php } ?>
<?php if($this->session->flashdata('envio')) { ?>
    <script type="text/javascript">
        $(function () {
            $.notify(
                {
                    icon: 'glyphicon glyphicon-success-sign',
                    title: '<b>Sucesso:</b>',
                    message: 'Sua mensagem foi enviada com sucesso.'
                },
                {
                    type: 'success'
                }
            );
        });
    </script>
<?php } ?>

<div class="container headTop loginTela">
    <div class="row">
        <div class="col-lg-12 text-center front">
            <h2>Nova Senha</h2><br><br>
            <!--   <hr class="star-primary"> -->
        </div>
    </div>
    <div class="row">

        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i>', '</div>'); ?>
        <?php $senha_atual = array('name' => 'senha_atual', 'id' => 'senha_atual', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha Atual', 'data-error' => 'Informe sua senha atual.', 'required' => 'required'); ?>
        <?php $senha_nova = array('name' => 'nova_senha','id' => 'nova_senha', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha', 'data-error' => 'Coloque uma nova senha', 'required' => 'required'); ?>
        <?php $senha_conf = array('name' => 'user_senha','id' => 'user_senha', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha', 'data-error' => 'Confirme sua nova senha', 'required' => 'required'); ?>
        <?php $button = array('name' => 'btn_login', 'id' => 'btn_login', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Acessar'); ?>
        <?php $anchor = array('href'=>base_url('esqueci-minha-senha'), 'value'=>'Esqueci minha senha', 'type'=>'button', 'class'=>'btn btn-warning btn-sm btn-block');  ?>

        <?php echo form_open(base_url('home/criar_senha'), array('id'=>'form_acesso')); ?>

        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label for="email">Senha Atual</label>
                <?php echo form_input($senha_atual); ?>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label for="senha">Nova Senha</label>
                <?php echo form_password($senha_nova); ?>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label for="senha">Confirme Nova Senha</label>
                <?php echo form_password($senha_conf); ?>
            </div>
        </div>
        <?php form_close(); ?>
    </div><br>

</div>

<script>
    $(document).ready(function () {

        $('#form_acesso').validator();
    });
</script>