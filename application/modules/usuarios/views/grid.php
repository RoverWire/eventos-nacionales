        <?php
		$site_root = relative_root();
		$site_base = ruta();
		for($i=0; $i<$this->usuario->numero_registros; $i++){
        ?>
            <tr>
                <td><input type="checkbox" name="Del[]" id="Del<?php echo $this->usuario->id; ?>" value="<?php echo $this->usuario->id; ?>" /></td>
                <td><?php echo $this->usuario->usuario; ?></td>
                <td><?php echo $this->usuario->nombre; ?></td>
                <td><?php echo ($this->usuario->tipo == 1) ? 'Dirigente Nacional':'Usuario de Registros'; ?></td>
              <td align="center"><a href="<?php echo $site_base, 'usuarios/editar/', $this->usuario->id; ?>"><img src="<?php echo $site_root, 'assets/img/onebit_20.png'; ?>" alt="Editar" title="Editar" width="16" height="16" border="0" align="absbottom" /></a></td>
            </tr>
        <?php
            $this->usuario->siguiente();
        }
		
		if($this->usuario->numero_registros == 0){
		?>
        	<tr>
            	<td colspan="5" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
<script type="text/javascript">
	$('#offset').val(<?php echo $offset; ?>);
	$('#total').val(<?php echo $this->miembro->total_registros; ?>);
</script>