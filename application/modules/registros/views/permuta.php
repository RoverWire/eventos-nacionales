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
		<legend>Proporcione los siguientes CUMs</legend>
		<div class="ctrlHolder">
	    	<label for="pago">CUM de Pago</label>
			<span class="inputHolder">
	        	<input name="pago" id="pago" value="<?php echo set_value('pago', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía que realizó el pago.</p>
			</span>
            <?php echo form_error('pago'); ?>
	    </div>

	    <div class="ctrlHolderLast">
	    	<label for="reemplazo">CUM Reemplazo</label>
			<span class="inputHolder">
	        	<input name="reemplazo" id="reemplazo" value="<?php echo set_value('reemplazo', ''); ?>" size="10" maxlength="10" type="text" />
	        	<p class="formHint">clave de membresía que asistirá al evento.</p>
			</span>
            <?php echo form_error('reemplazo'); ?>
	    </div>
	</fieldset>
	<div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-check"></span> Cambiar Pago</button>
	</div>
</form>
<script type="text/javascript">
$(function() {
	<?php if($resultado == -1): ?>
	$.gritter.add({
		image: '<?php echo relative_root('assets/img/error_64.png'); ?>',
		title: 'Error de Cambio',
		text : 'No se pudo realizar la permuta de participantes. Por favor intente de nuevo.'
	});
	<?php elseif($resultado == 1): ?>
	$.gritter.add({
		image: '<?php echo relative_root('assets/img/checkmark_64.png'); ?>',
		title: 'Cambio Realizado',
		text : 'El cambio de pago de participante ha sido realizado en el listado de pagos del evento.'
	});
	<?php endif; ?>

	$('input').keydown( function(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if(key == 13) {
            e.preventDefault();
            var inputs = $(this).closest('form').find(':input:visible');
            inputs.eq( inputs.index(this)+ 1 ).focus();
        }
    });
});
</script>