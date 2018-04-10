<div class="container ladosTela">
   <div class="front">
  <h3 class="tituloCima"><a href="<?php echo base_url('area'); ?>">Área do Usuário</a> > Meu Perfil : <?php echo $perfil[0]->nome; ?> ( <?php echo zerofill($this->session->userdata('user')->id); ?> ) </h3>
</div>
    <div class="row">
<div id="page-wrapper">
 
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O usuário foi atualizado com sucesso!</div>
           <?php } else if($this->session->flashdata('senha_alterada')) { ?>
                   <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A senha foi alterada com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">

                        <div class="panel-heading">
                         Editar Perfil  <b style="font-size: 15px;" class="pull-right label <?php echo ($perfil[0]->status) ? 'label-success' : 'label-warning' ?>"><?php echo ($perfil[0]->status) ? 'Ativo' : 'Inativo' ?></b>
                        </div>
                        <div class="panel-body">
  <?php $nome = array('name' => 'nome', 'id' => 'nome', 'type' => 'text', 'value' => $perfil[0]->nome, 'class' => 'form-control');
    $sobrenome = array('name' => 'sobrenome', 'type' => 'text', 'id' => 'sobrenome', 'value' => $perfil[0]->sobrenome, 'class' => 'form-control');
    $email = array('name' => 'email', 'type' => 'email', 'id' => 'email', 'value' => $perfil[0]->email, 'class' => 'form-control');
    $senha = array('name' => 'senha', 'type' => 'password', 'id' => 'senha', 'class' => 'form-control');
    $telefone = array('name' => 'telefone', 'type' => 'tel', 'id' => 'telefone', 'value' => $perfil[0]->telefone, 'class' => 'form-control');
    $celular = array('name' => 'celular', 'type' => 'tel', 'id' => 'celular', 'value' => $perfil[0]->celular, 'class' => 'form-control'); 
    $data_nasc = array('name' => 'data_nasc', 'type' => 'data', 'id' => 'data_nasc', 'value' => $perfil[0]->data_nasc, 'class' => 'form-control');
    $cpf = array('name' => 'cpf', 'type' => 'text', 'id' => 'cpf', 'value' => $perfil[0]->cpf, 'class' => 'form-control');
    $endereco = array('name' => 'endereco', 'type' => 'text', 'id' => 'endereco', 'value' => $perfil[0]->endereco, 'class' => 'form-control');
    $numero = array('name' => 'numero', 'type' => 'text', 'id' => 'numero', 'value' => $perfil[0]->numero, 'class' => 'form-control');
     $complemento = array('name' => 'compl', 'type' => 'text', 'id' => 'compl', 'value' => $perfil[0]->compl, 'class' => 'form-control');
     $bairro = array('name' => 'bairro', 'type' => 'text', 'id' => 'bairro', 'value' => $perfil[0]->bairro, 'class' => 'form-control');
     $cep = array('name' => 'cep', 'type' => 'text', 'id' => 'cep', 'value' => $perfil[0]->cep, 'class' => 'form-control');
     $cidade = array('name' => 'cidade', 'type' => 'text', 'id' => 'cidade', 'value' => $perfil[0]->cidade, 'class' => 'form-control');
     $estado = array('name' => 'estado', 'type' => 'text', 'id' => 'estado', 'value' => $perfil[0]->estado, 'class' => 'form-control');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>

     <?php echo form_open('area/gravar_alteracoes') . form_hidden('id',$perfil[0]->id); ?>
                             <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                             <?php echo form_label('Nome', 'nome') . form_input($nome); ?>
                               </div>
                           </div>
                              <div class="col-md-3"> 
                                <div class="form-group">
                              <?php echo form_label('Sobrenome', 'sobrenome') . form_input($sobrenome); ?> </div>     
                                    </div>
                                     <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Data de Nascimento', 'data_nasc') . form_input($data_nasc); ?> 
                               </div>
                           </div>
                           <div class="col-md-3"> 
                                <div class="form-group">
                                   <?php echo form_label('CPF', 'cpf') . form_input($cpf); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	  <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Telefone', 'telefone') . form_input($telefone); ?> 
                               </div>
                           </div>
                            	   <div class="col-md-3"> 
                                <div class="form-group">
                                   <?php echo form_label('WhatsApp', 'celular') . form_input($celular); ?>
                                    </div>
                                </div>
                             
                             <div class="col-md-3"> 
                                <div class="form-group">
                                     <?php echo form_label('E-mail', 'email') . form_input($email); ?> 
                                    </div>
                                </div>
                                 <div class="col-md-3"> 
                                <div class="form-group">
                                    <?php echo form_label('Senha', 'senha'); ?><br>
                    <a href="<?php echo base_url("area/alterar_senha/" . $perfil[0]->id) ?>" class="btn btn-primary btn-block" href="">Alterar Senha</a>
                                    </div>
                                </div>
                            </div>  
                             <div class="row">
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <?php echo form_label('CEP', 'cep') . form_input($cep); ?>
                                     </div>
                                 </div>
                            <div class="col-md-6"> 
                                <div class="form-group">
                                     <?php echo form_label('Endereço', 'endereco') . form_input($endereco); ?> 
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                <div class="form-group">
                                     <?php echo form_label('Número', 'numero') . form_input($numero); ?> 
                                    </div>
                                </div>

                            </div>     
                                  <div class="row">
                                      <div class="col-md-3">
                                          <div class="form-group">
                                              <?php echo form_label('Complemento', 'complemento') . form_input($complemento); ?>
                                          </div>
                                      </div>
                            	  <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Bairro', 'bairro') . form_input($bairro); ?> 
                               </div>
                           </div>

                             
                             <div class="col-md-3"> 
                                <div class="form-group">
                                     <?php echo form_label('Cidade', 'cidade') . form_input($cidade); ?> 
                                    </div>
                                </div>
                                 <div class="col-md-3"> 
                                <div class="form-group">
                                     <?php echo form_label('Estado', 'estado') . form_input($estado); ?> 
                                    </div>
                                </div>
                            </div>     
                                 <div class="row">
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="escolaridade">Escolaridade</label>                          
                             <select disabled class="form-control" name="escolaridade" id="escolaridade">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '1') echo 'selected'; ?>> Ensino Fundamental </option>
                            <option value="2" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '2') echo 'selected'; ?>> Ensino Médio </option>
                            <option value="3" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '3') echo 'selected'; ?>> Ensino Superior </option>
                            </select>       
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="perfil_so">Perfil</label>                            
                            <select disabled class="form-control" name="perfil_so" id="perfil_so">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->perfil_so) && $perfil[0]->perfil_so == '1') echo 'selected'; ?>> Surdo </option>
                            <option value="2" <?php if (isset($perfil[0]->perfil_so) && $perfil[0]->perfil_so == '2') echo 'selected'; ?>> Ouvinte </option>   
                             </select>                            
                        </div>    

                    <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="igreja">Faz parte de alguma igreja?</label>
                            <select disabled class="form-control" name="igreja" id="igreja">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '1') echo 'selected'; ?>> Evangélica </option>
                            <option value="2" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '2') echo 'selected'; ?>> Católica </option>
                            <option value="3" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '3') echo 'selected'; ?>> Outra </option>
                            </select>                          
                        </div>                                      
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="funcao">O que faz na sua igreja?</label>
                            <select disabled class="form-control" name="funcao" id="funcao">
                            <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->funcao) && $perfil[0]->funcao == '1') echo 'selected'; ?>> Pastor </option>
                            <option value="2" <?php if (isset($perfil[0]->funcao) && $perfil[0]->funcao == '2') echo 'selected'; ?>> Professor </option>
                            <option value="3" <?php if (isset($perfil[0]->funcao) && $perfil[0]->funcao == '3') echo 'selected'; ?>> Estudante </option>
                            </select>       
                        </div>                        
                    </div>                  
                    <div class="row">               
                    <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="saber">Como ficou sabendo de A Bíblia em Libras?</label>
                            <select disabled class="form-control" name="saber" id="saber">
                            <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '1') echo 'selected'; ?>> Google </option>
                            <option value="2" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '2') echo 'selected'; ?>> Facebook </option>
                            <option value="3" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '3') echo 'selected'; ?>> Indicação de Amigo </option>
                            </select>  
                        </div>                        
                   </div> 
             
       <?php echo form_submit($buttonPubl); ?> 
      
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
<br><br>


<script type="text/javascript">
    $(document).ready(function () {

        $('#cep').mask("00000-000");
        $("#data_nasc").mask("00/00/0000");
        $("#input-demo-numero").mask("00000");
        $("#telefone").mask("(00) 00000-0000");
        $("#celular").mask("(00) 00000-0000");
        $("#cpf").mask("000.000.000-00", {reverse: true});
        $("#data_nasc").mask("00/00/0000");

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
                        $("#cep").focus();
                    }
                });
        });

        $(document).on('click', '.status_checks', function () {
            var status = ($(this).hasClass("btn-success")) ? '0' : '1';
            var msg = (status === '0') ? 'Inativo' : 'Ativo';
            if (confirm("Tem certeza que quer alterar para " + msg + "?")) {
                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo base_url() . 'admin/usuarios/alterar_user_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id": id, "status": status},
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        });

    });

</script>
    </div>

</div>