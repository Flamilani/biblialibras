<div id="page-wrapper">
            <div class="row">
 <?php echo $this->session->userdata('nome'); ?>
                <div class="col-lg-12">
                    <h3 class="page-header">Livros</h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O livro foi adicionado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O livro foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Livro</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'titulo', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');
    $valor = array('name' => 'valor', 'type' => 'text', 'id' => 'valor', 'value' => set_value('valor'), 'class' => 'form-control', 'placeholder' => '0,00');
    $conteudo = array('name' => 'editor1', 'type' => 'text', 'id' => 'editor1', 'value' => set_value('editor1'), 'class' => 'form-control', 'rows' => '3');
   $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => set_value('ordem'), 'class' => 'form-control', 'placeholder' => '0');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open_multipart('admin/livros/gravarLivros', 'role="form"'); ?>
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
                             <div class="col-lg-12 col-md-12">  
        <div class="form-group">             
                 <?php echo form_label('Conteúdo', 'editor1') . form_textarea($conteudo); ?>
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
                           <?php echo $count_livros; ?> <?php plural($count_livros, 'Livro', 'Livros') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Conteúdo</th>
                                        <th>Capítulos</th>
                                        <th>Valor</th>
                                        <th>Ordem</th>
                                        <th>Imagem</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($livros)): ?>                    
                            <?php foreach ($livros as $livro): ?>
 <?php $rowsCap = $this->db->query("SELECT * FROM videos WHERE id_livro = {$livro->id_livro}"); ?>
                     <?php $countCap = $rowsCap->result(); ?>
                                <tr class="odd gradeX">
                                <td><?php echo $livro->id_livro; ?><?php echo form_hidden($livro->id_livro); ?></td>
                                        <td><?php echo $livro->titulo; ?></td>
                                        <td><?php echo $livro->conteudo; ?></td>
    <td class="text-center"><a class="btn btn-sm btn-primary" href="<?php echo base_url('admin/livros/capitulos/' . $livro->id_livro . '/' . clear($livro->titulo)); ?>"><?php echo count($countCap); ?> <?php plural(count($countCap), 'capítulo', 'capítulos') ?></a></td>
                                        <td class="text-center"><?php echo reais($livro->valor); ?></td>
                                          <td class="text-center"><?php echo $livro->ordem; ?></td>
                                          <td class="text-center">
     <?php if(isset($livro->imagem) && $livro->imagem != null): ?>
       <img class="exibeImg" src="<?php echo base_url('assets/uploads/' . $livro->imagem); ?>" id="img_upload" alt="" />   
    <a href="<?php echo base_url('admin/livros/alterar_imagem/' . $livro->id_livro); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Imagem</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/livros/alterar_imagem/' . $livro->id_livro); ?>" title="Editar" class="btn btn-sm btn-primary">Inserir Imagem</a>
 <?php endif; ?>
                                          </td>
                                            <td class="text-center">
       <b data="<?php echo $livro->id_livro; ?>" class="status_checks btn btn-sm <?php echo ($livro->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($livro->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
            <a href="<?php echo base_url('admin/livros/alterar/' . $livro->id_livro); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/livros/deletar/' . $livro->id_livro); ?>" onclick="return confirmarExclusao(<?php echo $livro->id_livro; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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

      $('#valor').mask('0.000,00', {reverse: true});

      Shadowbox.init();

        CKEDITOR.replace('editor1');

        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/livros/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_livro": id, "status": status},
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