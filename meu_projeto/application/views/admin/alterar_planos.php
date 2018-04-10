<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url("admin/planos") ?>">Planos</a> > <?php echo $planos[0]->nome_plano; ?> - ID <?php echo $planos[0]->id_planos; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O plano foi alterado com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                           Alterar Plano
                        </div>
                        <div class="panel-body">
                             <?php 
    $titulo = array('name' => 'nome_plano', 'type' => 'text', 'id' => 'nome_plano', 'value' => $planos[0]->nome_plano, 'class' => 'form-control', 'placeholder' => 'Título');   
    $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => $planos[0]->ordem, 'class' => 'form-control', 'placeholder' => '000');   
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>
     <?php echo form_open('admin/planos/gravar_alteracoes') . form_hidden('id_planos',$planos[0]->id_planos); ?>
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

      //  CKEDITOR.replace('editor1');

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