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
		<div class="ctrlHolderLast">
	    	<label for="scouter">CUM Scouter</label>
			<span class="inputHolder">
	        	<input name="scouter" id="scouter" value="<?php echo set_value('scouter', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">cum adulto responsable.</p>
			</span>
            <?php echo form_error('scouter'); ?>
	    </div>
</fieldset>

<fieldset>
<legend>Elementos a cargo</legend>
		<div class="ctrlHolder">
	    	<label for="lobato1">CUM Muchacho 1</label>
			<span class="inputHolder">
	        	<input name="lobato[0]" id="lobato1" value="<?php echo set_value('lobato[0]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 1.</p>
			</span>
            <?php echo form_error('lobato[0]'); ?>
	    </div>

		<div class="ctrlHolder">
	    	<label for="lobato2">CUM Muchacho 2</label>
			<span class="inputHolder">
	        	<input name="lobato[1]" id="lobato2" value="<?php echo set_value('lobato[1]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 2.</p>
			</span>
            <?php echo form_error('lobato[1]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato3">CUM Muchacho 3</label>
			<span class="inputHolder">
	        	<input name="lobato[2]" id="lobato3" value="<?php echo set_value('lobato[2]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 3.</p>
			</span>
            <?php echo form_error('lobato[2]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato4">CUM Muchacho 4</label>
			<span class="inputHolder">
	        	<input name="lobato[3]" id="lobato4" value="<?php echo set_value('lobato[3]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 4.</p>
			</span>
            <?php echo form_error('lobato[3]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato5">CUM Muchacho 5</label>
			<span class="inputHolder">
	        	<input name="lobato[4]" id="lobato5" value="<?php echo set_value('lobato[4]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 5.</p>
			</span>
            <?php echo form_error('lobato[4]'); ?>
	    </div>
        
        <div class="ctrlHolder">
	    	<label for="lobato6">CUM Muchacho 6</label>
			<span class="inputHolder">
	        	<input name="lobato[5]" id="lobato6" value="<?php echo set_value('lobato[5]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 6.</p>
			</span>
            <?php echo form_error('lobato[5]'); ?>
	    </div>
	    
	    <div class="ctrlHolder">
	    	<label for="lobato7">CUM Muchacho 7</label>
			<span class="inputHolder">
	        	<input name="lobato[6]" id="lobato7" value="<?php echo set_value('lobato[6]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 7.</p>
			</span>
            <?php echo form_error('lobato[6]'); ?>
	    </div>
	    
	    <div class="ctrlHolder">
	    	<label for="lobato8">CUM Muchacho 8</label>
			<span class="inputHolder">
	        	<input name="lobato[7]" id="lobato8" value="<?php echo set_value('lobato[7]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 8.</p>
			</span>
            <?php echo form_error('lobato[7]'); ?>
	    </div>
	    
	    <div class="ctrlHolder">
	    	<label for="lobato9">CUM Muchacho 9</label>
			<span class="inputHolder">
	        	<input name="lobato[8]" id="lobato9" value="<?php echo set_value('lobato[8]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 9.</p>
			</span>
            <?php echo form_error('lobato[8]'); ?>
	    </div>
	    
	    
	    <div class="ctrlHolderLast">
	    	<label for="lobato10">CUM Muchacho 10</label>
			<span class="inputHolder">
	        	<input name="lobato[9]" id="lobato10" value="<?php echo set_value('lobato[9]', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía elemento 10.</p>
			</span>
            <?php echo form_error('lobato[9]'); ?>
	    </div>
</fieldset>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-check"></span> Verificar</button>
	</div>  
</form>

