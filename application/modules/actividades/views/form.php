<form class="uniForm" name="usuario" id="usuario" action="" method="post" enctype="multipart/form-data">
	<fieldset class="inlineLabels">
	<?php
		if(validation_errors()){
	?>
	<div class="error">
		<strong>ATENCIÓN:</strong>
		Por favor verifique la información proporcionada, uno o más campos contienen datos no admitidos o se encuentran sin información.
	</div>
	<?php
		}
	?>

		<div class="ctrlHolder">
			<label for="nombre">Nombre</label>
			<span class="inputHolder">
				<input name="Datos[nombre]" id="nombre" value="<?php echo $nombre; ?>" size="35" maxlength="150" type="text" />
				<p class="formHint">nombre que identifica a la actividad.</p>
				<?php echo form_error('Datos[nombre]'); ?>
			</span>
		</div>

		<div class="ctrlHolder">
			<label for="tipo">Tipo</label>
			<span class="inputHolder">
				<select name="Datos[tipo]" id="tipo">
					<option value="Individual" <?php echo ($tipo == "Individual") ? 'selected':'' ?>>Individual</option>
					<option value="Equipo" <?php echo ($tipo == "Equipo") ? 'selected':'' ?>>Equipo</option>
				</select>
				<p class="formHint">tipo de la actividad.</p>
				<?php echo form_error('Datos[tipo]'); ?>
			</span>
		</div>

		<div class="ctrlHolder">
			<label for="capacidad">Capacidad</label>
			<span class="inputHolder">
				<input name="Datos[capacidad]" id="capacidad" value="<?php echo $capacidad; ?>" size="35" maxlength="150" type="text" />
				<p class="formHint">capacidad en equipos / elementos según corresponda.</p>
				<?php echo form_error('Datos[capacidad]'); ?>
			</span>
		</div>

	<div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-disk"></span> Guardar</button>
		<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
	</div>
	</fieldset>
</form>
<script type="text/javascript">
$(function() {
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('actividades'); ?>';
	});	
});
</script>