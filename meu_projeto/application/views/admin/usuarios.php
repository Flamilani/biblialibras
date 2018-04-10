<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"> <i class="fa fa-user fa-fw"></i> Usuários</h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O usuário foi adicionado com sucesso!</div>
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
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Usuário</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $nome = array('name' => 'nome', 'id' => 'nome', 'type' => 'text', 'value' => set_value('nome'), 'class' => 'form-control', 'placeholder' => 'Nome');
    $sobrenome = array('name' => 'sobrenome', 'type' => 'text', 'id' => 'sobrenome', 'value' => set_value('sobrenome'), 'class' => 'form-control', 'placeholder' => 'Sobrenome');
    $email = array('name' => 'email', 'type' => 'email', 'id' => 'email', 'value' => set_value('email'), 'class' => 'form-control', 'placeholder' => 'E-mail');
     $senha = array('name' => 'senha', 'type' => 'password', 'id' => 'senha', 'class' => 'form-control', 'placeholder' => 'Senha');
    $telefone = array('name' => 'telefone', 'type' => 'tel', 'id' => 'telefone', 'value' => set_value('telefone'), 'class' => 'form-control', 'placeholder' => 'Telefone');
    $celular = array('name' => 'celular', 'type' => 'tel', 'id' => 'celular', 'value' => set_value('celular'), 'class' => 'form-control', 'placeholder' => 'WhastApp'); 
    $data_nasc = array('name' => 'data_nasc', 'type' => 'data', 'id' => 'data_nasc', 'value' => set_value('data_nasc'), 'class' => 'form-control', 'placeholder' => 'Data de Nascimento');
    $cpf = array('name' => 'cpf', 'type' => 'text', 'id' => 'cpf', 'value' => set_value('cpf'), 'class' => 'form-control', 'placeholder' => 'Número de CPF');
    $endereco = array('name' => 'endereco', 'type' => 'text', 'id' => 'endereco', 'value' => set_value('endereco'), 'class' => 'form-control', 'placeholder' => 'Endereço');
    $numero = array('name' => 'numero', 'type' => 'text', 'id' => 'numero', 'value' => set_value('numero'), 'class' => 'form-control', 'placeholder' => 'Número');
     $complemento = array('name' => 'compl', 'type' => 'text', 'id' => 'compl', 'value' => set_value('compl'), 'class' => 'form-control', 'placeholder' => 'Complemento');
     $bairro = array('name' => 'bairro', 'type' => 'text', 'id' => 'bairro', 'value' => set_value('bairro'), 'class' => 'form-control', 'placeholder' => 'Bairro');
     $cep = array('name' => 'cep', 'type' => 'text', 'id' => 'cep', 'value' => set_value('cep'), 'class' => 'form-control', 'placeholder' => 'CEP');
     $cidade = array('name' => 'cidade', 'type' => 'text', 'id' => 'cidade', 'value' => set_value('cidade'), 'class' => 'form-control', 'placeholder' => 'Cidade');
     $estado = array('name' => 'estado', 'type' => 'text', 'id' => 'estado', 'value' => set_value('estado'), 'class' => 'form-control', 'placeholder' => 'Estado');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open('admin/usuarios/adicionarUsuario', 'role="form"'); ?>
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
                                     <?php echo form_label('Senha', 'senha') . form_input($senha); ?> 
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
                            <label for="saber">Qual usa mais para acessar no site?</label>
                            <select class="form-control" name="acesso" id="acesso">
                                <option value="0">Selecione</option>
                                <option value="1">Celular</option>
                                <option value="2">Tablet</option>
                                <option value="3">Notebook</option>
                                <option value="4">Computador</option>
                            </select>
                        </div>
                    </div>
             
       <?php echo form_submit($buttonPubl); ?>
       <?php echo form_submit($button); ?>
      <?php form_close(); ?>          
                                                      
                           
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->

              <!-- /.row -->
                  <?php $rowsPlanoQtd = $this->db->query("SELECT * FROM planos ps INNER JOIN plano p ON ps.id_planos = p.id_planos INNER JOIN assinaturas a ON a.id_plano = p.id_plano"); ?>
         <?php $resPqtd = $rowsPlanoQtd->result(); ?>
              <h3 class="text-center"><span class="label label-warning"> <?php echo $count_cadastrados; ?> <?php plural($count_cadastrados, 'Inativo', 'Inativos') ?></span>
            <span class="label label-success">   <?php echo $count_usuarios; ?> <?php plural($count_usuarios, 'Ativo', 'Ativos') ?></span>
            <span class="label label-info">   <?php echo count($resPqtd); ?> <?php plural(count($count_usuarios), 'Plano', 'Planos') ?></span>
        </h3><br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_users; ?> <?php plural($count_users, 'Cadastrado', 'Cadastrados') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table style="font-size: 14px;" width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Contato</th>
                                        <th>Registro</th>
                                        <th>Plano</th>
                                        <th>Termos</th>
                                        <th>Acesso</th>
                                        <th>Status</th>
                                        <th>Detalhes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users)): ?>                    
                            <?php foreach ($users as $user): ?>
                                <tr class="odd gradeX">
                          <td><?php echo zerofill($user->id); ?><?php echo form_hidden($user->id); ?></td>                                                 
                                       <td><?php echo $user->nome; ?> <?php echo $user->sobrenome; ?></td>
                                        <td class="text-center"><?php echo $user->email; ?><br><?php echo $user->celular; ?></td>
                                        <td class="text-center"><?php echo FormDataP($user->registro); ?><br><?php echo FormHora($user->registro); ?></td>
                                        <td class="text-center">
    <?php $rowsPlano = $this->db->query("SELECT * FROM planos ps INNER JOIN plano p ON ps.id_planos = p.id_planos INNER JOIN assinaturas a ON a.id_plano = p.id_plano WHERE a.id_user = '{$user->id}' ORDER BY a.id_assinatura DESC LIMIT 1"); ?>
         <?php $resP = $rowsPlano->result(); ?>
                                        <?php if(isset($resP[0]->nome_plano) && $resP[0]->nome_plano != ''):
                                                echo $resP[0]->nome_plano . '<br />';
                                        echo '(' . $resP[0]->duracao . ' ';
                                        echo FormPeriodo($resP[0]->periodo) . ')'; ?>
                                       <?php else: ?>
                                                <span style="font-size: 12px;" class="label label-danger">Sem Plano</span>
                                       <?php endif; ?>
                                        </td>
                                    <td class="text-center"><?php echo FormTermosLabel($user->termos); ?></td>
                                    <td class="text-center"><?php echo FormPerfilLabel($user->perfil); ?></td>
                                    <td class="text-center">
       <b data="<?php echo $user->id; ?>" class="status_checks btn btn-xs <?php echo ($user->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($user->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
            <a href="<?php echo base_url('admin/usuarios/perfil/' . $user->id); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

                                      </td>
                                    </tr>   
                                         <?php endforeach; ?>
                                      <?php endif; ?>                
                                   </tbody>
                            </table>
                             </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
        
          $('.tabela').DataTable({
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