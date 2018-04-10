    <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url("admin/livros") ?>"> <i class="fa fa-book fa-fw"></i> Livros</a> > Capítulos de <?php echo $livro[0]->titulo; ?> - <?php echo $livro[0]->ordem; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O capítulo foi adicionado com sucesso!</div>
            <?php } ?>
             <?php if($this->session->flashdata('video_sucesso')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O vídeo foi adicionado com sucesso!</div>
              <?php } ?>
            <?php if($this->session->flashdata('deletar_capitulo')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O capítulo foi deletado com sucesso!</div>
           <?php } ?>
           <?php if($this->session->flashdata('deletar_video')) { ?>
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
                           Configurar Capítulo</div>
                        <div class="panel-body">
                             <?php 
      $capitulo = array('name' => 'capitulo', 'type' => 'number', 'id' => 'capitulo', 'min'=> "1", 'max'=>'999', 'value' => set_value('capitulo'), 'class' => 'form-control', 'placeholder' => '0', 'required' => 'required');   
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

        <?php echo form_open('admin/livros/add_capitulo', 'role="form"'); ?>
        <input type="hidden" id="livro" name="livro" value="<?php echo $livro[0]->id_livro; ?>">
                             <div class="row">
                              <div class="col-md-6">
                                     <div class="form-group">
                    <!--          <select class="form-control" name="capitulo" id="capitulo">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      $count = $count_videos[0]->capitulos;
                                   for($i = 1; $i <= $count; $i++) { ?>
                                   <option value="<?php echo $i; ?>"> Capítulo <?php echo $i; ?></option>
                                       <?php } ?>
                                        </select> -->
                                <?php echo form_label('Capítulo', 'capitulo'); ?>
                               <div class="input-group">
                               <div class="input-group-addon"><?php echo $livro[0]->sigla; ?></div>
                                <?php echo form_input($capitulo); ?>
                           </div>
                                    </div>
                           </div>                           
                            </div>                          
                      
       <?php echo form_submit($buttonPubl); ?>     
          <?php form_close(); ?>                                                       
                           
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

     <?php $url = $this->uri->segment(4); ?>
      <div class="col-lg-6">
          <?php if (!empty($capitulos)): ?>         
    <?php foreach ($capitulos as $titulo): ?>
            <div id="<?php echo $titulo->id_capitulo; ?>" class="list-group-item list-group-item-info"><b style="font-size: 17px;"><?php echo $livro[0]->sigla; ?> <?php echo $titulo->capitulo; ?></b> 
      <div class="pull-right"><a class="btn btn-xs btn-danger" onclick="return confirmarExcluirCapitulo()" title="Remover Capítulo" href="<?php echo base_url("admin/livros/deletar_capitulo/" . $titulo->id_capitulo . "/" . $titulo->id_livro) ?>"><span class="glyphicon glyphicon-remove"></span></a></div></div>
            <div class="list-group">   
<?php $exibe_videos = $this->db->query("SELECT *, v.titulo as video, v.ordem as ordem_video FROM videos v INNER JOIN livros l on l.id_livro = v.id_livro WHERE l.id_livro = '{$url}' AND v.id_capitulo =  {$titulo->id_capitulo} AND l.status = 1 ORDER BY v.ordem"); ?>
       <?php foreach ($exibe_videos->result() as $video): ?>  
      <div class="list-group-item"><?php echo $video->ordem_video; ?> - <?php echo $video->video; ?> <div class="pull-right">
        <a class="btn btn-xs btn-warning" title="Remover Vídeo" onclick="return confirmarExcluirVideo()" href="<?php echo base_url("admin/livros/deletar_video/" . $video->id_video . "/" . $video->id_livro) ?>"><span class="glyphicon glyphicon-remove"></span></a> 
      </div></div>
          <?php endforeach; ?>  
          <div style="background: #EEE;" class="list-group-item">
<a class="btn btn-sm btn-primary" href="javascript:;" onclick="modalVideo(<?php echo $titulo->id_capitulo; ?>)"><span class="glyphicon glyphicon-plus"></span> Inserir Vídeo</a>
</div>       
    </div>       
  <?php endforeach; ?>
   </div>
   <?php else: ?>
        <div class="alert alert-info" role="alert">
    Nenhum capítulo neste momento.
            </div>
       <?php endif; ?>   
        
                </div>
                <!-- /.col-lg-12 -->
              </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


  <!-- Modal -->
  <div class="modal fade" id="modalVideo" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Inserir Vídeo</h4>
        </div>
        <div class="modal-body">
            <form></form>
          <form role="form" method="post" class="formulario" action="<?php echo base_url('admin/livros/salvar'); ?>" id="formulario_videos">
         <div class="form-group">
                                   <?php echo form_label('Vídeo', 'video') ?> <br>
                             <select class="form-control" name="id_video" id="id_video">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      foreach ($videos as $video): ?>
                    <option value="<?php echo $video->id_video; ?>"><?php echo $video->ordem; ?> - <?php echo $video->titulo; ?></option>
                                       <?php endforeach; ?>
                                        </select>
                                    </div>  
                                     <input type="hidden" name="id_capitulo" id="id_capitulo" value="" />
                                  <input type="hidden" name="id_livro" id="id_livro" value="" />
                         <button type="button" class="btn btn-primary" onclick="$('.formulario').submit();">Salvar</button>
                                 </form>
                                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>
  <script>
       $(function() {
                
                $('#modalVideo').on('show.bs.modal', function (e) {
                    $('.formulario').resetForm();
                });
                        
                $('.formulario').ajaxForm({
                    success: function (data) {
                        if (data == 1) {                           
                            document.location.href = document.location.href;
                        }
                    }
                });
            });

     var base_url = "<?php echo base_url(); ?>";
    
      function carregaDadosCapituloJSon(id_capitulo) {      
                $.post(base_url + 'admin/livros/dados_capitulos', {
                    id_capitulo: id_capitulo
                }, function (data) {
                    $('#id_livro').val(data.id_livro);
                    $('#id_capitulo').val(data.id_capitulo);                   
                }, 'json');
            }

   function modalVideo(id_capitulo) {             
                 if (id_capitulo != null) {                
                    carregaDadosCapituloJSon(id_capitulo);
                }
                $('#modalVideo').modal('show');
            }
  </script>

<script type="text/javascript">

    $(document).ready(function () {    

    $("#capitulos").mask("00");    

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
    
        
    });

</script>
