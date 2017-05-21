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
		<table class="table table-bordered" style="width:50% !important" align="center">
			<tr>
				<th>Nombre menú</th>
				<th width="10%" title="Todos los permisos"><input type="checkbox" class="form-control" id="allPermissions" /></th>
			</tr>
			<?php
			foreach($permisos as $key => $permiso){
				$classCheck = $permiso["menu_padre"] == 1 ? "menuPadre" : "onePermission";
				if($permiso["menu_padre"]==1){
				?>
				<tr>
					<td><?php echo $permiso["nombre"]; ?></td>
					<td><input type="checkbox" class="form-control menuPadre" name="permisos[]" data-idPadre="<?php echo $permiso["id"]; ?>" value="<?php echo $permiso["id"]; ?>" /></td>
				</tr>
				<tr>
					<td colspan="2">
					<table width="100%" class="table table-bordered">
					<?php
					foreach($permiso["subpermisos"] as $k => $subpermiso){
					?>
					<tr>
						<td width="10%"></td>
						<td><?php echo $permiso["nombre"]; ?></td>
						<td><input type="checkbox" class="form-control onePermission" name="permisos[]" value="<?php echo $permiso["id"]; ?>" /></td>
					</tr>
					<?php
					}
					?>
				</tr>
				<?php
				}else{
				?>
				<tr>
					<td><?php echo $permiso["nombre"]; ?></td>
					<td><td><input type="checkbox" class="form-control onePermission" name="permisos[]" value="<?php echo $permiso["id"]; ?>" /></td></td>
				</tr>	
				<?php
				}
			}
			?>			
		</table>
		</div>
	</div>
</div>
<?php
	$this->LoadTemplate("modal","ModalOpciones","sm");
?>