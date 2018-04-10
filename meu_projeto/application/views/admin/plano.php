<div id="page-wrapper">
            <div class="row">
 <?php echo $this->session->userdata('nome'); ?>
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-file fa-fw"></i> Planos</h3>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O plano foi adicionado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O plano foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Plano</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');  
  $duracao = array('name' => 'duracao', 'id' => 'duracao', 'type' => 'number', 'value' => set_value('duracao'), 'class' => 'form-control', 'placeholder' => '0');  
    $valor = array('name' => 'valor', 'type' => 'text', 'id' => 'valor', 'value' => set_value('valor'), 'class' => 'form-control', 'placeholder' => '0,00');    
   $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => '000', 'class' => 'form-control', 'placeholder' => '000');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open_multipart('admin/plano/gravarPlano', 'role="form"'); ?>
                             <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Título', 'titulo') . form_input($titulo); ?>
                               </div>
                           </div>                           
                                 <div class="col-md-6"> 
                                <div class="form-group">
                                            <label>Ordem (Apenas números)</label>
                                            <?php echo form_input($ordem); ?>                                            
                                        </div>     
                                    </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6"> 
                                <div class="form-group">
                                     <?php echo form_label('Imagem', 'imagem') ?>
                                    <input name="userfile" class="form-control" type="file" />
                                    </div>
                                </div>
                              <div class="col-md-6">  
                                <div class="form-group">
                               <label>Valor</label>
                               <div class="input-group">
                               <div class="input-group-addon">R$</div>
                                <?php echo form_input($valor); ?>
                           </div>
                               </div>
                           </div>
                            </div>  
                                   <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Duração', 'duracao') . form_input($duracao); ?>
                               </div>
                           </div>                           
                                 <div class="col-md-6"> 
                                <div class="form-group">
                                        <?php echo form_label('Período', 'periodo'); ?>  
                                         <select class="form-control" name="periodo" id="periodo">
                                        <option value="0">Selecione</option>
                                        <option value="year">ano</option>
                                        <option value="mounth">meses</option>
                                        <option value="day">dias</option>
                            </select>
                                        </div>     
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_plano; ?> <?php plural($count_plano, 'Plano', 'Planos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Ordem</th>
                                        <th>Título</th>
                                        <th>Imagem</th>
                                        <th>Valor</th>
                                        <th>Duração</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($planos)): ?>                    
                            <?php foreach ($planos as $plano): ?>
                                <tr class="odd gradeX">                               
       <td class="text-center"><?php echo form_hidden($plano->id_plano); ?><?php echo $plano->ordem; ?></td>
                                       <td><?php echo $plano->titulo; ?></td>  
    <td class="text-center">
       <?php if(isset($plano->imagem) && $plano->imagem != null): ?>
       <img class="exibeImg" src="<?php echo base_url('assets/uploads/' . $plano->imagem); ?>" id="img_upload" alt="" />   
    <a href="<?php echo base_url('admin/plano/alterar_imagem/' . $plano->id_plano); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Imagem</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/plano/alterar_imagem/' . $plano->id_plano); ?>" title="Editar" class="btn btn-sm btn-primary">Inserir Imagem</a>
 <?php endif; ?>     
    </td>
                                        <td class="text-center"><?php echo reais($plano->valor); ?></td>  
                                          <td class="text-center">
                                              <?php echo $plano->duracao; ?> <?php echo FormPeriodo($plano->periodo); ?>
                                          </td>
                                            <td class="text-center">
       <b data="<?php echo $plano->id_plano; ?>" class="status_checks btn btn-sm <?php echo ($plano->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($plano->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
            <a href="<?php echo base_url('admin/plano/alterar/' . $plano->id_plano); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/plano/deletar/' . $plano->id_plano); ?>" onclick="return confirmarExclusao(<?php echo $plano->id_plano; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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


<script type="text/javascript">

var el = document.getElementById('ordem');
var updatetext = function(){
  el.value = ('000' + el.value).slice(-3);
}
  
el.addEventListener("keyup", updatetext , false); 

    $(document).ready(function () {

    $('#valor').mask('0000,00', {reverse: true});

      $("#duracao").mask("000");

      

      Shadowbox.init();


        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/plano/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_plano": id, "status": status},
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