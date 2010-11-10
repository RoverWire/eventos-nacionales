<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
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
<fieldset>
	<legend>Scouter o Adulto Responsable</legend>
		<div class="ctrlHolder">
	    	<label for="scouter">CUM Scouter</label>
			<span class="inputHolder">
	        	<input name="scouter" id="scouter" value="<?php echo set_value('scouter', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">cum adulto responsable.</p>
			</span>
            <?php echo form_error('scouter'); ?>
	    </div>
</fieldset>

<fieldset>
<legend>Elementos de la seisena</legend>
		<div class="ctrlHolder">
	    	<label for="lobato1">CUM Lobato 1</label>
			<span class="inputHolder">
	        	<input name="lobato[0]" id="lobato1" value="<?php echo set_value('lobato[0]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 1.</p>
			</span>
            <?php echo form_error('lobato[0]'); ?>
	    </div>

		<div class="ctrlHolder">
	    	<label for="lobato2">CUM Lobato 2</label>
			<span class="inputHolder">
	        	<input name="lobato[1]" id="lobato2" value="<?php echo set_value('lobato[1]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 2.</p>
			</span>
            <?php echo form_error('lobato[1]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato3">CUM Lobato 3</label>
			<span class="inputHolder">
	        	<input name="lobato[2]" id="lobato3" value="<?php echo set_value('lobato[2]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 3.</p>
			</span>
            <?php echo form_error('lobato[2]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato4">CUM Lobato 4</label>
			<span class="inputHolder">
	        	<input name="lobato[3]" id="lobato4" value="<?php echo set_value('lobato[3]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 4.</p>
			</span>
            <?php echo form_error('lobato[3]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato5">CUM Lobato 5</label>
			<span class="inputHolder">
	        	<input name="lobato[4]" id="lobato5" value="<?php echo set_value('lobato[4]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 5.</p>
			</span>
            <?php echo form_error('lobato[4]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato6">CUM Lobato 6</label>
			<span class="inputHolder">
	        	<input name="lobato[5]" id="lobato6" value="<?php echo set_value('lobato[5]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía lobato / lobezna 6.</p>
			</span>
            <?php echo form_error('lobato[5]'); ?>
	    </div>
</fieldset>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-check"></span> Verificar</button>
	</div>  
</form>

