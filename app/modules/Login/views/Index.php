<div id="wrapper">	
	</div>
	<section>
		<div class="container">
			<div class="cont1">
			<p>Bienvenido al administrador</p>
			<center><p><h4>Lorem ipsum dolor sit amet</h4></p></center>
			<form action="<?= $this->UrlBase(); ?>Login/Auth" method="post" autocomplete="off" id="loginForm">
				<div class="form-group">
					<label for="usuario">Usuario: </label>
					<input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" required autofocus>
				</div>
				<div class="form-group">
					<label for="contraseña">Contraseña: </label>
					<input type="password" name="pass" class="form-control" id="contraseña" placeholder="Contraseña" required>
				</div>
				<center><button type="submit" name="boton" class="btn btn-success">Enviar</button></center>
			</form>
			</div>
		</div>
	</section>
</div>