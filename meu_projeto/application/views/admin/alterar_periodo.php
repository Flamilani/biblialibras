<div id="page-wrapper">
            <div class="row">
 <?php $rowsPlano = $this->db->query("SELECT * FROM planos WHERE id_planos = {$plano[0]->id_planos}"); ?>   
            <?php $pls = $rowsPlano->result(); ?>
                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url("admin/planos"); ?>">Planos</a> ><a href="<?php echo base_url("admin/planos/periodos/") . $plano[0]->id_planos; ?>"> Períodos do <?php echo $pls[0]->nome_plano; ?></a> > <?php echo $plano[0]->titulo; ?> - ID <?php echo $plano[0]->id_plano; ?></h3> 

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O período foi alterado com sucesso!</div>
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
    $titulo = array('name' => 'titulo', 'type' => 'text', 'id' => 'titulo', 'value' => $plano[0]->titulo, 'class' => 'form-control', 'placeholder' => 'Título');
    $valor = array('name' => 'valor', 'id' => 'valor', 'value' => $plano[0]->valor, 'class' => 'form-control', 'placeholder' => '0,00');    
    $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => $plano[0]->ordem, 'class' => 'form-control', 'placeholder' => '000');
     $duracao = array('name' => 'duracao', 'id' => 'duracao', 'type' => 'number', 'value' => $plano[0]->duracao, 'class' => 'form-control', 'placeholder' => '0');  
      $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>
     <?php echo form_open('admin/planos/gravar_periodos') . form_hidden('id_plano',$plano[0]->id_plano); ?>
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
                               <label>Valor</label>
                               <div class="input-group">
                               <div class="input-group-addon">R$</div>                               
                                <?php echo form_input($valor); ?>
                           </div>
                               </div>
                           </div>
                            <div class="col-md-3"> 
                                <div class="form-group">
                                 <?php echo form_label('Duração', 'duracao') . form_input($duracao); ?>

                                    </div>
                                </div> 
                                  <div class="col-md-3"> 
                                <div class="form-group">
                                 <?php echo form_label('Período', 'periodo'); ?>
                          <select class="form-control" name="periodo" id="periodo">
                             <option value="0" disabled selected> Selecione </option>
                            <option value="year" <?php if (isset($plano[0]->periodo) && $plano[0]->periodo == 'year') echo 'selected'; ?>> ano </option>
                            <option value="month" <?php if (isset($plano[0]->periodo) && $plano[0]->periodo == 'month') echo 'selected'; ?>> meses </option>   
                            <option value="day" <?php if (isset($plano[0]->periodo) && $plano[0]->periodo == 'day') echo 'selected'; ?>> dias </option>   
                             </select>        
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