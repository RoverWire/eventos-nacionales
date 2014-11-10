<form class="uniForm" action="" method="post" enctype="multipart/form-data" name="ajustes" id="ajustes">
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
	    	<label for="campos">Campos</label>
			<span class="inputHolder">
	        	<input name="Datos[campos]" id="campos" value="<?php echo $campos; ?>" size="5" maxlength="3" type="text" />
	        	<p class="formHint">número de campos que existirán en el evento.</p>
				<?php echo form_error('Datos[campos]'); ?>
			</span>
	    </div>
		
		<div class="ctrlHolder">
			<label for="manadas">Manadas</label>
			<span class="inputHolder">
	        	<input name="Datos[manadas]" id="manadas" value="<?php echo $manadas; ?>" size="5" maxlength="3" type="text" />
	        	<p class="formHint">número de manadas que existiran por campo.</p>
				<?php echo form_error('Datos[manadas]'); ?>
			</span>
	    </div>
		
		<div class="ctrlHolder">
			<label for="edad_limite">Edad Limite</label>
			<span class="inputHolder">
	        	<input name="Datos[edad_limite]" id="edad_limite" value="<?php echo $edad_limite; ?>" size="5" maxlength="3" type="text" />
	        	<p class="formHint">edad maxima de los participantes.</p>
				<?php echo form_error('Datos[edad_limite]'); ?>
			</span>
	    </div>
		
		<div class="ctrlHolder">
			<label for="nombres_campos">Nombres de Campos</label>
			<span class="inputHolder">
	        	<textarea name="Datos[nombres_campos]" id="nombres_campos" cols="60" rows="5"><?php echo $nombres_campos; ?></textarea>
	        	<p class="formHint">separados por comas, mismo número de elementos que campos.</p>
				<?php echo form_error('Datos[nombres_campos]'); ?>
			</span>
	    </div>
		
    </fieldset>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-disk"></span> Guardar</button>
		<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
	</div>
</form>
<script type="text/javascript">
$(function() {
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('ajustes'); ?>';
	});	
});
</script>
