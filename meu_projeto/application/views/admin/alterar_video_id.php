<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
               <h3 class="page-header"><a href="<?php echo base_url("admin/livros") ?>">Livros</a> > <a href="<?php echo base_url("admin/livros/videos/" . $video[0]->id_livro) ?>">Vídeos</a> > <?php echo $video[0]->titulo; ?> - ID <?php echo $video[0]->id_video; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O vídeo foi alterado com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Alterar Vídeo
                        </div>
                        <div class="panel-body">
                             <?php 
    $titulo = array('name' => 'titulo', 'type' => 'text', 'id' => 'titulo', 'value' => $video[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
    $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => $video[0]->ordem, 'class' => 'form-control', 'placeholder' => '000');
    $capitulo = array('name' => 'id_capitulo', 'type' => 'number', 'id' => 'id_capitulo', 'min'=>'1', 'max'=>'50', 'value' => $video[0]->id_capitulo, 'class' => 'form-control', 'placeholder' => '0');
     $conteudo = array('name' => 'editor1', 'id' => 'editor1', 'value' => $video[0]->conteudo, 'rows' => '10', 'cols' => '80'); 
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>
     <?php echo form_open('admin/livros/gravar_alteracoes_video') . form_hidden('id_video',$video[0]->id_video); ?>
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
                                   <?php echo form_label('Capítulo', 'id_capitulo') ?> <br>
                             <select class="form-control" name="id_capitulo" id="id_capitulo">
                                   <option value="0">Selecione</option>    
                                   <?php     
                                      $count = $count_videos[0]->capitulos;
                                   for($i = 1; $i <= $count; $i++) { ?>
         <option <?php echo $i == $video[0]->id_capitulo ? 'selected' : '' ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                       <?php } ?>
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

    $('#valor').mask('0000,00', {reverse: true});

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