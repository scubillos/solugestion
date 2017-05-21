
<form action="<?php echo $this->UrlBase(); ?>AdmCatalogos/Guardar" method="post">
	<input type="hidden" name="campo[id]" id="id_hidden" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>" />
	<div class="row col-lg-12 col-md-12">
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Módulo</label>
			<input type="text" class="form-control" id="modulo" name="campo[modulo]" value="<?php echo isset($data["modulo"]) ? $data["modulo"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Tipo</label>					
			<input type="text" list="tiposCat" class="form-control" id="tipo" name="campo[tipo]" value="<?php echo isset($data["tipo"]) ? $data["tipo"] : ""; ?>" />
			<datalist id="tiposCat">
				<?php
				if(count($tipos) != 0){
					foreach($tipos as $k => $value){
					?>
					<option value="<?php echo $value["tipo"]; ?>">
					<?php
					}
				}
				?>
			</datalist>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Valor</label>					
			<input type="text" class="form-control" id="valor" name="campo[valor]" value="<?php echo isset($data["valor"]) ? $data["valor"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Texto</label>					
			<input type="text" class="form-control" id="texto" name="campo[texto]" value="<?php echo isset($data["texto"]) ? $data["texto"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Oculto</label>					
			<input type="checkbox" class="form-control" id="oculto" name="campo[oculto]" value="1" <?php echo (isset($data["oculto"]) AND $data["oculto"] == 1) ? "checked" : ""; ?> />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Observaciones</label>					
			<textarea class="form-control" id="observaciones" name="campo[observaciones]"><?php echo isset($data["oculto"]) ? $data["oculto"] : ""; ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-0 col-sm-6 col-md-8 col-lg-8">&nbsp;</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<input type="button" class="btn btn-danger btn-block" id="resetForm" value="Cancelar" />
		</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<input type="submit" value="Guardar " class="btn btn-primary btn-block" />
		</div>
	</div>
</form>
	<hr>