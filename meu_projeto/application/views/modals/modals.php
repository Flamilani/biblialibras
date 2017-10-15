<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Acesso à área do Usuário</h4>
            </div>
            <div class="modal-body">
                    <?php echo form_open(base_url('home/logar'), array('id'=>'form_login')); ?>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" placeholder="E-mail" id="acessoemail" required data-validation-required-message="Favor digite seu e-mail.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" placeholder="Senha" id="acessosenha" required data-validation-required-message="Favor digite sua senha.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Acessar</button>
                <?php form_close(); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalInscricao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog tamModal" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalInscricao">Assinatura</h4>
            </div>
            <div class="modal-body">

                <form name="Inscricao" id="inscricaoForm">
                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="nome">Nome Completo</label>
                            <input type="text" class="form-control" placeholder="Nome Completo" id="nome" required data-validation-required-message="Favor digite seu nome completo.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="email">E-mail</label>
                            <input type="email" class="form-control" placeholder="E-mail" id="email" required data-validation-required-message="Favor digite seu e-mail.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" placeholder="Senha" id="senha" required data-validation-required-message="Favor digite sua senha.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="confsenha">Confirme Senha</label>
                            <input type="password" class="form-control" placeholder="Confirme Senha" id="confsenha" required data-validation-required-message="Favor confirme sua senha.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="email">Telefone</label>
                            <input type="tel" class="form-control" placeholder="Telefone" id="telefone" required data-validation-required-message="Favor digite seu telefone.">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="form-group floating-label-form-group controls col-md-6">
                            <label for="email">WhatsApp</label>
                            <input type="tel" class="form-control" placeholder="WhatsApp" id="whatsapp" required data-validation-required-message="Favor digite seu número de WhatsApp.">
                            <p class="help-block text-danger"></p>
                        </div>
                    </div>
                       <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nome">Endereço</label>
                            <input type="text" class="form-control" placeholder="Endereço" id="endereco">

                        </div>
                    </div><br />
                    <div class="row">
                        <div class="form-group controls col-md-6">
                            <label for="escolaridade">Escolaridade</label>
                            <select class="form-control" name="escolaridade" id="escolaridade">
                                <option value="0">Selecione</option>
                                <option value="basica">Básica</option>
                                <option value="media">Média</option>
                                <option value="superior">Superior</option>
                            </select>
                        </div>
                        <div class="form-group controls col-md-6">
                            <label for="perfil">Perfil</label>
                            <select class="form-control" name="perfil" id="perfil">
                                <option value="0">Selecione</option>
                                <option value="surdo">Surdo</option>
                                <option value="ouvinte">Ouvinte</option>
                            </select>
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nome">Faz parte de alguma Igreja?</label>
                            <input type="text" class="form-control" placeholder="Faz parte de alguma Igreja?" id="igreja">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nome">Voce é líder em sua igreja? Professor ou Pastor?</label>
                            <input type="text" class="form-control" placeholder="Voce é líder em sua igreja? Professor ou Pastor?" id="lider">
                        </div>
                    </div>
                    <div class="row control-group">
                        <div class="form-group col-xs-12 floating-label-form-group controls">
                            <label for="nome">Como ficou sabendo de A Bíblia em Libras?</label>
                            <input type="text" class="form-control" placeholder="Como ficou sabendo de A Bíblia em Libras?" id="saber">
                        </div>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary">Assinar</button>
                    <button type="reset" class="btn btn-warning">Apagar</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

            </div>
        </div>
    </div>
</div>