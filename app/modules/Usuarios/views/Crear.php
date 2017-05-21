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
	</div>
		<div class="content1"> 
		<form action="<?php echo $this->UrlBase(); ?>Usuarios/Guardar" method="post" id="CrearForm">
			<input type="hidden" name="campo[id]" value="<?php echo isset($data["id"]) ? $data["id"] : ""; ?>">
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Nombre</label>
					<input type="text" class="form-control" id="nombre" name="campo[nombre]" value="<?php echo isset($data["nombre"]) ? $data["nombre"] : ""; ?>"required autofocus/>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Tipo de usuario</label>					
					<select class="form-control" id="TipoUsuario" name="campo[tipo_usuario]" value="<?php echo isset($data["tipo_usuario"]) ? $data["tipo_usuario"] : ""; ?>" required>
						<option value="">Seleccione</option>
						<option value="0">Opcion1</option>
						<option value="1">Opcion2</option>
						<option value="2">Opcion3</option>
					</select>
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Nit</label>
					<input type="text" class="form-control" id="nit" name="campo[nit]"  value="<?php echo isset($data["nit"]) ? $data["nit"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Direccion</label>					
					<input type="text" class="form-control" id="dir" name="campo[direccion]" value="<?php echo isset($data["direccion"]) ? $data["direccion"] : ""; ?>" required />
				</div>
			</div>
			
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Telefono</label>
					<input type="text" class="form-control" id="tel" name="campo[telefono]" value="<?php echo isset($data["telefono"]) ? $data["telefono"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Persona de contacto</label>					
					<input type="text" class="form-control" id="percont" name="campo[persona_contacto]" value="<?php echo isset($data["persona_contacto"]) ? $data["persona_contacto"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Telefono persona de contacto</label>
					<input type="text" class="form-control" id="telpercont" name="campo[num_percontacto]" value="<?php echo isset($data["num_percontacto"]) ? $data["num_percontacto"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Responsable</label>					
					<input type="text" class="form-control" id="responsable" name="campo[responsable]" value="<?php echo isset($data["responsable"]) ? $data["responsable"] : ""; ?>" required />
				</div>
			</div>
			
			<div class="row col-lg-12 col-md-12">
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Numero movil</label>
					<input type="text" class="form-control" id="nummovil" name="campo[num_movil]" value="<?php echo isset($data["num_movil"]) ? $data["num_movil"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Correo</label>					
					<input type="email" class="form-control" id="mail" name="campo[correo]" value="<?php echo isset($data["correo"]) ? $data["correo"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>contraseña</label>
					<input type="password" class="form-control" id="pass" name="pass" value="<?php echo isset($data["pass"]) ? $data["pass"] : ""; ?>" required />
				</div>
				<div class="form-group col-xs-12 col-sm-6 col-md-3 col-lg-3">
					<label>Repita su contraseña</label>					
					<input type="password" class="form-control" id="rpass" name="rpass" required />
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