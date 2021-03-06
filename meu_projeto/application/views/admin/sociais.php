<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">Redes Sociais</h3>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A rede social foi adicionada com sucesso!</div>
                  <?php } elseif($this->session->flashdata('alterar')) { ?>
                   <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A rede social foi alterada com sucesso!</div>
            <?php } elseif($this->session->flashdata('deletar')) { ?>
                   <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>A rede social foi deletada com sucesso!</div>
           <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>
                 
            <div class="row">

                               <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                          <button class="btn btn-info" id="cadastro_livro">Cadastrar Rede Social</button>
                        </div>
                        <div class="panel-body caixa_livro">
  <?php $titulo = array('name' => 'titulo', 'id' => 'titulo', 'type' => 'text', 'value' => set_value('titulo'), 'class' => 'form-control', 'placeholder' => 'Título');
  $link = array('name' => 'link', 'id' => 'link', 'type' => 'url', 'value' => set_value('link'), 'class' => 'form-control', 'placeholder' => 'Link');
     $button = array('name' => 'btn_adicionar', 'id' => 'btn_adicionar', 'type' => 'submit', 'class' => 'btn btn-warning', 'value' => 'Salvar como rascunho');
     $buttonPubl = array('name' => 'btn_publicar', 'id' => 'btn_publicar', 'type' => 'submit', 'class' => 'btn btn-success', 'value' => 'Publicar'); ?>

            <?php echo form_open_multipart('admin/sociais/gravarSociais', 'role="form"'); ?>
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
                            <div class="row">
                              <div class="col-md-6"> 
                                <div class="form-group">
                                     <?php echo form_label('Ícone', 'icone') ?>
                                    <input name="userfile" class="form-control" type="file" />
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
                           <?php echo $count_sociais; ?> <?php plural($count_sociais, 'social', 'sociais') ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
            <table width="100%" class="tabela1 table table-striped table-bordered table-hover" id="tabela1">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Link</th>
                                        <th>Ícone</th>                                       
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($sociais)): ?>                    
                            <?php foreach ($sociais as $social): ?>
                                <tr class="odd gradeX">                               
       <td class="text-center"><?php echo $social->id_social; ?></td>
                                        <td><?php echo $social->titulo; ?></td>                   
                                        <td><?php echo $social->link; ?></td>  
                                        <td class="text-center">
     <?php if(isset($social->icone) && $social->icone != null): ?>
       <img class="exibeImg" src="<?php echo base_url('assets/uploads/' . $social->icone); ?>" id="img_upload" alt="" />   
    <a href="<?php echo base_url('admin/sociais/alterar_icone/' . $social->id_social); ?>" title="Editar" class="btn btn-sm btn-success">Alterar Ícone</a>
   <?php else: ?>

   <a href="<?php echo base_url('admin/sociais/alterar_icone/' . $social->id_social); ?>" title="Inserir" class="btn btn-sm btn-primary">Inserir Ícone</a>
 <?php endif; ?>
                                          </td>
                                            <td class="text-center">
       <b data="<?php echo $social->id_social; ?>" class="status_checks btn btn-sm <?php echo ($social->status) ? 'btn-success' : 'btn-warning' ?>"><?php echo ($social->status) ? 'Ativo <span title="Ativo" class="glyphicon glyphicon-ok"></span>' : 'Inativo <span title="Inativo" class="glyphicon glyphicon-minus"></span>' ?></b>                                            
                                          </td>
                                        <td class="text-center">
            <a href="<?php echo base_url('admin/sociais/alterar/' . $social->id_social); ?>" title="Editar" class="btn btn-sm btn-primary"><b><i class="fa fa-edit"></i></b></a>

  <a href="<?php echo base_url('admin/sociais/deletar/' . $social->id_social); ?>" onclick="return confirmarExclusao(<?php echo $social->id_social; ?>)" title="Deletar" class="btn btn-sm btn-danger"><b><i class="fa fa-trash-o"></i></b></a>
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

    $(document).ready(function () {    

      Shadowbox.init();

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