    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
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
                                <?php plural($count_ativos, 'Usuário Ativo', 'Usuários Ativos') ?>                      
                              </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/users") ?>">
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
                                <div class="huge"><?php echo $count_users; ?></div>
                                <div><?php plural($count_users, 'Assinatura', 'Assinaturas') ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/users") ?>">
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
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php echo $count_pedidos; ?></div>
                                <div><?php plural($count_pedidos, 'Pedido', 'Pedidos') ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url("admin/pedidos") ?>">
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
         <?php foreach ($totalEscolar as $totalEsc): ?>
        <tr>
            <td class="info"><b><?php echo FormEscolar($totalEsc->total); ?></b></td>
            <td class="info"><?php echo $totalEsc->total; ?></td>
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
     <?php foreach ($totalIgreja as $totalIg): ?>
        <tr>
            <td class="info"><b><?php echo FormIgreja($totalIg->total); ?></b></td>
            <td class="info"><?php echo $totalIg->total; ?></td>
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
     <?php foreach ($totalFuncao as $totalFun): ?>
        <tr>
            <td class="info"><b><?php echo FormFuncao($totalFun->total); ?></b></td>
            <td class="info"><?php echo $totalFun->total; ?></td>
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
     <?php foreach ($totalSaber as $totalSab): ?>
        <tr>
            <td class="info"><b><?php echo FormSaber($totalSab->total); ?></b></td>
            <td class="info"><?php echo $totalSab->total; ?></td>
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
     <?php foreach ($totalPerfil as $totalPerf): ?>
        <tr>
            <td class="info"><b><?php echo FormPerfil_SO($totalPerf->total); ?></b></td>
            <td class="info"><?php echo $totalPerf->total; ?></td>
        </tr>
         <?php endforeach; ?>
    </table>
  </div>
</div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /#page-wrapper -->
