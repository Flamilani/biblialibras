<div id="page-wrapper">
            <div class="row">
 <?php $rowsPlano = $this->db->query("SELECT * FROM planos WHERE id_planos = {$plano_livro[0]->id_planos}"); ?>   
            <?php $pls = $rowsPlano->result(); ?>
    <?php $rowsLivro = $this->db->query("SELECT * FROM livros WHERE id_livro = {$plano_livro[0]->id_livro}"); ?>   
            <?php $liv = $rowsLivro->result(); ?>
                <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url('admin/planos'); ?>"> <i class="fa fa-file fa-fw"></i> Planos</a> > <a href="<?php echo base_url('admin/planos/plano_livro/' . $plano_livro[0]->id_planos); ?>"> Livros do <?php echo $pls[0]->nome_plano; ?></a> : <?php echo $liv[0]->titulo; ?></h3> 
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O livro do plano foi alterado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O livro do plano foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          Alterar Livro do Plano
                        </div>
                        <div class="panel-body">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');  
   $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => '000', 'class' => 'form-control', 'placeholder' => '000');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Atualizar'); ?>

            <?php echo form_open('admin/planos/alterarPlanoLivro', 'role="form"'); ?>
              <?php echo form_hidden('id_planos', $plano_livro[0]->id_planos) ?>
              <?php echo form_hidden('id_plano_livro', $plano_livro[0]->id_plano_livro) ?>
                             <div class="row">
                              <div class="col-md-6">
                             <div class="form-group">
                                   <?php echo form_label('Livro', 'livro') ?> <br>
                             <select class="form-control" name="id_livro" id="id_livro" required>
                                   <option value="">Selecione</option>    
                                   <?php     
                                      foreach ($plano_livroSel as $livro): ?>
            <option value="<?php echo $livro->id_livro; ?>" <?php if (isset($livro->id_livro) && $livro->id_livro == $plano_livro[0]->id_livro) echo 'selected'; ?>> <?php echo $livro->ordem; ?> - <?php echo $livro->titulo; ?> </option>                   
                                       <?php endforeach; ?>
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
  <!-- Modal -->
  <div class="modal fade" id="modalLivro" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Livro do Plano</h4>
        </div>
        <div class="modal-body">
            <form></form>
          <form role="form" method="post" class="formulario" action="<?php echo base_url('admin/planos/salvar'); ?>" id="formulario_livros">
         <div class="form-group">
                                   <?php echo form_label('Livro', 'livro') ?> <br>
                            <select class="form-control" name="id_livro" id="id_livro" required>
                                   <option value="">Selecione</option>    
                                   <?php     
                                      foreach ($plano_livroSel as $livro): ?>
                    <option value="<?php echo $livro->id_livro; ?>"><?php echo $livro->ordem; ?> - <?php echo $livro->titulo; ?></option>
                                       <?php endforeach; ?>
                                        </select>
                                    </div>  
                                     <input type="hidden" name="id_planos" id="id_planos" value="" />
                         <button type="button" class="btn btn-primary" onclick="$('.formulario').submit();">Salvar</button>
                                 </form>
                                 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>
      
    </div>
  </div>

<script type="text/javascript">


    $(document).ready(function () {

        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';
        var msg = (status === '0') ? 'Inativo' : 'Ativo';
        if (confirm("Tem certeza que quer alterar para " + msg + "?"))
        {
            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/planos/alterar_plano_livro_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_plano_livro": id, "status": status},
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
    
    });

</script>