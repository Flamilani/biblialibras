  <div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url("admin/livros") ?>">Livros</a> > Capítulos de <?php echo $livro[0]->titulo; ?> - ID <?php echo $livro[0]->id_livro; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O capítulo foi alterado com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Configurar Capítulo
                        </div>
                        <div class="panel-body">
                             <?php 
    $titulo = array('name' => 'titulo', 'type' => 'text', 'id' => 'titulo', 'value' => $livro[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
    $valor = array('name' => 'valor', 'id' => 'valor', 'value' => $livro[0]->valor, 'class' => 'form-control', 'placeholder' => '0,00');    
    $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => $livro[0]->ordem, 'class' => 'form-control', 'placeholder' => '0');
    $capitulo = array('name' => 'capitulos', 'type' => 'number', 'id' => 'capitulos', 'min'=>'1', 'max'=>'50', 'value' => $livro[0]->capitulos, 'class' => 'form-control', 'placeholder' => '0');
     $conteudo = array('name' => 'editor1', 'id' => 'editor1', 'value' => $livro[0]->conteudo, 'rows' => '10', 'cols' => '80'); 
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>
     <?php echo form_open('admin/livros/gravar_alteracoes') . form_hidden('id_livro',$livro[0]->id_livro); ?>
                             <div class="row">
                              <div class="col-md-6">
                                     <div class="form-group">
                                   <?php echo form_label('Capítulo', 'id_capitulo') ?> <br>
                             <select class="form-control" name="id_capitulo" id="id_capitulo">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      $count = $count_videos[0]->capitulos;
                                   for($i = 1; $i <= $count; $i++) { ?>
                                   <option value="<?php echo $i; ?>"> Capítulo <?php echo $i; ?></option>
                                       <?php } ?>
                                        </select>
                                    </div>
                           </div>
                              <div class="col-md-6"> 
                               <div class="form-group">
                                   <?php echo form_label('Vídeo', 'video') ?> <br>
                             <select class="form-control" name="id_video" id="id_video">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      foreach ($videos as $video): ?>
                    <option value="<?php echo $video->id_video; ?>"><?php echo $video->titulo; ?></option>
                                       <?php endforeach; ?>
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

     <?php $url = $this->uri->segment(4); ?>
      <div class="col-lg-6">
        
    <?php foreach ($capitulos as $titulo): ?>
            <div id="<?php echo $titulo->id_capitulo; ?>" class="list-group-item list-group-item-info"><b style="font-size: 17px;">Capítulo <?php echo $titulo->capitulo; ?></b> 
      <div class="pull-right"><a class="btn btn-xs btn-danger" title="Remover" href="<?php echo base_url("admin/livros/deletar_capitulo/" . $titulo->id_capitulo) ?>"><span class="glyphicon glyphicon-remove"></span></a></div></div>
            <div class="list-group">   
<?php $exibe_videos = $this->db->query("SELECT * FROM livros l INNER JOIN videos v on l.id_livro = v.id_livro WHERE l.id_livro = '{$url}' AND v.id_capitulo =  {$titulo->capitulo} AND l.status = 1"); ?>
       <?php foreach ($exibe_videos->result() as $video): ?>  
      <div class="list-group-item"><?php echo $video->titulo; ?></div>

          <?php endforeach; ?>         
    </div>
  <?php endforeach; ?>
         </div>
                </div>
                <!-- /.col-lg-12 -->

              </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


<script type="text/javascript">
    $(document).ready(function () {

    $('#valor').mask('0000,00', {reverse: true});

    $("#capitulos").mask("00");

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
    
        
    });

</script>
