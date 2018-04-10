<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
<h3 class="page-header"><a href="<?php echo base_url('admin/livros'); ?>"> <i class="fa fa-book fa-fw"></i> Livros</a> > Vídeos:  
  <?php echo $titulo_livro[0]->titulo; ?> </h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O vídeo foi adicionado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O vídeo foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <button class="btn btn-info" id="cadastro_livro">Cadastrar Vídeo</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'titulo', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');
    $conteudo = array('name' => 'editor1', 'type' => 'text', 'id' => 'editor1', 'value' => set_value('editor1'), 'class' => 'form-control', 'rows' => '3');
   $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => '000', 'class' => 'form-control', 'placeholder' => '000');
      $capitulo = array('name' => 'id_capitulo', 'type' => 'number', 'id' => 'id_capitulo', 'min'=>'1', 'max'=>'999', 'value' => set_value('capitulo'), 'class' => 'form-control', 'placeholder' => '0');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>
<?php $url = $this->uri->segment(4); ?>
  <?php echo form_open_multipart('admin/videos/adicionarVideo') . form_hidden('id_livro', $url); ?>
  
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
                                     <?php echo form_label('Vídeo', 'video') ?> <br>
                                   <textarea class="form-control" name="video" id="video" cols="66" rows="5"></textarea>
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
                    <div class="panel panel-default overHorizontal">
                        <div class="panel-heading">
                           <?php echo $count_capitulos; ?> <?php plural($count_capitulos, 'Vídeo', 'Vídeos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <th>Ordem</th>
                                        <th>Título</th>
                                        <th>Vídeo</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($videos)): ?>                    
                            <?php foreach ($videos as $video): ?>
                                <tr class="odd gradeX">
                                  <td class="text-center"><?php echo $video->ordem; ?></td>
                                        <td><?php echo $video->titulo; ?><?php echo form_hidden($video->id_video); ?></td>                                       
                                        <!--  <td class="text-center">
                                          <?php if($video->id_capitulo != 0): ?>
                                          <?php echo $titulo_livro[0]->sigla; ?> <?php echo $video->id_capitulo; ?>
                                            <?php else: ?>
                                              Sem capítulo
                                            <?php endif; ?>
                                          </td>  -->
                                          <td class="text-center">
     <?php if(isset($video->video) && $video->video != null): ?>
          <a href="<?php echo base_url('admin/livros/alterar_video/' . $video->id_video); ?>" title="Editar Vídeo" class="btn btn-sm btn-success">Alterar Vídeo</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/livros/alterar_video/' . $video->id_video); ?>" title="Editar" class="btn btn-sm btn-primary">Inserir Vídeo</a>
 <?php endif; ?>
                                          </td>
                                                  
                                            <td class="text-center">
       <b data="<?php echo $video->id_video; ?>" class="status_checks btn btn-sm <?php echo ($video->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($video->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
            <a href="<?php echo base_url('admin/livros/alterar_video_id/' . $video->id_video); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/livros/deletar_video/' . $video->id_video); ?>" onclick="return confirmarExclusao(<?php echo $video->id_video; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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

  var el = document.getElementById('ordem');
var updatetext = function(){
  el.value = ('000' + el.value).slice(-3);
}

el.addEventListener("keyup", updatetext , false); 
  
    $(document).ready(function () {

      $('#valor').mask('0.000,00', {reverse: true});

      $("#id_capitulo").mask("000");

      Shadowbox.init();

      //  CKEDITOR.replace('editor1');

        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/livros/alterar_video_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_video": id, "status": status},
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