<div class="content1">
<form action="<?php echo $this->UrlBase(); ?>AdmDiagnosticoSG_SST/Guardar" method="post">
	<input type="hidden" name="campo[id]" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>" />
	<div class="row col-lg-12 col-md-12">
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Paso</label>
			<input type="text" class="form-control" id="paso" name="campo[paso]" value="<?php echo isset($data["paso"]) ? $data["paso"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Sección</label>
			<input type="text" class="form-control" id="seccion" name="campo[seccion]" value="<?php echo isset($data["seccion"]) ? $data["seccion"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Subsección</label>					
			<input type="text" class="form-control" id="subseccion" name="campo[subseccion]" value="<?php echo isset($data["subseccion"]) ? $data["subseccion"] : ""; ?>" />
		</div>
	</div>
	<div class="row col-lg-12 col-md-12">
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Numeral</label>
			<input type="text" class="form-control" id="numeral" name="campo[numeral]" value="<?php echo isset($data["numeral"]) ? $data["numeral"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Marco Legal</label>					
			<input type="text" class="form-control" id="marco_legal" name="campo[marco_legal]" value="<?php echo isset($data["marco_legal"]) ? $data["marco_legal"] : ""; ?>" />
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
			<label>Estado</label>					
			<input type="text" class="form-control" id="estado" name="campo[estado]" value="<?php echo isset($data["estado"]) ? $data["estado"] : ""; ?>" />
		</div>
	</div>
	<div class="row col-lg-12 col-md-12">
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-6">
			<label>Criterio</label>
			<textarea class="form-control" id="criterio" name="campo[criterio]"><?php echo isset($data["criterio"]) ? $data["criterio"] : ""; ?></textarea>
		</div>
		<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-6">
			<label>Modo de verificación</label>
			<textarea class="form-control" id="modo_verificacion" name="campo[modo_verificacion]"><?php echo isset($data["modo_verificacion"]) ? $data["modo_verificacion"] : ""; ?></textarea>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-0 col-sm-6 col-md-8 col-lg-8">&nbsp;</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<a href="<?php echo $this->UrlBase(); ?>AdmDiagnosticoSG_SST" class="btn btn-danger btn-block" id="cancelar">Cancelar </a>
		</div>
		<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
			<input type="submit" value="Guardar " class="btn btn-primary btn-block" >
		</div>
	</div>
</form>
</div>