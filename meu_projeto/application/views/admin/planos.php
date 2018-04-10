<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"> <i class="fa fa-file fa-fw"></i> Planos</h3>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O plano foi adicionado com sucesso!</div>
            <?php } else if($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O plano foi deletado com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Plano</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $titulo = array('name' => 'nome_plano', 'id' => 'nome_plano', 'type' => 'text', 'value' => set_value('nome_plano'), 'class' => 'form-control', 'placeholder' => 'Título');  
   $ordem = array('name' => 'ordem', 'type' => 'number', 'id' => 'ordem', 'value' => '000', 'class' => 'form-control', 'placeholder' => '000');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open_multipart('admin/planos/gravarPlanos', 'role="form"'); ?>
                             <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                             <?php echo form_label('Nome de Plano', 'nome_plano') . form_input($titulo); ?>
                               </div>
                           </div>
                                 <div class="col-md-3">
                                     <div class="form-group">
                                         <label>Exibir na Home</label>
                                         <select class="form-control" name="home" id="home">
                                             <option value="1">Sim</option>
                                             <option value="0">Não</option>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="col-md-3">
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

              <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <?php echo $count_planos; ?> <?php plural($count_planos, 'Plano', 'Planos') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Ordem</th>
                                        <th>Nome de Plano</th>
                                        <th>Períodos</th>
                                        <th>Livros</th>
                                        <th>Exibir</th>
                                        <th>Tipo</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
               
                                    <?php if (!empty($planos)): ?>                    
                            <?php foreach ($planos as $plano): ?>
    <?php $rowsP = $this->db->query("SELECT * FROM plano WHERE id_planos = {$plano->id_planos}"); ?>
     <?php $countP = $rowsP->result(); ?>    
       <?php $rowsLivro = $this->db->query("SELECT * FROM plano_livro WHERE id_planos = {$plano->id_planos}"); ?>
     <?php $countLivro = $rowsLivro->result(); ?>

      
                                <tr class="odd gradeX">                               
       <td class="text-center"><?php echo form_hidden($plano->id_planos); ?><?php echo $plano->ordem; ?></td>
                                       <td><?php echo $plano->nome_plano; ?></td>    
                                       <td class="text-center">
                                        <a class="btn btn-primary" href="<?php echo base_url('admin/planos/periodos/' . $plano->id_planos); ?>"><?php echo count($countP); ?> <?php plural(count($countP), 'período', 'períodos') ?></a>
                                      </td>    
                                      <td class="text-center">
                                          <?php if(isset($countLivro[0]->params) && $countLivro[0]->params != ''): ?>
                                        <a class="btn btn-primary" href="<?php echo base_url('admin/planos/plano_livro/' . $plano->id_planos); ?>">
                                            <?php else: ?>
                                            <a class="btn btn-primary" href="<?php echo base_url('admin/planos/novo_plano_livro/' . $plano->id_planos); ?>">
                                            <?php endif; ?>
         <?php echo (isset($countLivro[0]->params) && $countLivro[0]->params != '') ? count(explode(',', $countLivro[0]->params)) . ' livros' : '0 livro'; ?>
  </a>
                                      </td>
                                    <td class="text-center">
                                        <b data="<?php echo $plano->id_planos; ?>" class="home_checks btn btn-sm <?php echo ($plano->home) ? 'btn-success' : 'btn-danger' ?>"><?php echo ($plano->home) ? 'Sim' : 'Não' ?></b>
                                    </td>
                                    <td class="text-center">
                                         <b data="<?php echo $plano->id_planos; ?>" class="tipo_checks btn btn-sm <?php echo ($plano->tipo_plano)  ? 'btn-primary' : 'btn-info' ?>"><?php echo ($plano->tipo_plano) ? 'Plano Completo' : 'Plano Alternativo' ?></b>
                                    </td>
                                            <td class="text-center">
       <b data="<?php echo $plano->id_planos; ?>" class="status_checks btn btn-sm <?php echo ($plano->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($plano->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>
                                          </td>

                                        <td class="text-center">
            <a href="<?php echo base_url('admin/planos/alterar_planos/' . $plano->id_planos); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/planos/deletar/' . $plano->id_planos); ?>" onclick="return confirmarExclusao(<?php echo $plano->id_planos; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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


        $(document).on('click', '.status_checks', function ()
           {
        var status = ($(this).hasClass("btn-success")) ? '0' : '1';


            var current_element = $(this);
            var id = $(current_element).attr('data');
            url = "<?php echo base_url() . 'admin/planos/alterar_planos_status' ?>";
            $.ajax({
                type: "POST",
                url: url,
                data: {"id_planos": id, "status": status},
                success: function (data) {
                    location.reload();
                }});

    });

        $(document).on('click', '.home_checks', function ()
        {
            var status = ($(this).hasClass("btn-success")) ? '0' : '1';

                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo base_url() . 'admin/planos/alterar_home_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id_planos": id, "home": status},
                    success: function (data) {
                        location.reload();
                    }});

        });

        $(document).on('click', '.tipo_checks', function ()
        {
            var status = ($(this).hasClass("btn-primary")) ? '0' : '1';

                var current_element = $(this);
                var id = $(current_element).attr('data');
                url = "<?php echo base_url() . 'admin/planos/alterar_tipo_status' ?>";
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {"id_planos": id, "tipo_plano": status},
                    success: function (data) {
                        location.reload();
                    }});

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