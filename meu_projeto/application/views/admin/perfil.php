<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h3 class="page-header"><a href="<?php echo base_url("admin/usuarios") ?>">Usuários</a> > Perfil: <?php echo $perfil[0]->nome; ?> <?php echo $perfil[0]->sobrenome; ?> - ID <?php echo zerofill($perfil[0]->id); ?> 
                       <div class="pull-right"><?php echo FormPerfilLabel($perfil[0]->perfil); ?></div></h3> 
 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O usuário foi atualizado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O usuário foi deletado com sucesso!</div>
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
                         Editar Usuário  <b style="font-size: 15px;" class="pull-right label <?php echo ($perfil[0]->status) ? 'label-success' : 'label-warning' ?>"><?php echo ($perfil[0]->status) ? 'Ativo' : 'Inativo' ?></b>
                        </div>
                        <div class="panel-body">
  <?php $nome = array('name' => 'nome', 'id' => 'nome', 'type' => 'text', 'nome', 'value' => $perfil[0]->nome, 'class' => 'form-control');
    $sobrenome = array('name' => 'sobrenome', 'type' => 'text', 'id' => 'sobrenome', 'value' => $perfil[0]->sobrenome, 'class' => 'form-control');
    $email = array('name' => 'email', 'type' => 'email', 'id' => 'email', 'value' => $perfil[0]->email, 'class' => 'form-control', 'placeholder' => 'E-mail');
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

     <?php echo form_open('admin/usuarios/gravar_alteracoes') . form_hidden('id',$perfil[0]->id); ?>
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
                    <a href="<?php echo base_url("admin/usuarios/alterar_senha/" . $perfil[0]->id) ?>" class="btn btn-primary btn-block" href="">Alterar Senha</a>
                                    </div>
                                </div>
                            </div>  
                             <div class="row">
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
                                    <div class="col-md-3"> 
                                <div class="form-group">
                                     <?php echo form_label('Complemento', 'complemento') . form_input($complemento); ?> 
                                    </div>
                                </div>
                            </div>     
                                  <div class="row">
                            	  <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Bairro', 'bairro') . form_input($bairro); ?> 
                               </div>
                           </div>
                            	   <div class="col-md-3"> 
                                <div class="form-group">
                                   <?php echo form_label('CEP', 'cep') . form_input($cep); ?>
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
                             <select class="form-control" name="escolaridade" id="escolaridade">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '1') echo 'selected'; ?>> Ensino Fundamental </option>
                            <option value="2" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '2') echo 'selected'; ?>> Ensino Médio </option>
                            <option value="3" <?php if (isset($perfil[0]->escolaridade) && $perfil[0]->escolaridade == '3') echo 'selected'; ?>> Ensino Superior </option>
                            </select>       
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="perfil_so">Perfil</label>                            
                            <select class="form-control" name="perfil_so" id="perfil_so">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->perfil_so) && $perfil[0]->perfil_so == '1') echo 'selected'; ?>> Surdo </option>
                            <option value="2" <?php if (isset($perfil[0]->perfil_so) && $perfil[0]->perfil_so == '2') echo 'selected'; ?>> Ouvinte </option>   
                             </select>                            
                        </div>    

                    <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="igreja">Faz parte de alguma igreja?</label>
                            <select class="form-control" name="igreja" id="igreja">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '1') echo 'selected'; ?>> Evangélica </option>
                            <option value="2" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '2') echo 'selected'; ?>> Católica </option>
                            <option value="3" <?php if (isset($perfil[0]->igreja) && $perfil[0]->igreja == '3') echo 'selected'; ?>> Outra </option>
                            </select>                          
                        </div>                                      
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3">
                            <label for="funcao">O que faz na sua igreja?</label>
                            <select class="form-control" name="funcao" id="funcao">
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
                            <select class="form-control" name="saber" id="saber">
                            <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '1') echo 'selected'; ?>> Google </option>
                            <option value="2" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '2') echo 'selected'; ?>> Facebook </option>
                            <option value="3" <?php if (isset($perfil[0]->saber) && $perfil[0]->saber == '3') echo 'selected'; ?>> Indicação de Amigo </option>
                            </select>  
                        </div>
                        <div class="form-group controls col-xs-12 col-md-3 col-lg-3 pull-right">
                            <label for="perfil">Acesso</label>                            
                            <select class="form-control" name="perfil" id="perfil">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($perfil[0]->perfil) && $perfil[0]->perfil == '1') echo 'selected'; ?>> Admin </option>
                            <option value="2" <?php if (isset($perfil[0]->perfil) && $perfil[0]->perfil == '2') echo 'selected'; ?>> Usuário </option>   
                             </select>                            
                        </div>    
                   </div> 
             
       <?php echo form_submit($buttonPubl); ?>
       <?php echo form_submit($button); ?>
       <a href="<?php echo base_url('admin/usuarios/deletar/' . $perfil[0]->id); ?>" onclick="return confirmarExclusao(<?php echo $perfil[0]->id; ?>)" title="Deletar" class="btn btn-danger pull-right"><b>Deletar <i class="fa fa-trash-o"></i></b></a>
      
                                                      
                           
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
<br><br>
<!-- Uso de Modal-->
<?php require_once('modal/modal_deletar.php'); ?>
<!-- Uso de Modal-->

<script type="text/javascript">
    $(document).ready(function () {

         $('#cep').mask("00000-000");
         $("#data_nasc").mask("00/00/0000");
         $("#input-demo-numero").mask("00000");
         $("#telefone").mask("(00) 0000-0000");
         $("#celular").mask("(00) 00000-0000");
         $("#cpf").mask("000.000.000-00", {reverse: true});
         $("#data_nasc").mask("00/00/0000"); 


        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/usuarios/alterar_user_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id": id, "status": status},
                success: function (data) {
                    location.reload();
                }});
        }
    });

           var base_url = "<?= base_url(); ?>";
    
    $(function () {
        $('.confirma_exclusao').on('click', function (e) {
            e.preventDefault();

            var nome = $(this).data('nome');
            var id = $(this).data('id');

            $('#modal_confirmation').data('nome', nome);
            $('#modal_confirmation').data('id', id);
            $('#modal_confirmation').modal('show');
        });

        $('#modal_confirmation').on('show.bs.modal', function () {
            var nome = $(this).data('nome');
            $('#nome_exclusao').text(nome);
            var id = $(this).data('id');
            $('#id_exclusao').text(id);
        });

        $('#btn_excluir').click(function () {
            var id = $('#modal_confirmation').data('id');
            document.location.href = base_url + "admin/posts/deletar/" + id;
        });
    });
        
          $('.tabela1').DataTable({
            language: {
                processing: "Processando",
                search: "Pesquisa",
                lengthMenu: "Exibindo _MENU_ registros",
                info: "Exibição de registro _START_ a _END_ em _TOTAL_ registros",
                infoEmpty: "Exibição de registros 0 &agrave; 0 em 0 registros",
                infoFiltered: "(Filtrado de _MAX_ registros em total)",
                infoPostFix: "",
                loadingRecords: "Carregando...",
                zeroRecords: "Nenhum registro a exibir.",
                emptyTable: "Não há registros disponíveis na tabela",
                paginate: {
                    first: "<<",
                    previous: "<",
                    next: ">",
                    last: ">>"
                },
                aria: {
                    sortAscending: ": Permite classificar a coluna em ordem crescente",
                    sortDescending: ": Permite classificar a coluna em ordem decrescente"
                }
            }
        });
    });

</script>