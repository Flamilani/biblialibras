<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url("admin/sociais") ?>">Redes Sociais</a> > Ícone de <?php echo $social[0]->titulo; ?> - ID <?php echo $social[0]->id_social; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if(isset($social[0]->icone) && $social[0]->icone != null): ?>

             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O ícone foi alterado com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">                         
                             Alterar Ícone                          
                        </div>
                        <div class="panel-body">
                
     <?php echo form_open_multipart('admin/sociais/gravar_icone') . form_hidden('id_social',$social[0]->id_social); ?>
      <div class="row">
                               
                                    <input name="titulo" class="form-control" type="hidden" value="<?php echo $social[0]->titulo; ?>" />
                         
                              <div class="col-md-6"> 
                                <div class="form-group">
                                     <?php echo form_label('Imagem', 'userfile') ?>
                                    <input name="userfile" class="form-control" type="file" />
                                    </div>
                                </div>
                              </div>
                               <div class="row">                              
                              <div class="col-md-6">  
                                <div class="form-group">  
        <div class="panel panel-default">
                        <div class="panel-heading">Ícone Atual</div>
              <div class="panel-body">
   <img class="exibeImg imgNormal" src="<?php echo base_url('assets/uploads/' . $social[0]->icone); ?>" id="img_upload" alt="" />  
       </div>   
     </div>  
                               </div>
                           </div>
                            </div>           
         <?php $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-primary', 'value' => 'Alterar'); ?>          
                   <?php echo form_submit($button); ?>              
           <?php form_close(); ?>          
                                                      
                           
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                
              <?php else: ?>

             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O ícone foi inserido com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">                         
                          Inserir Ícone                              
                        </div>
                        <div class="panel-body">                
     <?php echo form_open_multipart('admin/socials/gravar_imagem') . form_hidden('id_social',$social[0]->id_social); ?>
                               <div class="row">                              
                              <div class="col-md-6"> 
       <input name="titulo" class="form-control" type="hidden" value="<?php echo $social[0]->titulo; ?>" />
                                 
                                <div class="form-group">
         <?php echo form_label('Imagem', 'imagem') ?>
         <input name="userfile" class="form-control" type="file" />
                               </div>
                           </div>
                            </div>     
      <?php $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Inserir'); ?>  
        <?php echo form_submit($buttonPubl); ?>  
              <?php form_close(); ?>         
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
              <?php endif; ?>
            </div>
                <!-- /.col-lg-12 -->
              </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

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
            url = "<?php echo base_url() . 'admin/socials/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_social": id, "status": status},
                success: function (data) {
                    location.reload();
                }});
        }
    }); 

       
    });

</script>