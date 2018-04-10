<div id="page-wrapper">
            <div class="row">
                     <div class="col-lg-12">
                    <h3 class="page-header"><a href="<?php echo base_url('admin/assinaturas'); ?>">Assinaturas</a> > Pagamento do <?php echo $pagos[0]->nome; ?> <?php echo $pagos[0]->sobrenome; ?> (<?php echo $pagos[0]->nome_plano; ?> - <?php echo $pagos[0]->duracao; ?> <?php echo FormPeriodo($pagos[0]->periodo); ?>)</h3>
                  
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
             <?php if(isset($livro[0]->imagem) && $livro[0]->imagem != null): ?>

             <?php if($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="icon fa fa-success"></i>O comprovante foi alterado com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">                         
                             Alterar Imagem                          
                        </div>
                        <div class="panel-body">
                
     <?php echo form_open_multipart('admin/pagamentos/gravar_comprovante') . form_hidden('id_livro',$livro[0]->id_livro); ?>
      <div class="row">
                               
                                    <input name="titulo" class="form-control" type="hidden" value="<?php echo $livro[0]->titulo; ?>" />
                         
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
                        <div class="panel-heading">Imagem Atual</div>
              <div class="panel-body">
   <img class="exibeImg imgNormal" src="<?php echo base_url('assets/uploads/' . $livro[0]->imagem); ?>" id="img_upload" alt="" />  
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
                    <i class="icon fa fa-success"></i>A imagem foi inserida com sucesso!</div>
            <?php } ?>
                <?php echo validation_errors('<div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <i class="icon fa fa-warning"></i> ', '</div>'); ?>          
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">                         
                          Inserir Imagem                              
                        </div>
                        <div class="panel-body">                
     <?php echo form_open_multipart('admin/pagamentos/gravar_comprovante') . form_hidden('id_livro',$livro[0]->id_livro); ?>
                               <div class="row">                              
                              <div class="col-md-6"> 
       <input name="titulo" class="form-control" type="hidden" value="<?php echo $livro[0]->titulo; ?>" />
                                 
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
</div>
</div>
