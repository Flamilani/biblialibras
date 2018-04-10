<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
             <h3 class="page-header"><a href="<?php echo base_url("admin/sociais") ?>">Redes Sociais</a> > social <?php echo $social[0]->titulo; ?> - ID <?php echo $social[0]->id_social; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A rede social foi atualizada com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Alterar Social
                        </div>
                        <div class="panel-body">
                             <?php 
    $titulo = array('name' => 'titulo', 'type' => 'text', 'id' => 'titulo', 'value' => $social[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
    $link = array('name' => 'link', 'type' => 'url', 'id' => 'link', 'value' => $social[0]->link, 'class' => 'form-control', 'placeholder' => 'Link');
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>
     <?php echo form_open('admin/sociais/gravar_alteracoes') . form_hidden('id_social',$social[0]->id_social); ?>
                             <div class="row">
                                   <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Título', 'titulo') . form_input($titulo); ?>
                               </div>
                           </div>
                             <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Link', 'link') . form_input($link); ?>
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
                </div>
                <!-- /.col-lg-12 -->

              </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


<script type="text/javascript">


    $(document).ready(function () {

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
            url = "<?php echo base_url() . 'admin/sociais/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_social": id, "status": status},
                success: function (data) {
                    location.reload();
                }});
        }
    });

           var base_url = "<?= base_url(); ?>";    
    
        
    });

</script>