<form class="uniForm" name="usuario" id="usuario" action="" method="post" enctype="multipart/form-data">
	<fieldset class="inlineLabels noBorder">
		
		<div class="ctrlHolder">
	    	<label for="nombre">Nombre completo</label>
			<span class="inputHolder">
	        	<input name="Datos[nombre]" id="nombre" value="<?php echo $nombre; ?>" size="35" maxlength="50" type="text" />
	        	<p class="formHint">nombre completo de la persona.</p>
				<?php echo form_error('Datos[nombre]'); ?>
			</span>
	    </div>
		
		<div class="ctrlHolder">
	    	<label for="pass">Contraseña</label>
			<span class="inputHolder">
	        	<input name="Datos[pass]" id="pass" value="" size="35" maxlength="50" type="password" />
	        	<p class="formHint">mínimo 6 caracteres de longitud.</p>
				<?php echo form_error('Datos[pass]'); ?>
			</span>
	    </div>
		
		<div class="ctrlHolder">
	    	<label for="repetir">Repetir</label>
			<span class="inputHolder">
	        	<input name="repetir" id="repetir" value="" size="35" maxlength="50" type="password" />
	        	<p class="formHint">repetir la contraseña.</p>
				<?php echo form_error('repetir'); ?>
			</span>
	    </div>

		
	</fieldset>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-disk"></span> Guardar</button>
	</div>
</form>