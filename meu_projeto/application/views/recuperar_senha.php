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
            <h2>Recuperação de Senha</h2><br><br>
            <!--   <hr class="star-primary"> -->
        </div>
    </div>
    <div class="row">

        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i>', '</div>'); ?>
        <?php $email = array('name' => 'email', 'id' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'E-mail', 'data-error' => 'Informe seu e-mail.', 'required' => 'required'); ?>
        <?php $cpf = array('name' => 'cpf','id' => 'cpf', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'CPF', 'data-error' => 'Informe seu número de CPF', 'required' => 'required'); ?>
        <?php $button = array('name' => 'btn_login', 'id' => 'btn_login', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Enviar'); ?>

        <?php echo form_open(base_url('home/recuperar_login'), array('id'=>'form_acesso')); ?>

        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label for="email">E-mail</label>
                <?php echo form_input($email); ?>
            </div>
        </div>
        <div class="row control-group">
            <div class="form-group col-xs-12 floating-label-form-group controls">
                <label for="email">CPF</label>
                <?php echo form_input($cpf); ?>
            </div>
        </div>
        <br />
        <?php echo form_submit($button); ?>
        <?php form_close(); ?>
    </div><br>

</div>

<script>
    $(document).ready(function () {

        $("#cpf").mask("000.000.000-00", {reverse: true});
        $('#form_acesso').validator();
    });
</script>