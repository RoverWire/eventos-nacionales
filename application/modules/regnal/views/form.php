<form class="uniForm" action="" method="post" enctype="multipart/form-data" name="regnal" id="regnal">
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
	    	<label for="cum">CUM</label>
			<span class="inputHolder">
	        	<input name="Datos[cum]" id="cum" value="<?php echo $cum; ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave única de membresía.</p>
				<?php echo form_error('Datos[cum]'); ?>
			</span>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="nombre">Nombre completo</label>
			<span class="inputHolder">
	        	<input name="Datos[nombre]" id="nombre" value="<?php echo $nombre; ?>" size="35" maxlength="50" type="text" />
	        	<p class="formHint">nombre completo de la persona.</p>
				<?php echo form_error('Datos[nombre]'); ?>
			</span>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="vigencia">Vigencia</label>
			<span class="inputHolder">
	        	<input name="Datos[vigencia]" id="vigencia" value="<?php echo $vigencia; ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">fecha de vencimiento de membresia.</p>
				<?php echo form_error('Datos[vigencia]'); ?>
			</span>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="nivel">Nivel</label>
			<span class="inputHolder">
	        	<select name="Datos[nivel]" id="nivel">
				<?php echo $nivel; ?>
                </select>
	        	<p class="formHint">cargo o sección a la que pertenece.</p>
				<?php echo form_error('Datos[nivel]'); ?>
			</span>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="provincia">Provincia</label>
			<span class="inputHolder">
	        	<select name="Datos[provincia]" id="provincia"> 
				<?php echo $provincia; ?>
                </select>
	        	<p class="formHint">provincia a la que pertenece.</p>
				<?php echo form_error('Datos[provincia]'); ?>
			</span>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="localidad">Localidad</label>
			<span class="inputHolder">
	        	<input name="Datos[localidad]" id="localidad" value="<?php echo $localidad; ?>" size="35" maxlength="50" type="text" />
	        	<p class="formHint">ciudad en la que es residente.</p>
				<?php echo form_error('Datos[localidad]'); ?>
			</span>
	    </div>
               
        <div class="ctrlHolder">
	    	<label for="grupo">Grupo</label>
			<span class="inputHolder">
	        	<input name="Datos[grupo]" id="grupo" value="<?php echo $grupo; ?>" size="5" maxlength="3" type="text" />
	        	<p class="formHint">numeral de grupo al que pertenece.</p>
				<?php echo form_error('Datos[grupo]'); ?>
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
		window.location = '<?php echo ruta('regnal'); ?>';
	});
	
	$("#vigencia").datepicker({ dateFormat:'yy-mm-dd', dayNamesMin:['Do','Lu','Ma','Mi','Ju','Vi','Sa'], monthNames:['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Deciembre'], prevText:'Anterior', nextText:'Siguiente' });
});
</script>
