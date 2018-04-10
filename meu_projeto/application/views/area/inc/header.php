<nav class="navbar navbar-inverse areaUsuario">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url("area") ?>">Área do Usuário</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse areaUserLink" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url("home") ?>"> <i class="fa fa-home" aria-hidden="true"></i> Home</a></li>

      </ul>     
      <ul class="nav navbar-nav navbar-right">
        <li class="sessionUser">
          <?php echo $this->session->userdata('user')->nome; ?> </li>
          <li class="sessionUser"><span class="label label-success"> Online </span></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Meu Perfil <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li class="sessionUserDrop"><?php echo $this->session->userdata('user')->nome; ?> <?php echo $this->session->userdata('user')->sobrenome; ?></li>
            <li class="sessionUserDrop"><?php echo $this->session->userdata('user')->email; ?></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url('area/meu_perfil/' . $this->session->userdata('user')->id); ?>">Editar Perfil</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo base_url('area/logout'); ?>">Sair</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>