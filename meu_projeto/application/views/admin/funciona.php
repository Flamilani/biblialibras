<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header">Página Como Funciona</h3>

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <?php if(isset($funciona[0]->id_funciona) && $funciona[0]->id_funciona != null && $funciona[0]->id_funciona != ''): ?>
   <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A página Como Funciona foi atualizada com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A página Como Funciona foi deletada com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Atualizar Página Como Funciona <span style="float: right;">
                         <b class="label <?php echo ($funciona[0]->status) ? 'label-success' : 'label-warning' ?>"><?php echo ($funciona[0]->status) ? 'Ativo' : 'Inativo' ?></b>      
                           </span>
                        </div>
                        <div class="panel-body">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'titulo', 'value' => $funciona[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
    $conteudo = array('name' => 'conteudo', 'type' => 'text', 'id' => 'conteudo', 'value' => $funciona[0]->conteudo, 'class' => 'form-control', 'rows' => '13');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como Rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>

         <?php echo form_open('admin/funciona/gravar_alteracoes') . form_hidden('id_funciona',$funciona[0]->id_funciona); ?>
                             <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Título', 'titulo') . form_input($titulo); ?>
                               </div>
                           </div>                              
                            </div>                        
           
        
                  <div class="row">
                             <div class="col-lg-12 col-md-12">  
        <div class="form-group">             
                 <?php echo form_label('Conteúdo', 'conteudo') . form_textarea($conteudo); ?>
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
           <?php else: ?>
 <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A página Como Funciona foi adicionada com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A página Como Funciona foi deletada com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Configurar Página Como Funciona
                        </div>
                        <div class="panel-body">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'titulo', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');
    $conteudo = array('name' => 'conteudo', 'type' => 'text', 'id' => 'conteudo', 'value' => set_value('conteudo'), 'class' => 'form-control', 'rows' => '3');
    $video = array('name' => 'video', 'id' => 'video', 'value' => set_value('video'), 'rows' => '4', 'cols' => '60', 'class'=>'form-control');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como Rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open('admin/funciona/gravarFunciona', 'role="form"'); ?>
                             <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Título', 'titulo') . form_input($titulo); ?>
                               </div>
                           </div>                              
                            </div>                          
                             <div class="row">
                             <div class="col-lg-12 col-md-12">  
        <div class="form-group">             
                 <?php echo form_label('Conteúdo', 'conteudo') . form_textarea($conteudo); ?>
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
           <?php endif; ?>

            
        </div>
        <!-- /#page-wrapper -->

<script type="text/javascript">
    $(document).ready(function () {

      Shadowbox.init();

        CKEDITOR.replace('editor1');

        $("select").change(function () {
             
        $(this).find("option:selected").each(function () {
           
            if ($(this).attr("value") === "imagem") {
                $(".opcao").not(".imagem").hide();
                $(".imagem").show();
            }
            else if ($(this).attr("value") === "video") {
                $(".opcao").not(".video").hide();
                $(".video").show();                
            }
            else {
                $(".opcao").hide();
            }
        });
    }).change();

        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/funciona/alterar_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_funciona": id, "status": status},
                success: function (data) {
                    location.reload();
                }});
        }
    });

         
    
 
        

    });

</script>