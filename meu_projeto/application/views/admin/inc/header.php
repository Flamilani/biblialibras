
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-static-top bg-info" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand admin" href="<?php echo  base_url('admin/home'); ?>">Painel Admin. - A Bíblia em Libras</a>
        </div>
        <!-- /.navbar-header -->
      <ul class="nav navbar-nav">   
        <li><a href="<?php echo base_url("home") ?>"><i class="fa fa-home" aria-hidden="true"></i> Home </a></li>

      </ul>    

        <ul class="nav navbar-top-links navbar-right">
                      <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li class="perfil">
                        <p><?php echo $this->session->userdata('admin')->nome; ?></p>
                        <p><?php echo $this->session->userdata('admin')->email; ?></p>
                    </li>
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('admin/usuarios/perfil/' . $perfil[0]->id); ?>"><i class="fa fa-user fa-fw"></i> Meu Perfil</a>
                    </li>
                    <!-- <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li> -->
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                <!--     <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>                        
                    </li> -->
                    <li>
                        <a href="<?php echo base_url("admin/home") ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file-text-o fa-fw"></i> Páginas<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url("admin/inicial") ?>">Inicial</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/sobre") ?>">Sobre</a>
                            </li> 
                            <li>
                                <a href="<?php echo base_url("admin/funciona") ?>">Funciona</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/privacidade") ?>">Privacidade</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/termos") ?>">Termos de Uso</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="<?php echo base_url("admin/usuarios") ?>"><i class="fa fa-user fa-fw"></i> Usuários (<?php echo $count_ativos; ?>)</a>
                    </li>
                    <li>
                    <a href="<?php echo base_url("admin/livros") ?>"><i class="fa fa-book fa-fw"></i> Livros (<?php echo $count_livros; ?>)</a>
                    </li>
                     <li>
                    <a href="<?php echo base_url("admin/planos") ?>"><i class="fa fa-file fa-fw"></i> Planos (<?php echo $count_planos; ?>)</a>
                    </li>                   
                    <li>
                    <a href="<?php echo base_url("admin/assinaturas") ?>"><i class="fa fa-edit fa-fw"></i> Assinaturas (<?php echo $count_assinaturas; ?>)</a>
                    </li>               
                   <!--  <li>
                        <a href="<?php echo base_url("admin/pedidos") ?>"><i class="fa fa-table fa-fw"></i> Pedidos (<?php echo $count_pedidos; ?>)</a>
                    </li> -->
                    <li>
                        <a href="<?php echo base_url("admin/pagamentos") ?>"><i class="fa fa-usd fa-fw"></i> Pagamentos (<?php echo $count_pagos; ?>)</a>
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-search fa-fw"></i> Monitoramento<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url("admin/acessos") ?>"> Acessos a Livros</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/registros") ?>"> Vídeos Concluídos </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/auditoria") ?>"> Logins</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-cog fa-fw"></i> Configurações<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url("admin/banco") ?>">Dados Bancários</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/email") ?>">Email do Servidor</a>
                            </li>
                             <li>
                                <a href="<?php echo base_url("admin/sociais") ?>">Redes Sociais</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/relato") ?>">Relato de Erros</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/suspensao") ?>">Suspensão</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url("admin/manutencao") ?>">Manutenção</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>