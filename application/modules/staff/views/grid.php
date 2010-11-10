        <?php
		$site_root = relative_root();
		$site_base = ruta();
		for($i=0; $i<$this->servicio->numero_registros; $i++)
		{
        ?>
            <tr>
                <td><input type="checkbox" name="Del[]" id="Del<?php echo $this->servicio->id; ?>" value="<?php echo $this->servicio->id; ?>" /></td>
                <td><?php echo $this->servicio->cum; ?></td>
                <td><?php echo $this->servicio->nombre; ?></td>
                <td><?php echo $this->servicio->provincia; ?></td>
                <td align="center"><?php echo $this->servicio->grupo; ?></td>
                <td align="center"><a href="<?php echo $site_base, 'staff/ficha/', $this->servicio->id; ?>"><img src="<?php echo $site_root, 'img/onebit_39.png'; ?>" alt="Ficha" title="Ficha" width="16" height="16" border="0" align="absbottom" /></a></td>
            </tr>
        <?php
            $this->servicio->siguiente();
        }
		
		if($this->servicio->numero_registros == 0){
		?>        	<tr>
            	<td colspan="6" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
<script type="text/javascript">
	$('#offset').val(<?php echo $offset; ?>);
	$('#total').val(<?php echo $this->servicio->total_registros; ?>);
</script>