<style>
.ui-jqgrid {
    margin-left: auto;
    margin-right: auto;
}
</style>
<div class="wrapper">
	<div class="navbar">
		<?php $this->navbar(); ?>
	</div>
	<div class="sidebar">
		<?php $this->sidebar(); ?>
	</div>
	<div class="content">
		<?php
		$this->breadcrumb($breadcrumb);
		?>
		<div class="row">
			<div class="navbar navbar-default content-filters">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<a class="navbar-brand" href="#">Buscar</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="#" id="btnExpand" data-toggle="collapse" data-target="#panelFiltros" aria-expanded="false">
									<span class="caret"></span>
								</a>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			
				<div class="collapse panelFiltros" id="panelFiltros" aria-labelledby="btnExpand">
					<!-- Inicia campos de Busqueda -->
					<form method="POST" id="formBuscarTipos" autocomplete="off" accept-charset="utf-8">
					<div class="row">
						<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<label for="">Nombre de tipo</label>
							<input type="text" id="nombre_tipo" class="form-control">
						</div>
						<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
							<label for="">Estado</label>
							<select class="form-control" id="estado">
								<option value="">Seleccione</option>
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
						</hr>
					</div>
					<div class="row">
						<div class="col-xs-0 col-sm-0 col-md-8 col-lg-8">&nbsp;</div>
						<div class="form-group col-xs-12 col-sm-6 col-md-2 col-lg-2">
							<input type="button" id="searchBtn" class="btn btn-primary btn-block" value="Filtrar">
						</div>
						<div class="form-group col-xs-12 col-sm-6 col-md-2 col-lg-2">
							<input type="button" id="clearBtn" class="btn btn-danger btn-block" value="Limpiar">
						</div>
					</div>
					</form>
					<!-- Termina campos de Busqueda -->
				</div>
			</div>
			
		</div>
		<div class="row">
		<?php
		$this->LoadTemplate("jqgrid","TablaTiposUsuario");
		?>
		</div>
	</div>
</div>
<?php
	$this->LoadTemplate("modal","ModalOpciones","sm");
?>