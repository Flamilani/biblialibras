 <?php if(null == $this->session->userdata('logado')): ?> 
    <div class="container headTop ladosTela headBottom">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h2>Cadastro</h2>
              <!--   <hr class="star-primary"> -->
            </div>
        </div>
        <div class="row">
        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i>', '</div>'); ?> 

 <?php $cpf = array('name' => 'cpf', 'id' => 'cpf', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'CPF', 'data-error' => 'Informe seu nº de CPF.', 'required' => 'required'); ?>
  <?php $email = array('name' => 'email', 'id' => 'email', 'type' => 'email', 'class' => 'form-control', 'placeholder' => 'E-mail', 'data-error' => 'Informe seu e-mail.', 'required' => 'required'); ?>
  <?php $telefone    = array('name' => 'telefone', 'id' => 'telefone', 'type' => 'tel', 'class' => 'form-control', 'placeholder' => 'Seu número de telefone', 'data-error' => 'Informe seu nº de telefone.', 'required' => 'required'); ?>
    <?php $celular    = array('name' => 'celular', 'id' => 'celular', 'type' => 'tel', 'class' => 'form-control', 'placeholder' => 'Seu número de Whatsapp', 'data-error' => 'Informe seu nº de Whatsapp.', 'required' => 'required'); ?>
  <?php $senha = array('id' => 'inputPassword', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Digite sua senha', 'data-error' => 'Mínimo de seis (6) dígitos.', 'pattern' => '.{6,12}', 'title' => 'Informe sua Senha [de 6 a 12 caracteres!]'); ?>
      <?php $confsenha = array('name' => 'senha','id' => 'inputConfirm', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Confirme sua senha', 'data-match' => '#inputPassword','data-match-error'=>'As senhas não são iguais.'); ?>
    <?php $cep = array('name' => 'cep', 'id' => 'cep', 'type' => 'text', 'class' => 'cep form-control', 'placeholder' => 'CEP', 'data-error' => 'Informe seu CEP.', 'required' => 'required'); ?>
    
        <?php $endereco   = array('name' => 'endereco', 'id' => 'endereco', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Endereço', 'data-error' => 'Informe seu endereço.', 'required' => 'required');
        $numero     = array('name' => 'numero', 'id' => 'numero', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Número', 'data-error' => 'Informe nº de endereço.', 'required' => 'required');
        $compl      = array('name' => 'compl', 'id' => 'compl', 'type' => 'text',  'class' => 'form-control', 'placeholder' => 'Complemento');
        $bairro     = array('name' => 'bairro', 'id' => 'bairro', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Bairro', 'data-error' => 'Informe seu e-mail.', 'required' => 'required');
        $cidade     = array('name' => 'cidade', 'id' => 'cidade', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Cidade', 'data-error' => 'Informe sua cidade.', 'required' => 'required');
        $estado     = array('name' => 'estado', 'id' => 'estado', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'Estado', 'data-error' => 'Informe seu estado.', 'required' => 'required');
 ?>
  <?php
  $btnAssinar = array('name' => 'btn_assinar', 'id' => 'btn_assinar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Pronto');
  $btnCarregar = array('name' => 'btn_carregar', 'id' => 'btn_carregar', 'class' => 'btn btn-info', 'value' => 'Carregando...');
    $btnReset = array('type' => 'reset', 'class' => 'btn btn-warning', 'value' => 'Cancelar'); ?>
         <?php echo form_open(base_url('users/registrar'), array('id'=>'SendAssinatura')); ?>   
                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                              <div class="form-group has-feedback">
                          <?php 
                      $nome = array('name' => 'nome', 
                                    'id' => 'nome', 
                                    'type' => 'nome', 
                                    'class' => 'form-control', 
                                    'placeholder' => 'Nome', 
                                    'data-error' => 'Informe seu nome.', 
                                    'required' => 'required'); 
                                    ?>              
                            <?php echo form_label('Nome', 'nome') . form_input($nome); ?>
                             <span class="help-block with-errors"></span>
                            </div>                      
                         </div>
                            <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                              <div class="form-group has-feedback">     
                          <?php $sobrenome = array('name' => 'sobrenome', 'id' => 'sobrenome', 'type' => 'nome', 'class' => 'form-control', 'placeholder' => 'Sobrenome', 'data-error' => 'Informe seu sobrenome.', 'required' => 'required'); ?>       
                            <?php echo form_label('Sobrenome', 'sobrenome') . form_input($sobrenome); ?>
                             <span class="help-block with-errors"></span>
                            </div>                      
                         </div>

                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                           <div class="form-group has-feedback">  
                     <?php echo form_label('Data de Nascimento', 'data_nasc'); ?>  
<?php $data = array('name' => 'data_nasc', 'id' => 'data_nasc', 'type' => 'data', 'class' => 'form-control', 'placeholder' => 'Data de Nascimento', 'data-error' => 'Informe sua data de nascimento.', 'required' => 'required'); ?> 
                            <?php echo form_input($data); ?>   
                         <span class="help-block with-errors"></span>
                      </div> 
                        </div>
                    </div>
                     <div class="row">
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                           <div class="form-group has-feedback">                    
                     <?php echo form_label('CPF', 'cpf') . form_input($cpf); ?>        
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                             </div>       
                        </div>
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                            <div class="form-group has-feedback">                    
                     <?php echo form_label('E-mail', 'email') . form_input($email); ?>        
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                     </div>   
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                           <div class="form-group has-feedback">  
                   <?php echo form_label('Telefone', 'telefone') . form_input($telefone); ?>
                    <span class="help-block with-errors"></span>
                    </div>  
                        </div>
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                           <div class="form-group has-feedback">  
                    <?php echo form_label('Whatsapp', 'celular') . form_input($celular); ?>
                     <span class="help-block with-errors"></span>
                </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                            <div class="form-group has-feedback">   
                     <?php echo form_label('Senha', 'inputPassword') . form_input($senha); ?>      
                         <span class="help-block with-errors"></span>                     
                        </div>
                        </div>
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                             <div class="form-group has-feedback">  
                        <?php echo form_label('Confirme a Senha', 'inputConfirm') . form_input($confsenha); ?>      
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                </div>
                        </div>
                    </div>
                      <div class="row control-group">               
                    <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                          <div class="form-group has-feedback">                      
                <?php echo form_label('CEP', 'cep'); ?>
                    <small><a href="http://www.buscacep.correios.com.br/sistemas/buscacep/" title="Busca CEP" class="" target="_blank"> - Esqueci CEP</a></small>
                        <?php echo form_input($cep); ?>      
                    <span class="help-block with-errors"></span>
                </div>  
                        </div>
                   </div>
                       <div class="row">                        
                         <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                           <div class="form-group has-feedback">              
                <?php echo form_label('Endereço', 'endereco') . form_input($endereco); ?>
                    <span class="help-block with-errors"></span>
                </div> 
                        </div>                   
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                           <div class="form-group has-feedback">              
                    <?php echo form_label('Número', 'numero') . form_input($numero); ?>          
                    <span class="help-block with-errors"></span>
                        </div>    
                        </div>
                         <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                            <div class="form-group">  
                <?php echo form_label('Compl.', 'compl') . form_input($compl); ?>                  
                </div>  
                        </div>
                    </div>
                        <div class="row">
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-6 col-lg-6">
                             <div class="form-group has-feedback">                    
                     <?php echo form_label('Bairro', 'bairro') . form_input($bairro); ?>       
                    <span class="help-block with-errors"></span>
                </div>   
                        </div>                    
                        <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                            <div class="form-group has-feedback">                    
                     <?php echo form_label('Cidade', 'cidade') . form_input($cidade); ?>       
                    <span class="help-block with-errors"></span>
                </div>    
                        </div>
                         <div class="form-group floating-label-form-group controls col-xs-12 col-md-3 col-lg-3">
                          <div class="form-group has-feedback">                    
                     <?php echo form_label('Estado', 'estado') . form_input($estado); ?>     
                    <span class="help-block with-errors"></span></div>  

                        </div>
                    </div>
                    <br />
                    <div class="row">
                             <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" name="sexo" id="sexo">
                                <option value="0">Selecione</option>
                                <option value="1">Masculino</option>
                                <option value="2">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="escolaridade">Escolaridade</label>
                            <select class="form-control" name="escolaridade" id="escolaridade">
                                <option value="0">Selecione</option>
                                <option value="1">Ensino Fundamental</option>
                                <option value="2">Ensino Médio</option>
                                <option value="3">Ensino Superior</option>
                            </select>
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="perfil_so">Perfil</label>
                            <select class="form-control" name="perfil_so" id="perfil_so">
                                <option value="0">Selecione</option>
                                <option value="1">Surdo</option>
                                <option value="2">Ouvinte</option>
                            </select>
                        </div>
                   
                    <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="igreja">Faz parte de alguma igreja?</label>
                            <select class="form-control" name="igreja" id="igreja">
                                <option value="0">Selecione</option>
                                <option value="1">Evangélica</option>
                                <option value="2">Católica</option>
                                <option value="3">Outra</option>
                            </select>
                        </div>                                   
                                      
                    </div>                  
                    <div class="row">      
                     <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="funcao">O que faz na sua igreja?</label>
                            <select class="form-control" name="funcao" id="funcao">
                                <option value="0">Selecione</option>
                                <option value="1">Pastor</option>
                                <option value="2">Professor</option>
                                <option value="3">Estudante</option>
                            </select>
                        </div>                 
                    <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="saber">Como soube de A Bíblia em Libras?</label>
                            <select class="form-control" name="saber" id="saber">
                                <option value="0">Selecione</option>
                                <option value="1">Google</option>
                                <option value="2">Facebook</option>
                                <option value="3">Indicação de Amigo</option>
                            </select>
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="acesso">O que usa mais para acessar o site?</label>
                            <select class="form-control" name="acesso" id="acesso">
                                <option value="0">Selecione</option>
                                <option value="1">Celular</option>
                                <option value="2">Tablet</option>
                                <option value="3">Notebook</option>
                                <option value="4">Computador</option>
                            </select>
                        </div>
                   </div>
            <div class="row">
                <div class="checkbox">
                    <label>
                        <input name="termos" id="termos" type="checkbox" value="1" required> Eu li e concordo com os <a href="<?php echo base_url('home/termos') ; ?>">termos e condições do site A Bíblia em Libras</a>
                    </label>
                </div>
                <span class="help-block with-errors"></span>
            </div>
<br>
               <?php echo form_submit($btnAssinar); ?>
               <?php echo form_submit($btnCarregar); ?>
               <?php echo form_reset($btnReset); ?>
                <?php form_close(); ?>
            </div>
           
        </div>

<script>
    $(document).ready(function () {

        $('#btn_carregar').hide();

        $("#btn_assinar").mouseup(function (){
            $('#btn_assinar').hide();
            $('#btn_carregar').show();
        });


        $('#SendAssinatura').validator();
         $("#data_nasc").mask("00/00/0000");
         $("#numero").mask("00000", {reverse: true});
         $("#telefone").mask("(00) 00000-0000");
         $("#celular").mask("(00) 00000-0000");
         $("#cpf").mask("000.000.000-00", {reverse: true});
         $("#cep").mask("00000-000", {reverse: true});

           $('#cep').blur(function() {
            $.getJSON("https://viacep.com.br/ws/" + $("#cep").val() + "/json", 
              function(dados) {
                if(!("erro" in dados)) {
                  $("#endereco").val(dados.logradouro);
                  $("#bairro").val(dados.bairro);
                  $("#cidade").val(dados.localidade);
                  $("#estado").val(dados.uf);
                  $("#numero").focus();
                } 
                else {
                  //alert("CEP não encontrado!");
                  $("#cep").focus();
                }
              });
           });        
    });

</script>
<?php else: ?>
  <?php redirect(base_url('area/meu_perfil' . '/' . $this->session->userdata('user')->id)); ?>
<?php endif; ?>

