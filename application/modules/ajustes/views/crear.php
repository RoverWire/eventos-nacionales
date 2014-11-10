<h1 class="titulo_seccion">Creación de Campos</h1>
<form class="uniForm" action="" method="post" enctype="multipart/form-data" name="ajustes" id="ajustes">
	<div class="error"><strong>Atención:</strong> La creación de campos reinicia la estructura de los acampados. Las
	asignaciones de manadas y seisenas se eliminarán y no habrá manera de volver a las asignaciones anteriores.</div>
	<p>Si desea crear de nuevo la estructura de las áreas de acampado, manadas y seisenas, haga seleccione "Crear Campos".</p>
    <div class="pieBtn">
		<button type="submit"><span class="ui-icon ui-icon-flag"></span> Crear Campos</button>
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