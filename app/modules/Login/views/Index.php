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
			<div class="cont3">
				<center><p>3 Logo</p></center>
			</div>
			<div class="cont2">
				<center><p>2 Imagen lateral</p></center>
			</div>
			<div class="cont4">
				<center><p>4 Imagen superior</p></center>
			</div>
		</div>
	</section>
</div>