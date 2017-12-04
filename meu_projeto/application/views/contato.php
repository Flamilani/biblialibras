
<!-- Contact Section -->
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center front">
                <h2>Entre em contato conosco</h2>
              <!--   <hr class="star-primary"> -->
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                      <?php echo form_open(base_url('home/logar'), array('id'=>'form_login')); ?>           
                        <ul class="nav navbar-nav navbar-right">                   
                            <li class="dropdown">                        
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acesso <strong class="caret"></strong></a>
                                <ul class="dropmenu dropdown-menu">
                                    <?php echo validation_errors(); ?>
                                    <?php $email = array('name' => 'user_email', 'id' => 'user_email', 'type' => 'text', 'class' => 'form-control', 'placeholder' => 'E-mail', 'data-error' => 'Informe seu e-mail.', 'required' => 'required'); ?>
                                    <?php $senha = array('name' => 'user_senha','id' => 'user_senha', 'type' => 'password', 'class' => 'form-control', 'placeholder' => 'Senha', 'data-error' => 'Informe sua senha', 'required' => 'required'); ?>
                                    <?php $button = array('name' => 'btn_login', 'id' => 'btn_login', 'type' => 'submit', 'class' => 'btn btn-primary btn-block', 'value' => 'Acessar'); ?>
                                    <?php $anchor = array('href'=>base_url('esqueci-minha-senha'), 'value'=>'Esqueci minha senha', 'type'=>'button', 'class'=>'btn btn-warning btn-sm btn-block');  ?>
                                    <li style="margin-bottom: 10px; text-align: center;">  
                                        <b style="padding-top: 3px; padding-bottom: 3px;" class="text-blue">Acesso à Área <br />do Cliente</b>
                                    </li>
                                    <li style="margin-bottom: 10px;">   
                                        <?php echo form_input($email); ?>      
                                    </li>
                                    <li style="margin-bottom: 10px;">               
                                       <?php echo form_password($senha); ?>      
                                    </li>                         
                                    <li>
                                       <?php echo form_submit($button); ?>
                                    </li>
                                    <li class="divider"></li>-->
                                        <li>
                                        <?php form_submit($anchor); ?>
                                    </li>                                
                                   
                                </ul>                        
                            </li>                   
                        </ul>
                     <?php form_close(); ?>   
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                <form name="sentMessage" id="contactForm" novalidate>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" placeholder="Nome" id="name" required data-validation-required-message="Favor digite seu nome.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" placeholder="E-mail" id="email" required data-validation-required-message="Favor digite seu e-mail.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="celular">Celular</label>
                            <input type="tel" class="form-control" placeholder="Celular" id="celular" required data-validation-required-message="Favor digite seu número de celular.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="message">Mensagem</label>
                            <textarea rows="5" class="form-control" placeholder="Mensagem" id="message" required data-validation-required-message="Favor digite sua mensagem."></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br>
                    <div id="success"></div>
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>