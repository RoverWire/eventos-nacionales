        <?php
		$site_root = relative_root();
		$site_base = ruta();
		for($i=0; $i<$this->miembro->numero_registros; $i++){
        ?>
            <tr>
                <td><input type="checkbox" name="Del[]" id="Del<?php echo $this->miembro->id; ?>" value="<?php echo $this->miembro->id; ?>" /></td>
                <td><?php echo $this->miembro->cum; ?></td>
                <td><?php echo $this->miembro->nombre; ?></td>
                <td><?php echo $this->miembro->provincia; ?></td>
              <td align="center"><a class="fancybox" href="<?php echo $site_base, 'regnal/ficha/', $this->miembro->id; ?>"><img src="<?php echo $site_root, 'assets/img/onebit_39.png'; ?>" alt="Ficha" title="Ficha" width="16" height="16" border="0" align="absbottom" /></a></td>
                <td align="center"><a href="<?php echo $site_base, 'regnal/editar/', $this->miembro->id; ?>"><img src="<?php echo $site_root, 'assets/img/onebit_20.png'; ?>" alt="Editar" title="Editar" width="16" height="16" border="0" align="absbottom" /></a></td>
            </tr>
        <?php
            $this->miembro->siguiente();
        }
		
		if($this->miembro->numero_registros == 0){
		?>
        	<tr>
            	<td colspan="6" align="center">No se encontraron resultados registrados</td>
            </tr>
		<?php
		}
        ?>
<script type="text/javascript">
	$('#offset').val(<?php echo $offset; ?>);
	$('#total').val(<?php echo $this->miembro->total_registros; ?>);
</script>