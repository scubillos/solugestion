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
		<form action="<?php echo $this->UrlBase(); ?>Usuarios/Guardar" method="post" id="CrearForm">
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Nombre</label>
					<input type="text" class="form-control" id="nombre" name="campo[nombre]" required autofocus/>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Tipo de usuario</label>					
					<select class="form-control" id="TipoUsuario" name="campo[TipoUsuario]" required>
						<option value="">Seleccione</option>
						<option value="0">Opcion1</option>
						<option value="1">Opcion2</option>
						<option value="2">Opcion3</option>
					</select>
				</div>
			</div>
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Nit</label>
					<input type="number" class="form-control" id="nit" name="campo[nit]"  required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Direccion</label>					
					<input type="text" class="form-control" id="dir" name="campo[direccion]" required />
				</div>
			</div>
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Telefono</label>
					<input type="number" class="form-control" id="tel" name="campo[telefono]" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Persona de contacto</label>					
					<input type="text" class="form-control" id="percont" name="campo[percontac]" required />
				</div>
			</div>
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Telefono persona de contacto</label>
					<input type="number" class="form-control" id="telpercont" name="campo[telpercontac]" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Responsable</label>					
					<input type="text" class="form-control" id="responsable" name="campo[responsable]" required />
				</div>
			</div>
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Numero movil</label>
					<input type="number" class="form-control" id="nummovil" name="campo[nummovil]" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Correo</label>					
					<input type="email" class="form-control" id="mail" name="campo[mail]" required />
				</div>
			</div>
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>contraseña</label>
					<input type="password" class="form-control" id="pass" name="campo[pass]" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Repita su contraseña</label>					
					<input type="password" class="form-control" id="rpass" name="campo[rpass]" required />
				</div>
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