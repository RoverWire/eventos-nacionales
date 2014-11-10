<form cform class="uniForm" action="" method="post" enctype="multipart/form-data" name="formCUM" id="formCUM">
		<div class="ctrlHolder">
	    	<label for="cum">CUM Scouter</label>
			<span class="inputHolder">
	        	<input name="cum" id="cum" value="" size="10" maxlength="10" type="text" />
	        	<p class="formHint">cum adulto responsable.</p>
			</span>
            <button id="btn_scouter" type="button"><span class="ui-icon ui-icon-check"></span> Validar</button> 
            <div id="loader_scouter" class="loader hide"></div>
	    </div>
<div class="pieBtn">
    <button id="btn_cancelar" type="button"><span class="ui-icon ui-icon-arrowthick-1-w"></span> Regresar</button> 
	</div>
    
</form>
<script type="text/javascript">
$(function() {
	$('#btn_cancelar').click(function(){
		window.location = '<?php echo ruta('registros/paso2/'.$cum); ?>';
	});
	
	$('#formCUM').submit(function(){
		return false;	
	});
	
	$('#btn_scouter').click(function(){
		$('#loader_scouter').removeClass('hide');
		var cum_scouter = $('#cum').val();
		$.post('<?php echo ruta('registros/cambio_scouter'); ?>', { cum:cum_scouter, anterior:'<?php echo $cum; ?>' }, function(data){
			if(data.cum){
				$.gritter.add({
					image: '<?php echo relative_root('assets/img/error_64.png'); ?>',
					title: 'Verificar Membresía',
					text : data.cum
				});
			}else{
				window.location = '<?php echo ruta('registros/paso2/'); ?>' + data.noerror;	
			}
		$('#loader_scouter').addClass('hide');
		}, 'json');
	});
});
</script>
