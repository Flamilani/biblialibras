<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Acesso à Área do Usuário</h4>
            </div>
            <div class="modal-body">
     <?php echo validation_errors(); ?>
    <?php $email = array('name' => 'user_email', 'id' => 'user_email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'E-mail', 'data-error' => 'Informe seu e-mail.', 'required' => 'required'); ?>
    <?php $senha = array('name' => 'user_senha','id' => 'user_senha', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha', 'data-error' => 'Informe sua senha', 'required' => 'required'); ?>
    <?php $button = array('name' => 'btn_login', 'id' => 'btn_login', 'type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Acessar'); ?>
    <?php $anchor = array('href'=>base_url('esqueci-minha-senha'), 'value'=>'Esqueci minha senha', 'type'=>'button', 'class'=>'btn btn-warning btn-sm btn-block');  ?>
              
     <form role="form" method="post" class="formulario" action="<?php echo base_url('home/logar'); ?>" id="formulario_envio">
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">E-mail</label>
        <input type="email" name="user_email" id="user_email" class="form-control" placeholder="E-mail" required="required" />   
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="senha">Senha</label>
                              <input type="password" name="user_senha" id="user_senha" class="form-control" placeholder="Senha" required="required" /> 
                        </div>
                    </div>
                    <br />
                  <input type="submit" name="btn_login" id="btn_login" class="btn btn-primary" value="Acessar" />
              </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>

