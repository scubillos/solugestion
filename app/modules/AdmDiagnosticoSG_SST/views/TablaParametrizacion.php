
<table class="table table-bordered" style="width:90% !important" align="center" >
	<?php
	for($i = 0; $i < count($Parametros); $i++){
		$Paso = $Parametros[$i];
	?>
	<tr>
		<td align="center" colspan="5"><b><?php echo $Paso["texto"]; ?></b></td>
	</tr>
	<?php
		for($j = 0; $j < count($Paso["secciones"]); $j++){
			$Seccion = $Paso["secciones"][$j];
		?>
		<tr>
			<td align="center" colspan="5"><b><?php echo $Seccion["texto"]; ?></b></td>
		</tr>
		<?php
			if(is_array($Seccion["subsecciones"])){
				for($k = 0; $k < count($Seccion["subsecciones"]); $k++){
					$Subseccion = $Seccion["subsecciones"][$k];
				?>
				<tr>
					<td align="center" colspan="5"><b><?php echo $Subseccion["texto"]; ?></b></td>
				</tr>
				<?php
					if(isset($Subseccion["parametros"]) AND is_array($Subseccion["parametros"])){
						?>
						<tr>
							<th>Numeral</th>
							<th>Marco legal</th>
							<th>Criterio</th>
							<th>Modo verificación</th>
							<th width="5%"></th>
						</tr>
						<?php
						for($m = 0; $m < count($Subseccion["parametros"]); $m++){
							$Parametro = $Subseccion["parametros"][$m];
							$checked = in_array($Parametro["id"],$ParametrosTipoUsuario) ? "checked" : "";
						?>
						<tr>
							<td><?php echo $Parametro["numeral"]; ?></td>
							<td><?php echo $Parametro["marco_legal"]; ?></td>
							<td><?php echo $Parametro["criterio"]; ?></td>
							<td><?php echo $Parametro["modo_verificacion"]; ?></td>
							<td><input type="checkbox" class="form-control" name="parametros[]" value="<?php echo $Parametro["id"] ?>" <?php echo $checked ?> /></td>
						</tr>
						<?php
						}
					}
				}
			}
		}
	}
	?>
</table>