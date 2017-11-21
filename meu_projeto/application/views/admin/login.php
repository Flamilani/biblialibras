<div class="fundoAdmin">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Acesso ao Painel Administrativo</h3>
                    </div>
                         
                    <div class="panel-body">
                <?php  $login = array('name' => 'email', 'type' => 'email', 'id'=> 'email', 'class' => 'form-control', 'placeholder' => 'Email', 'data-error' => 'Informe seu e-mail.', 'required' => 'required'); ?>
                <?php  $senha = array('name'=>'senha', 'type' => 'password', 'id'=> 'senha', 'class' => 'form-control', 'placeholder' => 'Senha', 'data-error' => 'Mínimo de seis (6) dígitos.', 'pattern' => '.{6,12}', 'title' => 'Informe sua Senha [de 6 a 12 caracteres!]'); ?>
                    <?php $button = array('name'=> 'acessar', 'id' => 'btnAcessar', 'value'=> 'Acessar', 'class'=> 'btn btn-primary btn-block btn-flat'); ?>
                    <?php echo form_open(base_url('admin/login/logar_admin'), array('id'=>'form_login')); ?>
                            <fieldset>
                                 <div class="form-group has-feedback">
                                     <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                  <?php echo form_input($login); ?>       
                                        </div>
                              <div class="form-group has-feedback">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                 <?php echo form_password($senha); ?>      
                                        </div>                       
                                <?php echo form_submit($button); ?>          
                            </fieldset>
                        <?php form_close(); ?>
                    </div>
                </div>
                <?php if($this->session->flashdata('alert')) { ?>
                <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times; </button>
                    <i class="icon fa fa-warning"></i> Login e/ou senha são incorretos!</div>
            <?php } ?>
          <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Saiu da sessão com sucesso.</div>
            <?php } ?>
            </div>
        </div>
    </div>
</div>
