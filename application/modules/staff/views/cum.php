<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
		<div class="ctrlHolder">
	    	<label for="cum">CUM</label>
			<span class="inputHolder">
	        	<input name="cum" id="cum" value="<?php echo $cum; ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave única de membresía.</p>
				<?php echo form_error('cum'); ?>
			</span>
	    </div>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-plus"></span> Registrar</button>
		<button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
	</div>
</form>
<script type="text/javascript">
$(function() {
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('staff'); ?>';
	});
	<?php echo $extra; ?>
});
</script>
