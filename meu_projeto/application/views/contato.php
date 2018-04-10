
<!-- Contact Section -->

    <div class="container headTop ladosTela">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h2>Entre em Contato Conosco</h2><br>
              <!--   <hr class="star-primary"> -->
   
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                   <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>Sua mensagem foi enviada com sucesso.</div>
            <?php } ?>           
        <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i>', '</div>'); ?>       
        <?php
        $nome = array('name' => 'nome', 'id' => 'nome', 'type' => 'text', 'class' => 'form-control', 'value' => (isset($this->session->userdata('user')->nome) ? $this->session->userdata('user')->nome : set_value('nome')), 'placeholder' => 'Nome', 'data-error' => 'Informe seu nome.', 'required' => 'required');
        $celular = array('name' => 'celular', 'id' => 'celular', 'type' => 'text', 'class' => 'form-control', 'value' => (isset($this->session->userdata('user')->celular) ? $this->session->userdata('user')->celular : set_value('celular')), 'placeholder' => 'Celular', 'data-error' => 'Informe seu nº de celular.', 'required' => 'required');
        $email = array('name' => 'email', 'id' => 'email', 'type' => 'email', 'class' => 'form-control', 'value' => (isset($this->session->userdata('user')->email) ? $this->session->userdata('user')->email : set_value('email')), 'placeholder' => 'E-mail', 'data-error' => 'Informe seu e-mail.', 'required' => 'required');
        $button = array('name' => 'btn_enviar', 'id' => 'btn_enviar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Enviar');
        $reset = array('type' => 'reset', 'class' => 'btn btn-warning', 'value' => 'Cancelar');
        $form = array('id' => 'SendContato'); ?>       
        <?php echo form_open(base_url('home/envio'), $form); ?>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                                <div class="form-group has-feedback">              
                            <?php echo form_label('Nome', 'nome') . form_input($nome); ?>
                             <span class="help-block with-errors"></span>
                            </div>                      
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                      <div class="form-group has-feedback">                    
                     <?php echo form_label('E-mail', 'email') . form_input($email); ?>        
                    <span class="glyphicon form-control-feedback"></span>
                    <span class="help-block with-errors"></span>
                     </div>   
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <div class="form-group has-feedback">  
                    <?php echo form_label('Whatsapp', 'celular') . form_input($celular); ?>
                     <span class="help-block with-errors"></span>
                </div>
                        </div>
                    </div>
                    <div class="row control-group">
                        <br>
                        <div class="form-group controls col-xs-12 col-md-6 col-lg-6">
                            <div class="form-group has-feedback">  
                          <label for="assunto">Assunto</label>
                        <select class="form-control" name="assunto" id="assunto" required>
                            <option value="" selected disabled> Selecione um assunto </option>
                            <option value="1"> Dúvida </option>
                            <option value="2"> Crítica </option>
                            <option value="3"> Sugestão </option>
                        </select>
                    </div>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                             <div class="form-group has-feedback"> 
                        <label class="control-label">Mensagem</label>
                        <textarea class="form-control" name="mensagem" id="mensagem" rows="5" placeholder="Sua mensagem" data-error="Digite uma mensagem." required></textarea>
                         <span class="help-block with-errors"></span>
                    </div>  
                        </div>
                    </div>
                    <br>
                   
                    <div class="row">
                        <div class="form-group col-xs-12">                                         
                        <?php echo form_submit($button) . '  ' . form_reset($reset); ?>
                    </div>
                    </div>
              <?php form_close(); ?>   
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
         $('#SendContato').validator();   

          $("#celular").mask("(00) 00000-0000");     
             });

</script>
