
<form action="<?php echo $this->UrlBase(); ?>TiposUsuario/Guardar" method="post">
	<input type="hidden" name="campo[id_tipo]" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>" />
	<div class="row col-lg-12 col-md-12">
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Nombre de Tipo</label>
			<input type="text" class="form-control" id="nombre_tipo" name="campo[nombre_tipo]" value="<?php echo isset($data["nombre_tipo"]) ? $data["nombre_tipo"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Estado</label>					
			<select class="form-control" id="estado" name="campo[estado]" >
				<option value="">Seleccione</option>
				<option value="1" <?php echo (isset($data["estado"]) AND $data["estado"] == 1) ? "selected" : ""; ?> >Activo</option>
				<option value="0" <?php echo (isset($data["estado"]) AND $data["estado"] == 0) ? "selected" : ""; ?> >Inactivo</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-0 col-sm-6 col-md-8 col-lg-8">&nbsp;</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<a href="<?php echo $this->UrlBase(); ?>TiposUsuario" class="btn btn-danger btn-block" id="cancelar">Cancelar </a>
		</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<input type="submit" value="Guardar " class="btn btn-primary btn-block" >
		</div>
	</div>
</form>