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
		<?php
		$permisos = $this->getPermisos($idx);
		?>
			<div class="content1">
				<form action="<?php echo $this->UrlBase(); ?>Permisos/Guardar" method="post">
				<input type="hidden" name="id_tipousuario" value="<?php echo isset($id_tipousuario) ? $id_tipousuario : ""; ?>" >
				<table class="table table-bordered" style="width:50% !important" align="center">
					<tr>
						<th colspan="2">Nombre menú</th>
						<th width="10%" title="Todos los permisos"><input type="checkbox" class="form-control" id="allPermissions" /></th>
					</tr>
					<?php
					foreach($permisos as $key => $permiso){
						if($permiso["menu_padre"]==1){
						?>
						<tr>
							<td colspan="2"><?php echo $permiso["nombre"]; ?></td>
							<td><input type="checkbox" class="form-control onePermission menuPadre" name="permisos[]" id="<?php echo "Padre_".$permiso["id"]; ?>" value="<?php echo $permiso["id"]; ?>" /></td>
						</tr>
							<?php
							if(isset($permiso["submenus"])){
								foreach($permiso["submenus"] as $k => $subpermiso){
								?>
								<tr>
									<td width="5%"> </td>
									<td><?php echo $subpermiso["nombre"]; ?></td>
									<td><input type="checkbox" class="form-control onePermission" name="permisos[]" data-idpadre="<?php echo $subpermiso["id_padre"]; ?>" value="<?php echo $subpermiso["id"]; ?>" /></td>
								</tr>
								<?php
								}
							}
						}else{
						?>
						<tr>
							<td colspan="2"><?php echo $permiso["nombre"]; ?></td>
							<td><input type="checkbox" class="form-control onePermission" name="permisos[]" value="<?php echo $permiso["id"]; ?>" /></td>
						</tr>
						<?php
						}
					}
					?>			
				</table>
				<div class="row">
					<div class="col-xs-0 col-sm-6 col-md-4 col-lg-4">&nbsp;</div>
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
</div>
<?php
	$this->LoadTemplate("modal","ModalOpciones","sm");
?>