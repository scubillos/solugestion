
<table class="table table-bordered" style="width:90% !important" align="center" >
	<?php
	for($i = 0; $i < count($Parametros); $i++){
		$Paso = $Parametros[$i];
	?>
	<tr>
		<td align="center" colspan="8"><b><?php echo $Paso["texto"]; ?></b></td>
	</tr>
	<?php
		for($j = 0; $j < count($Paso["secciones"]); $j++){
			$Seccion = $Paso["secciones"][$j];
		?>
		<tr>
			<td align="center" colspan="8"><b><?php echo $Seccion["texto"]; ?></b></td>
		</tr>
		<?php
			if(is_array($Seccion["subsecciones"])){
				for($k = 0; $k < count($Seccion["subsecciones"]); $k++){
					$Subseccion = $Seccion["subsecciones"][$k];
				?>
				<tr>
					<td align="center" colspan="8"><b><?php echo $Subseccion["texto"]; ?></b></td>
				</tr>
				<?php
					if(isset($Subseccion["parametros"]) AND is_array($Subseccion["parametros"])){
						?>
						<tr>
							<th rowspan="2">Numeral</th>
							<th rowspan="2">Marco legal</th>
							<th rowspan="2">Criterio</th>
							<th rowspan="2">Modo verificación</th>
							<th width="3%" rowspan="2">Cumple totalmente</th>
							<th width="5%" rowspan="2">No cumple</th>
							<th width="5%" colspan="2">No aplica</th>
						</tr>
						<tr>
							<th>Justifica</th>
							<th>No justifica</th>
						</tr>
						<?php
						for($m = 0; $m < count($Subseccion["parametros"]); $m++){
							$Parametro = $Subseccion["parametros"][$m];
							if(in_array($Parametro["id"],$ParametrosTipoUsuario)){

								$checked = "";
								if(isset($detalle)){
									for($i=0;$i<count($detalle);$i++){
										if($detalle[$i]["id_parametro"]==$Parametro["id"]){
											$checked = $detalle[$i]["respuesta"];
										}
									}
								}
							
						?>
						<tr>
							<td><?php echo $Parametro["numeral"]; ?></td>
							<td><?php echo $Parametro["marco_legal"]; ?></td>
							<td><?php echo $Parametro["criterio"]; ?></td>
							<td><?php echo $Parametro["modo_verificacion"]; ?></td>
							<td><input type="radio" class="form-control" name="respuestas[<?php echo $Parametro["id"]; ?>]" value="1" <?php echo ($checked==1) ? "checked":""; ?>/></td>
							<td><input type="radio" class="form-control" name="respuestas[<?php echo $Parametro["id"]; ?>]" value="2" <?php echo ($checked==2) ? "checked":""; ?>/></td>
							<td><input type="radio" class="form-control" name="respuestas[<?php echo $Parametro["id"]; ?>]" value="3" <?php echo ($checked==3) ? "checked":""; ?>/></td>
							<td><input type="radio" class="form-control" name="respuestas[<?php echo $Parametro["id"]; ?>]" value="4" <?php echo ($checked==4) ? "checked":""; ?>/></td>
						</tr>
						<?php
						}

						}
					}
				}
			}
		}
	}
	?>
</table>