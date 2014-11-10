		<?php
		$site_root = relative_root();
		$site_base = ruta();
		for($i=0; $i<$this->actividad->numero_registros; $i++){
		?>
			<tr>
				<td><input type="checkbox" name="Del[]" id="Del<?php echo $this->actividad->id; ?>" value="<?php echo $this->actividad->id; ?>" /></td>
				<td><?php echo $this->actividad->nombre; ?></td>
				<td><?php echo $this->actividad->tipo; ?></td>
				<td><?php echo $this->actividad->capacidad; ?></td>
			  <td align="center"><a href="<?php echo $site_base, 'usuarios/editar/', $this->actividad->id; ?>"><img src="<?php echo $site_root, 'img/onebit_20.png'; ?>" alt="Editar" title="Editar" width="16" height="16" border="0" align="absbottom" /></a></td>
			</tr>
		<?php
			$this->actividad->siguiente();
		}
		
		if($this->actividad->numero_registros == 0){
		?>
			<tr>
				<td colspan="5" align="center">No se encontraron resultados registrados</td>
			</tr>
		<?php
		}
		?>
<script type="text/javascript">
	$('#offset').val(<?php echo $offset; ?>);
	$('#total').val(<?php echo $this->actividad->total_registros; ?>);
</script>