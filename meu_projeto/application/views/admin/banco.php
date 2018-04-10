<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                     <h3 class="page-header"><i class="fa fa-credit-card fa-fw"></i> Dados Bancários</h3> 
 
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O dado bancário foi atualizado com sucesso!</div>
                  <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>                 
            <div class="row">
                 <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                         Editar Dados Bancários <b style="font-size: 15px;" class="pull-right label <?php echo ($banco[0]->banco_status) ? 'label-success' : 'label-warning' ?>"><?php echo ($banco[0]->banco_status) ? 'Ativo' : 'Inativo' ?></b>
                        </div>
                        <div class="panel-body">
  <?php $banco_nome = array('name' => 'banco_nome', 'id' => 'banco_nome', 'type' => 'text', 'value' => $banco[0]->banco_nome, 'class' => 'form-control');
    $favorecido = array('name' => 'favorecido', 'type' => 'text', 'id' => 'favorecido', 'value' => $banco[0]->banco_favorecido, 'class' => 'form-control');
    $agencia = array('name' => 'agencia', 'type' => 'text', 'id' => 'agencia', 'value' => $banco[0]->banco_agencia, 'class' => 'form-control');
    $conta = array('name' => 'conta', 'type' => 'text', 'id' => 'conta', 'value' => $banco[0]->banco_conta, 'class' => 'form-control');
    $digito = array('name' => 'digito', 'type' => 'text', 'id' => 'digito', 'value' => $banco[0]->banco_digito, 'class' => 'form-control');
     $operacao = array('name' => 'operacao', 'type' => 'text', 'id' => 'operacao', 'value' => $banco[0]->banco_operacao, 'class' => 'form-control');
     $tipo = array('name' => 'tipo', 'type' => 'text', 'id' => 'tipo', 'value' => $banco[0]->banco_conta_tipo, 'class' => 'form-control');    
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>

     <?php echo form_open('admin/banco/gravar_alteracoes') . form_hidden('banco_id',$banco[0]->banco_id); ?>
                             <div class="row">
                              <div class="col-md-3">
                                <div class="form-group">
                             <?php echo form_label('Nome do Banco', 'banco_nome') . form_input($banco_nome); ?>
                               </div>
                           </div>
                              <div class="col-md-3"> 
                                <div class="form-group">
                              <?php echo form_label('Favorecido', 'favorecido') . form_input($favorecido); ?> </div>     
                                    </div>
                                     <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Agência', 'agencia') . form_input($agencia); ?> 
                               </div>
                           </div>
                           <div class="col-md-3"> 
                                <div class="form-group">
                                   <?php echo form_label('Conta', 'conta') . form_input($conta); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            	  <div class="col-md-3">  
                                <div class="form-group">
                                <?php echo form_label('Digíto', 'digito') . form_input($digito); ?> 
                               </div>
                           </div>
                            	   <div class="col-md-3"> 
                                <div class="form-group">
                                   <?php echo form_label('Operação', 'operacao') . form_input($operacao); ?>
                                    </div>
                                </div>                             
                             
                                 <div class="col-md-3"> 
                                <div class="form-group">
                                      <label for="tipo">Tipo de Conta</label>                            
                            <select class="form-control" name="tipo" id="tipo">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="1" <?php if (isset($banco[0]->banco_conta_tipo) && $banco[0]->banco_conta_tipo == '1') echo 'selected'; ?>> Corrente </option>
                            <option value="2" <?php if (isset($banco[0]->banco_conta_tipo) && $banco[0]->banco_conta_tipo == '2') echo 'selected'; ?>> Poupança </option>   
                             </select>                           
                                    </div>
                                </div>
                            </div>                  
                       
       <?php echo form_submit($buttonPubl); ?>
       <?php echo form_submit($button); ?>
      <!--  <a href="<?php echo base_url('admin/banco/deletar/' . $perfil[0]->id); ?>" onclick="return confirmarExclusao(<?php echo $perfil[0]->id; ?>)" title="Deletar" class="btn btn-danger pull-right"><b>Deletar <i class="fa fa-trash-o"></i></b></a> -->
      
                                                      
                           
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
            url = "<?php echo base_url() . 'admin/banco/alterar_user_status' ?>";
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