<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-ok"></span> Solugestion</a>
    </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			<span class="glyphicon glyphicon-user"></span>
			<?php echo $navbar["nombre"] ?> <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Mi usuario</a></li>
            <li><a href="#">Notificaciones</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="<?php echo $navbar["url_app"]."Login/Logout" ?>"><span class="glyphicon glyphicon-off"></span> Cerrar Sesion</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->