<div class="content1"> 
		<form action="<?php echo $this->UrlBase(); ?>DiagnosticoSG_SST/Guardar" method="post" id="CrearFormdiag">
			<input type="hidden" name="campo[id]" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>">
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Fecha de diagnostico</label>
					<input type="date" class="form-control" id="fecha_diag" name="campo[fecha_diagnostico]" value="<?php echo isset($data["fecha_diagnostico"]) ? $data["fecha_diagnostico"] : ""; ?>"required autofocus/>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Estado</label>					
					<select class="form-control" id="estado_diag" name="campo[estado]" required>
						<option value="">Seleccione</option>
						<?php
						foreach($estados_diag as $key => $value){
						?>
						<option value="<?php echo $value["valor"]; ?>" <?php echo (isset($data["estado"]) AND $data["estado"] == (INT)$value["valor"]) ? "selected" : ""; ?> ><?php echo $value["texto"]; ?></option>
						<?php
						}
						?>						
					</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Observaciones</label>					
					<textarea class="form-control" id="obser_diag" name="campo[observaciones_diagnostico]" required><?php echo isset($data["observaciones_diagnostico"]) ? $data["observaciones_diagnostico"] : ""; ?></textarea>
				</div>
			</div>
			
			<div class="row">
				<?php 
					$this->getParametrizacionTipo();
				 ?>
			</div>
			
			<div class="row col-lg-12 col-md-12">
			<div class="row">
				<div class="col-xs-0 col-sm-6 col-md-8 col-lg-8">&nbsp;</div>
				<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
					<a href="<?php echo $this->UrlBase(); ?>Usuarios" class="btn btn-danger btn-block" id="cancelar">Cancelar </a>
				</div>
				<div class="form-group col-xs-12 col-sm-3 col-md-2 col-lg-2">
					<input type="submit" value="Guardar " class="btn btn-primary btn-block" >
				</div>
			</div>
			</div>
		</form>
		</div>
	</div>
</div>