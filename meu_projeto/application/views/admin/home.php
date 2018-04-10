    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><i class="fa fa-dashboard fa-fw"></i> Dashboard</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-book fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count_livros; ?></div>
                                <div><?php plural($count_livros, 'Livro', 'Livros') ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/livros") ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Mais Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count_ativos; ?></div>
                                <div>
                                <?php plural($count_ativos, 'Usuário', 'Usuários') ?>                      
                              </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/usuarios") ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Mais Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-pencil-square-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count_assinaturas; ?></div>
                                <div><?php plural($count_assinaturas, 'Assinatura', 'Assinaturas') ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/assinaturas") ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Mais Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-usd fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count_pagos; ?></div>
                                <div><?php plural($count_pagos, 'Pagamento', 'Pagamentos') ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/pagamentos") ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Mais Detalhes</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

         <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Estatísticas</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
             <div class="row">
            <div class="col-lg-3 col-md-6">
               <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Escolaridade</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
    <?php foreach ($escolar as $nivel): ?>
        <tr>
        <td><b><?php echo FormEscolar($nivel->escolaridade); ?></b></td> 
        <td><?php echo $nivel->qtd; ?></td>     
        </tr>  
    <?php endforeach; ?>
    </table>
  </div>
</div>
            </div>  
            <div class="col-lg-3 col-md-6">
             <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Parte de Igreja</h3>
  </div>
  <div class="panel-body">
    <table class="table table-striped">
    <?php foreach ($igreja as $ig): ?>
        <tr>
        <td><b><?php echo FormIgreja($ig->igreja); ?></b></td>
       <td><?php echo $ig->qtd; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
  </div>
</div>
            </div>
            <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Função na Igreja</h3>
  </div>
  <div class="panel-body">
   <table class="table table-striped">
    <?php foreach ($funcao as $f): ?>
        <tr>
        <td><b><?php echo FormFuncao($f->funcao); ?></b></td>
       <td><?php echo $f->qtd; ?></td>
        </tr>
    <?php endforeach; ?> 
    </table>
  </div>
</div>
            </div>
                       <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Como sabe do site BBL</h3>
  </div>
  <div class="panel-body">
   <table class="table table-striped">
    <?php foreach ($saber as $sb): ?>
        <tr>
        <td><b><?php echo FormSaber($sb->saber); ?></b></td>
       <td><?php echo $sb->qtd; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
  </div>
</div>
            </div>
                      <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Perfil</h3>
  </div>
  <div class="panel-body">
     <table class="table table-striped">
    <?php foreach ($perfils as $perf): ?>
        <tr>
        <td><b><?php echo FormPerfil_SO($perf->perfil_so); ?></b></td>
       <td><?php echo $perf->qtd; ?></td>
        </tr>
    <?php endforeach; ?>
    </table>
  </div>
</div>

            </div>
                 <div class="col-lg-3 col-md-6">
                     <div class="panel panel-primary">
                         <div class="panel-heading">
                             <h3 class="panel-title">Uso para Acesso</h3>
                         </div>
                         <div class="panel-body">
                             <table class="table table-striped">
                                 <?php foreach ($acessos as $acesso): ?>
                                     <tr>
                                         <td><b><?php echo FormAcesso($acesso->acesso); ?></b></td>
                                         <td><?php echo $acesso->qtd; ?></td>
                                     </tr>
                                 <?php endforeach; ?>                              
                             </table>
                         </div>
                     </div>

                 </div>
                            <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Pie Chart Example
                        </div>
                       
                        <div class="panel-body">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-pie-chart"></div>
                            </div>
                        </div>
                       
                    </div>
                   
                </div> 
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->
