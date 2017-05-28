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
		<div class="content1">
			<form action="<?php echo $this->UrlBase(); ?>AdmDiagnosticoSG_SST/GuardarParametrizacion" method="post">
				<div class="row col-lg-12 col-md-12">
					<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
						<label>Tipo de usuario</label>
						<select class="form-control" id="tipo_usuario" name="id_tipo_usuario">
							<option value="">Seleccione</option>
							<?php
							foreach($TiposUsuario as $key => $tipoUsuario){
							?>
							<option value="<?php echo $tipoUsuario["id"] ?>" ><?php echo $tipoUsuario["nombre_tipo"] ?></option>
							<?php
							}
							?>
						</select>
						</hr>
					</div>
				</div>
				<div class="row col-lg-12 col-md-12" id="divTblParametros">
					<table class="table table-bordered" style="width:50% !important" align="center" >
					</table>
				</div>
				<div class="row">
					<div class="col-xs-0 col-sm-6 col-md-4 col-lg-8">&nbsp;</div>
					<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
						<input type="reset" class="btn btn-danger btn-block" value="Limpiar" />
					</div>
					<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
						<input type="submit" value="Guardar " class="btn btn-primary btn-block" />
					</div>
				</div>
			</form>
		</div>
	</div>
</div>