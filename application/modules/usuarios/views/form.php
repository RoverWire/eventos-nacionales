<form class="uniForm" name="usuarioForm" id="usuarioForm" action="" method="post" enctype="multipart/form-data">
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
	    	<label for="usuario">Nombre de usuario</label>
			<span class="inputHolder">
	        	<input name="Datos[usuario]" id="usuario" value="<?php echo $usuario; ?>" size="35" maxlength="50" type="text" />
	        	<p class="formHint">nombre de usuario o login para inicio de sesión.</p>
				<?php echo form_error('Datos[usuario]'); ?>
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
		
		<div class="ctrlHolder">
	    	<label for="tipo">Tipo de cuenta</label>
			<span class="inputHolder">
	        	<select name="Datos[tipo]" id="tipo">
					<option value='1'<?php echo ($tipo == 1) ? ' selected':''; ?>>Dirigente Nacional</option>
					<option value='2'<?php echo ($tipo == 2) ? ' selected':''; ?>>Usuario de Registros</option>
				</select>
	        	<p class="formHint">un dirigente nacional podrá agregar usuarios y administrar regnal.</p>
			</span>
	    </div>
		
		<div class="ctrlHolder">
	    	<label for="estado">Cuenta activa</label>
			<span class="inputHolder">
	        	<select name="Datos[estado]" id="estado">
					<option value='1'<?php echo ($estado == 1) ? ' selected':''; ?>>Si</option>
					<option value='0'<?php echo ($estado == 0) ? ' selected':''; ?>>No</option>
				</select>
	        	<p class="formHint">un usuario inactivo no podrá acceder.</p>
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
		window.location = '<?php echo ruta('usuarios'); ?>';
	});
});
</script>